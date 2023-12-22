<?php

namespace App\Helper;

abstract class Helper
{
    /**
     * @param string $taxNumber
     * @return float
     */
    public static function getVAT(string $taxNumber): float
    {
        $vat = [
            'DE' => 0.19,
            'FR' => 0.20,
            'IT' => 0.22,
            'GR' => 0.24
        ];

        return $vat[substr($taxNumber, 0, 2)];
    }
}
