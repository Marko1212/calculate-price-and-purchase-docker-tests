<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class FixedAmountDiscountLessOrEqualToPrice extends Constraint
{
    /*
     * Any public properties become valid options for the annotation.
     * Then, use these in your validator class.
     */
    private string $message = 'Fixed amount discount should be less than or equal to price which is {{ value }}.';

    public function getTargets(): string|array
    {
        return self::CLASS_CONSTRAINT;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
