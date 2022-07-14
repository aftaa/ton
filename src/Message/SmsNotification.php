<?php

namespace App\Message;

class SmsNotification
{
    /**
     * @param string $message
     */
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