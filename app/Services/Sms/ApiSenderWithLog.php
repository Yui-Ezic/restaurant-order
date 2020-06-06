<?php


namespace App\Services\Sms;


use Psr\Log\LoggerInterface;

class ApiSenderWithLog implements SmsSender
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var ApiSender
     */
    private $sender;

    public function __construct(LoggerInterface $logger, ApiSender $sender)
    {
        $this->logger = $logger;
        $this->sender = $sender;
    }

    public function send($number, $text): void
    {
        $this->logger->info("SMS: '$text' has been sent to number '$number'.");
        $this->sender->send($number, $text);
    }
}
