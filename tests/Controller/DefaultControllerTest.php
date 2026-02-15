<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testHomePage(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'ZOO company');
    }

    public function testCalculation()
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/api/shipping/calculate',
            [], [], ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'carrier' => 'transcompany',
                'weight' => 22.5
            ])
        );

        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('Content-Type', 'application/json');

        $responseContent = $client->getResponse()->getContent();
        $this->assertStringContainsString('transcompany', $responseContent);
    }

    public function testInvalidCalculation()
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/api/shipping/calculate',
            [], [], ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'carrier' => 'trans',
                'weight' => 22
            ])
        );

        $data = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('error', $data);
    }
}
