<?php

namespace App\Entity\Rpc;

use ApiPlatform\Metadata\Post;
use App\State\PurchaseProcessor;
use Symfony\Component\Validator\Constraints as Assert;

#[Post(uriTemplate: '/purchase', processor: PurchaseProcessor::class)]
class Purchase extends CalculatePrice
{
    #[Assert\NotBlank(normalizer: 'trim')]
    #[Assert\Choice(choices: ['paypal', 'stripe'])]
    private string $paymentProcessor;

    public function getPaymentProcessor(): string
    {
        return $this->paymentProcessor;
    }

    public function setPaymentProcessor(string $paymentProcessor): self
    {
        $this->paymentProcessor = $paymentProcessor;
        return $this;
    }
}
