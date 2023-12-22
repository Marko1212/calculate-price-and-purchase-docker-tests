<?php

namespace App\Service;

use App\Entity\Rpc\Purchase;
use Systemeio\TestForCandidates\PaymentProcessor\PaypalPaymentProcessor;
use Systemeio\TestForCandidates\PaymentProcessor\StripePaymentProcessor;

class PurchaseService
{
    public function __construct(
        private readonly CalculatePriceService $calculatePriceService,
        private PaymentProcessor $paymentProcessor,
    ) {
    }

    /**
     * @param Purchase $data
     */
    public function purchase(mixed $data): bool
    {
        if ($data->getPaymentProcessor() === 'paypal')
            $this->paymentProcessor = new PaypalPaymentProcessorAdapter(new PaypalPaymentProcessor());
        else
            $this->paymentProcessor = new StripePaymentProcessorAdapter(new StripePaymentProcessor());

        return $this->paymentProcessor->processPayment($this->calculatePriceService->calculatePrice($data));
    }
}
