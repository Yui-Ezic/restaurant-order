<?php


namespace App\Services\Sms;


class ApiSender implements SmsSender
{
    private $url;
    private $key;

    public function __construct(string $url, string $key)
    {
        $this->url = $url;
        $this->key = $key;
    }

    public function send($number, $text): void
    {
        //TODO:: Sends sms
    }
}
