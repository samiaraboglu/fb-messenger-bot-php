<?php

namespace FbMessengerBot;

class Answer {
    public $text;
    public $attachment;

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setAttachment(Attachment $attachment)
    {
        $this->attachment = $attachment;
    }

    public function getAttachment()
    {
        return $this->attachment;
    }
}
