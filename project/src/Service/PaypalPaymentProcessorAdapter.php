<?php

namespace App\Service;

use Systemeio\TestForCandidates\PaymentProcessor\PaypalPaymentProcessor;

class PaypalPaymentProcessorAdapter extends PaymentProcessor
{
    public function __construct(private readonly PaypalPaymentProcessor $paypalPaymentProcessor)
    {
    }

    public function processPayment(float $price): bool
    {
        $this->paypalPaymentProcessor->pay(intval($price*100));
        return true;
    }
}
