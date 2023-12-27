<?php

namespace App\Tests\Func\Entity\Rpc\Purchase;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class CalculatePriceTest extends ApiTestCase
{
    public function testCalculatedPriceFixedDiscount()
    {
        $client = static::createClient();

        $response = $client->request('POST', '/api/calculate-price', [
            'headers' => [
                'Accept' => '*/*',
                'Content-Type' => 'application/json'
            ],
            'json' => [
                "product" => 1,
                "taxNumber" => "GR658565478",
                "couponCode" => "F40"
            ]
        ]);

        self::assertResponseIsSuccessful();
        self::assertResponseStatusCodeSame(200);

        $decodedContent = json_decode($response->getContent(), true);

        self::assertEquals(['calculatedPrice' => 74.4], $decodedContent);
    }

    public function testCalculatedPricePercentageDiscount()
    {
        $client = static::createClient();

        $response = $client->request('POST', '/api/calculate-price', [
            'headers' => [
                'Accept' => '*/*',
                'Content-Type' => 'application/json'
            ],
            'json' => [
                "product" => 2,
                "taxNumber" => "DE658565478",
                "couponCode" => "P14"
            ]
        ]);

        self::assertResponseIsSuccessful();
        self::assertResponseStatusCodeSame(200);

        $decodedContent = json_decode($response->getContent(), true);

        self::assertEquals(['calculatedPrice' => 20.47], $decodedContent);
    }
}
