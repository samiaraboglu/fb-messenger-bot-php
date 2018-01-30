<?php

namespace FbMessengerBot;

/**
 * Class Message
 * 
 */
class Message
{
    /**
     * @var string
     */
    protected $text;

    /**
     * @var array
     */
    protected $quickReplies;

    /**
     * @var Attachment
     */
    protected $attachment;

    /**
     * Set text
     *
     * @param string $text Text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * Get text
     *
     * @return string Text
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set attachment
     *
     * @param string $type Type
     * @param array $payload Payload
     */
    public function setAttachment($type, $payload)
    {
        $attachment = new Attachment();

        $attachment->setType($type);
        $attachment->setPayload($payload);

        $this->attachment = $attachment;
    }

    /**
     * Get attachment
     *
     * @return Attachment
     */
    public function getAttachment()
    {
        return $this->attachment;
    }

    /**
     * Set quick replies
     *
     * @param array $quickReplie Quick replie
     */
    public function setQuickReplies($quickReplie)
    {
        $model = new QuickReplie();

        $type = !empty($quickReplie['type']) ? $quickReplie['type'] : 'text';

        if (!empty($type)) {
            $model->setContentType($type);
        }

        if (!empty($quickReplie['title'])) {
            $model->setTitle($quickReplie['title']);
        }

        // TO DO
        if (1) {
            $model->setPayload('<POSTBACK_PAYLOAD>');
        }

        if (!empty($quickReplie['image'])) {
            $model->setImageUrl($quickReplie['image']);
        }

        $this->quickReplies[] = $model;
    }

    /**
     * Set quick replies
     *
     * @return array Quick replies
     */
    public function getQuickReplies()
    {
        return $this->quickReplies;
    }

    /**
     * Populate text
     *
     * @param string $text Text
     *
     * @return Message
     */
    public function text($text)
    {
        $this->setText($text);

        return $this;
    }

    /**
     * Populate audio
     *
     * @param string $url Url
     *
     * @return Message
     */
    public function audio($url)
    {
        $this->setAttachment('audio', ['url' => $url]);

        return $this;
    }

    /**
     * Populate video
     *
     * @param string $url Url
     *
     * @return Message
     */
    public function video($url)
    {
        $this->setAttachment('video', ['url' => $url]);

        return $this;
    }

    /**
     * Populate image
     *
     * @param string $url Url
     *
     * @return Message
     */
    public function image($url)
    {
        $this->setAttachment('image', ['url' => $url]);

        return $this;
    }

    /**
     * Populate file
     *
     * @param string $url Url
     *
     * @return Message
     */
    public function file($url)
    {
        $this->setAttachment('file', ['url' => $url]);

        return $this;
    }

    /**
     * Populate call
     *
     * @param string $text Text
     * @param string $title Title
     * @param array $payload Payload
     *
     * @return Message
     */
    public function call($text, $title, $payload)
    {
        $payload = [
            'template_type' => 'button',
            'text' => $text,
            'buttons' => [
                [
                    'type' => 'phone_number',
                    'title' => $title,
                    'payload' => $payload,
                ]
            ],
        ];

        $this->setAttachment('template', $payload);

        return $this;
    }

    /**
     * Populate quick replies
     *
     * @param string $text Text
     * @param array $quickReplies Quick replies
     *
     * @return Message
     */
    public function quickReplies($text, $quickReplies)
    {
        $this->setText($text);

        foreach ($quickReplies as $quickReplie) {
            $this->setQuickReplies($quickReplie);
        }

        return $this;
    }

    /**
     * Populate button
     *
     * @param string $text Text
     * @param array $buttons Buttons
     *
     * @return Message
     */
    public function button($text, $buttons)
    {
        $payload = [
            'template_type' => 'button',
            'text' => $text,
            'buttons' => $buttons,
        ];

        $this->setAttachment('template', $payload);

        return $this;
    }
}
