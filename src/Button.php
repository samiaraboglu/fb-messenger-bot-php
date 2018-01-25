<?php

namespace FbMessengerBot;

/**
 * Class Button
 * 
 */
class Button
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var array
     */
    protected $payload;

    /**
     * @var string
     */
    protected $url;

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
     * Set title
     *
     * @param string $title Title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string Title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set payload
     *
     * @param array $payload Payload
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;
    }

    /**
     * Get payload
     *
     * @return array Payload
     */
    public function getPayload()
    {
        return $this->payload;
    }

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
}
