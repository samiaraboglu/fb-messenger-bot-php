<?php

namespace FbMessengerBot;

/**
 * Class Attachment
 * 
 */
class Attachment
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var Payload
     */
    protected $payload;

    /**
     * Set type
     *
     * @param string $type Type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return string Type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set payload
     *
     * @param Payload $payload
     */
    public function setPayload($payload)
    {
        $model = new Payload();

        if (!empty($payload['url'])) {
            $model->setUrl($payload['url']);
        }

        if (!empty($payload['template_type'])) {
            $model->setTemplateType($payload['template_type']);
        }

        if (!empty($payload['text'])) {
            $model->setText($payload['text']);
        }

        if (!empty($payload['buttons'])) {
            foreach ($payload['buttons'] as $button) {
                $model->setButton($button);
            }
        }

        $this->payload = $model;
    }

    /**
     * Get payload
     *
     * @return Payload
     */
    public function getPayload()
    {
        return $this->payload;
    }
}
