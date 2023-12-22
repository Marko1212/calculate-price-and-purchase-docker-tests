<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\Rpc\CalculatePrice;
use App\Service\CalculatePriceService;
use Symfony\Component\HttpFoundation\JsonResponse;

final class CalculatePriceProcessor implements ProcessorInterface
{
    public function __construct(
        private readonly CalculatePriceService $calculatePriceService
    ) {
    }

    /**
     * @param CalculatePrice $data
     */
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): JsonResponse
    {
        return new JsonResponse(['calculatedPrice' => $this->calculatePriceService->calculatePrice($data)]);
    }
}
