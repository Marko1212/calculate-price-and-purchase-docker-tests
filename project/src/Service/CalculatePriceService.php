<?php

namespace App\Service;

use App\Entity\Rpc\CalculatePrice;
use App\Helper\Helper;
use App\Repository\ProductRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CalculatePriceService
{
    public function __construct(
        private readonly ProductRepository $productRepository
    ) {
    }

    /**
     * @param CalculatePrice $data
     */
    public function calculatePrice(mixed $data): float
    {
        $product = $this->productRepository->find($data->getProduct());
        if (!$product) {
            throw new NotFoundHttpException('Product with id equal to ' . $data->getProduct() . ' does not exist!');
        }

        $couponCode = $data->getCouponCode();

        if (empty($couponCode)) {
            return round((Helper::getVAT($data->getTaxNumber()) + 1) * $product->getPrice(), 2);
        }

        substr($couponCode, 0, 1) === 'F' ?
            $priceAfterDiscount = $product->getPrice() - substr($data->getCouponCode(), 1) :
            $priceAfterDiscount = $product->getPrice() * (1 - substr($data->getCouponCode(), 1) / 100);

        return round((Helper::getVAT($data->getTaxNumber()) + 1) * $priceAfterDiscount, 2);
    }
}
