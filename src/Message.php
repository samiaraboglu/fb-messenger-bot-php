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

        $model->setContentType($type);

        if (!empty($quickReplie['title'])) {
            $model->setPayload($quickReplie['payload']);
        }

        if (!empty($quickReplie['title'])) {
            $model->setTitle($quickReplie['title']);
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
     * @param string|int $resource Url or attachment id
     * @param bool $isReusable Is reusable
     *
     * @return Message
     */
    public function audio($resource, $isReusable = false)
    {
        $payload = [
            'is_reusable' => $isReusable
        ];

        if (is_int($resource)) {
            $payload['attachment_id'] = $resource;
        } else {
            $payload['url'] = $resource;
        }

        $this->setAttachment('audio', $payload);

        return $this;
    }

    /**
     * Populate video
     *
     * @param string|int $resource Url or attachment id
     * @param bool $isReusable Is reusable
     *
     * @return Message
     */
    public function video($resource, $isReusable = false)
    {
        $payload = [
            'is_reusable' => $isReusable
        ];

        if (is_int($resource)) {
            $payload['attachment_id'] = $resource;
        } else {
            $payload['url'] = $resource;
        }

        $this->setAttachment('video', $payload);

        return $this;
    }

    /**
     * Populate image
     *
     * @param string|int $resource Url or attachment id
     * @param bool $isReusable Is reusable
     *
     * @return Message
     */
    public function image($resource, $isReusable = false)
    {
        $payload = [
            'is_reusable' => $isReusable
        ];

        if (is_int($resource)) {
            $payload['attachment_id'] = $resource;
        } else {
            $payload['url'] = $resource;
        }

        $this->setAttachment('image', $payload);

        return $this;
    }

    /**
     * Populate file
     *
     * @param string|int $resource Url or attachment id
     * @param bool $isReusable Is reusable
     *
     * @return Message
     */
    public function file($resource, $isReusable = false)
    {
        $payload = [
            'is_reusable' => $isReusable
        ];

        if (is_int($resource)) {
            $payload['attachment_id'] = $resource;
        } else {
            $payload['url'] = $resource;
        }

        $this->setAttachment('file', $payload);

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
     * Populate simple url button
     *
     * @param string $text Text
     * @param string $title Title
     * @param string $url Url
     *
     * @return Message
     */
    public function url($text, $title, $url)
    {
        $payload = [
            'template_type' => 'button',
            'text' => $text,
            'buttons' => [
                [
                    'title' => $title,
                    'url' => $url
                ]
            ],
        ];

        $this->setAttachment('template', $payload);

        return $this;
    }

    /**
     * Populate simple postback button
     *
     * @param string $text Text
     * @param string $title Title
     * @param string $postback Postback
     *
     * @return Message
     */
    public function postback($text, $title, $postback)
    {
        $payload = [
            'template_type' => 'button',
            'text' => $text,
            'buttons' => [
                [
                    'type' => 'postback',
                    'title' => $title,
                    'payload' => $postback
                ]
            ],
        ];

        $this->setAttachment('template', $payload);

        return $this;
    }

    /**
     * Populate login button
     *
     * @param string $text Text
     * @param string $url Url
     *
     * @return Message
     */
    public function login($text, $url)
    {
        $payload = [
            'template_type' => 'button',
            'text' => $text,
            'buttons' => [
                [
                    'type' => 'account_link',
                    'url' => $url
                ]
            ],
        ];

        $this->setAttachment('template', $payload);

        return $this;
    }

    /**
     * Populate logout button
     *
     * @param string $text Text
     *
     * @return Message
     */
    public function logout($text)
    {
        $payload = [
            'template_type' => 'button',
            'text' => $text,
            'buttons' => [
                [
                    'type' => 'account_unlink'
                ]
            ],
        ];

        $this->setAttachment('template', $payload);

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
     * Populate qucik replies text
     *
     * @param string $text Text
     * @param string $title Title
     * @param string $postback Postback
     *
     * @return Message
     */
    public function quickReplie($text, $title, $postback, $image = null)
    {
        $this->setText($text);

        $payload = [
            'title' => $title,
            'payload' => $postback,
        ];

        if (!empty($image)) {
            $payload['image'] = $image;
        }

        $this->setQuickReplies($payload);

        return $this;
    }

    /**
     * Populate qucik replies location
     *
     * @param string $text Text
     *
     * @return Message
     */
    public function location($text)
    {
        $this->setText($text);

        $this->setQuickReplies([
            'type' => 'location'
        ]);

        return $this;
    }

    /**
     * Populate qucik replies phone number
     *
     * @param string $text Text
     *
     * @return Message
     */
    public function phoneNumber($text)
    {
        $this->setText($text);

        $this->setQuickReplies([
            'type' => 'user_phone_number'
        ]);

        return $this;
    }

    /**
     * Populate qucik replies email
     *
     * @param string $text Text
     *
     * @return Message
     */
    public function email($text)
    {
        $this->setText($text);

        $this->setQuickReplies([
            'type' => 'user_email'
        ]);

        return $this;
    }
}
