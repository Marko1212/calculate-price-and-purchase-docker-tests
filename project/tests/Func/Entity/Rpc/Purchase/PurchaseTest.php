<?php

namespace App\Tests\Func\Entity\Rpc\Purchase;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class PurchaseTest extends ApiTestCase
{
    public function testPurchaseTrue()
    {
        $client = static::createClient();

        $response = $client->request('POST', '/api/purchase', [
            'headers' => [
                'Accept' => '*/*',
                'Content-Type' => 'application/json'
            ],
            'json' => [
                "product" => 1,
                "taxNumber" => "GR658565478",
                "couponCode" => "P6",
                "paymentProcessor" => "paypal"
            ]
        ]);

        self::assertResponseIsSuccessful();
        self::assertResponseStatusCodeSame(200);

        $decodedContent = json_decode($response->getContent(), true);

        self::assertEquals(['purchase' => true], $decodedContent);
    }

    public function testPurchaseFalse()
    {
        $client = static::createClient();

        $response = $client->request('POST', '/api/purchase', [
            'headers' => [
                'Accept' => '*/*',
                'Content-Type' => 'application/json'
            ],
            'json' => [
                "product" => 1,
                "taxNumber" => "DE658565478",
                "couponCode" => "F40",
                "paymentProcessor" => "stripe"
            ]
        ]);

        self::assertResponseIsSuccessful();
        self::assertResponseStatusCodeSame(200);

        $decodedContent = json_decode($response->getContent(), true);

        self::assertEquals(['purchase' => false], $decodedContent);
    }
}
