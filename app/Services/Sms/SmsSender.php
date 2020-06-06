<?php


namespace App\Services\Sms;


interface SmsSender
{
    /**
     * Sends sms
     * @param $number
     * @param $text
     */
    public function send($number, $text): void;
}
