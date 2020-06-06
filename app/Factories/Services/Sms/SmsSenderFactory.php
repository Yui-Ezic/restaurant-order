<?php


namespace App\Factories\Services\Sms;


use App\Services\Sms\SmsSender;

interface SmsSenderFactory
{
    public function create(): SmsSender;
}
