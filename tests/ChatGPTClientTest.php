<?php

namespace HCH\ChatGPTIntegrationBundle\Tests;

use HCH\ChatGPTIntegrationBundle\Service\ChatGPTClient;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

class ChatGPTClientTest extends TestCase
{
    public function testAsk()
    {
        $mockResponse = new MockResponse(json_encode(['choices' => [['message' => ['content' => 'Test response']]]]));
        $client = new MockHttpClient($mockResponse);
        
        $chatGPTClient = new ChatGPTClient($client, 'test_key', 'https://api.openai.com/v1/chat/completions', 'gpt-3.5-turbo');
        $response = $chatGPTClient->ask('Test prompt');
        
        $this->assertEquals('Test response', $response);
    }
}
