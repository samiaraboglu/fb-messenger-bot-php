<?php

namespace FbMessengerBot;

/**
 * Class Messenger
 * 
 */
class QuickReplie
{
    /**
     * @var string
     */
    protected $contentType;

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
    protected $imageUrl;

    /**
     * Set content type
     *
     * @param string $contentType Content type
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
    }

    /**
     * Get content type
     *
     * @return string Content type
     */
    public function getContentType()
    {
        return $this->contentType;
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
     * Set image url
     *
     * @param string $imageUrl Image url
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }

    /**
     * Get image url
     *
     * @return string Image Url
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }
}
