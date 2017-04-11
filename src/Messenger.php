<?php

namespace FbMessengerBot;

class Messenger {
    public $config;
    public $item;
    public $senderId;
    public $message;
    public $answer;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function setItem(Item $item)
    {
        $this->item[] = $item;
    }

    public function getItem()
    {
        return $this->item;
    }

    public function setSenderId($senderId)
    {
        $this->senderId = $senderId;
    }

    public function getSenderId()
    {
        return $this->senderId;
    }

    public function setMessage(Message $message)
    {
        $this->message = $message;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setAnswer(Answer $answer)
    {
        $this->answer = $answer;
    }

    public function getAnswer()
    {
        return $this->answer;
    }

    public function listen()
    {
        if (!empty($_REQUEST['hub_verify_token']) && $_REQUEST['hub_verify_token'] === $this->config->verifiyToken) {
            echo $_REQUEST['hub_challenge'];
            exit;
        }
        
        $input = json_decode(file_get_contents('php://input'), true);

        $this->setSenderId($input['entry'][0]['messaging'][0]['sender']['id']);

        if (empty($input['entry'][0]['messaging'][0]['message']['text'])) {
            return;
        }

        $message = new Message();
        $message->setText($input['entry'][0]['messaging'][0]['message']['text']);

        $this->setMessage($message);

        if ($this->getItem()) {
            foreach ($this->getItem() as $key => $item) {
                if (preg_match(sprintf('/^%s$/', $item->getMessage()->getText()), $this->getMessage()->getText())) {
                    $this->setAnswer($item->getAnswer());
                }
            }
        }
    }

    public function send()
    {
        try {
            if (is_null($this->getAnswer())) {
                throw new \Exception('Message don\'t send. Because answer not found');
            }

            $response = [
                'recipient' => [
                    'id' => $this->getSenderId()
                ]
            ];

            if (!empty($this->getAnswer()->getText())) {
                $response['message'] = [
                    'text' => $this->getAnswer()->getText()
                ];
            }

            if (
                !empty($this->getAnswer()->getAttachment()) &&
                !empty($this->getAnswer()->getAttachment()->getType())
            ) {
                $response['message']['attachment']['type'] = $this->getAnswer()->getAttachment()->getType();
            }

            if (
                $this->getAnswer()->getAttachment() &&
                $this->getAnswer()->getAttachment()->getPayload()
            ) {
                $response['message']['attachment']['payload'] = $this->getAnswer()->getAttachment()->getPayload();
            }

            $ch = curl_init('https://graph.facebook.com/v2.6/me/messages?access_token=' . $this->config->accessToken);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $apiResult = curl_exec($ch);

            $jsonResult = json_decode($apiResult, true);

            if (isset($jsonResult['error'])) {
                throw new \Exception($apiResult);
            }

            curl_close($ch);

            return [
                'success' => true,
                'message' => $jsonResult,
                'json' => $response
            ];
        } catch (\Exception $exception) {
            $result['success'] = false;

            $json = json_decode($exception->getMessage(), true);

            if (is_array($json)) {
                $result['error'] = $json['error'];
            } else {
                $result['error'] = [
                    'message' => $exception->getMessage()
                ];
            }

            return $result;
        }
    }
}
