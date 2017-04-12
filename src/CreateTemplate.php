<?php

namespace FbMessengerBot;

class CreateTemplate {
    public static function item($messageText, $payload)
    {
        return CreateTemplate::populate($messageText, $payload);
    }

    public static function populate($messageText, $payload)
    {
        $message = new Message();
        $message->setText($messageText);

        $answer = CreateTemplate::answer($payload);

        $item = new Item();
        $item->setMessage($message);
        $item->setAnswer($answer);

        return $item;
    }

    public static function answer($payload)
    {
        $attachment = new Attachment();
        $attachment->setType('template');
        $attachment->setPayload($payload);

        $answer = new Answer();
        $answer->setAttachment($attachment);

        return $answer;
    }
}
