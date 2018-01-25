<?php

namespace FbMessengerBot;

/**
 * Class Messenger
 * 
 */
class Recipient
{
    /**
     * @var int
     */
    protected $id;

    /**
     * Set id
     *
     * @param int $id Id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get id
     *
     * @return int id
     */
    public function getId()
    {
        return $this->id;
    }
}
