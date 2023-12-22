<?php

namespace App\Service;

use Systemeio\TestForCandidates\PaymentProcessor\StripePaymentProcessor;

class StripePaymentProcessorAdapter extends PaymentProcessor
{
    public function __construct(private readonly StripePaymentProcessor $stripePaymentProcessor)
    {
    }

    public function processPayment(float $price): bool
    {
        return $this->stripePaymentProcessor->processPayment($price);
    }
}
