<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\Rpc\Purchase;
use App\Service\PurchaseService;
use Symfony\Component\HttpFoundation\JsonResponse;

final class PurchaseProcessor implements ProcessorInterface
{
    public function __construct(
        private readonly PurchaseService $purchaseService
    ) {
    }

    /**
     * @param Purchase $data
     */
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): JsonResponse
    {
        return new JsonResponse(['purchase' => $this->purchaseService->purchase($data)]);
    }
}
