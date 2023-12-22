<?php

namespace App\Validator;

use App\Entity\Rpc\CalculatePrice;
use App\Repository\ProductRepository;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class FixedAmountDiscountLessOrEqualToPriceValidator extends ConstraintValidator
{
    public function __construct(
        private readonly ProductRepository $productRepository
    ) {
    }

    public function validate($value, Constraint $constraint)
    {
        if (null === $value || '' === $value) {
            return;
        }

        if (substr($value->getCouponCode(), 0, 1) !== 'F') {
            return;
        }

        if (!$value instanceof CalculatePrice) {
            throw new UnexpectedTypeException($value, CalculatePrice::class);
        }

        if (empty($value->getProduct()) && $value->getProduct() !== 0) {
            throw new BadRequestHttpException('product value should not be blank');
        }

        $product = $this->productRepository->find($value->getProduct());

        if (!$product) {
            throw new NotFoundHttpException('Product with id equal to ' . $value->getProduct() . ' does not exist!');
        }

        if ($product->getPrice() < intval(substr($value->getCouponCode(), 1))) {
            $this->context->buildViolation($constraint->getMessage())
                ->setParameter('{{ value }}', (string)$product->getPrice())
                ->addViolation();
        }
    }
}
