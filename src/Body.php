<?php

namespace FbMessengerBot;

/**
 * Class Body
 * 
 */
class Body
{
    /**
     * @var Recipient
     */
    protected $recipient;

    /**
     * @var Message
     */
    protected $message;

    /**
     * Set recipient
     *
     * @param int $recipientId Recipient id
     */
    public function setRecipient($recipientId)
    {
        $recipient = new Recipient();

        $recipient->setId($recipientId);

        $this->recipient = $recipient;
    }

    /**
     * Get recipient
     *
     * @return Recipient
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * Set message
     *
     * @param Message $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * Get message
     *
     * @return Message
     */
    public function getMessage()
    {
        return $this->message;
    }
}
