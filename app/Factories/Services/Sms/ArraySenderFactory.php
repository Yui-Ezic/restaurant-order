<?php


namespace App\Factories\Services\Sms;


use App\Services\Sms\ArraySender;
use App\Services\Sms\SmsSender;

class ArraySenderFactory implements SmsSenderFactory
{
    public function create(): SmsSender
    {
        return new ArraySender();
    }
}
