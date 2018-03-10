<?php

namespace FbMessengerBot;

/**
 * Class Messenger
 * 
 */
class Payload
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var bool
     */
    protected $isReusable;

    /**
     * @var string
     */
    protected $templateType;

    /**
     * @var string
     */
    protected $text;

    /**
     * @var array
     */
    protected $buttons;

    /**
     * Set url
     *
     * @param string $url Url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Get url
     *
     * @return string Url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set is reusable
     *
     * @param bool $isReusable Is reusable
     */
    public function setIsReusable($isReusable)
    {
        $this->isReusable = $isReusable;
    }

    /**
     * Get is reusable
     *
     * @return bool Is reusable
     */
    public function getIsReusable()
    {
        return $this->isReusable;
    }

    /**
     * Set template type
     *
     * @param string $templateType Template type
     */
    public function setTemplateType($templateType)
    {
        $this->templateType = $templateType;
    }

    /**
     * Get template type
     *
     * @return string Template type
     */
    public function getTemplateType()
    {
        return $this->templateType;
    }

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
     * Set button
     *
     * @param array $payload Payload
     */
    public function setButton($payload)
    {
        $model = new Button();

        $model->setType(!empty($payload['type']) ? $payload['type'] : 'web_url');

        if (!empty($payload['title'])) {
            $model->setTitle($payload['title']);
        }

        if (!empty($payload['payload'])) {
            $model->setPayload($payload['payload']);
        }

        if (!empty($payload['url'])) {
            $model->setUrl($payload['url']);
        }

        $this->buttons[] = $model;
    }

    /**
     * Get button
     *
     * @return array Button
     */
    public function getButton()
    {
        return $this->buttons;
    }
}
