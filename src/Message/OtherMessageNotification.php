<?php

namespace App\Message;

class OtherMessageNotification
{
    public function __construct(
        private readonly string $message,
    )
    {

    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }


}