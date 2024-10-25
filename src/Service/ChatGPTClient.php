<?php

namespace HCH\ChatGPTIntegrationBundle\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ChatGPTClient
{
    private $client;
    private $apiKey;
    private $apiUrl;
    private $model;

    public function __construct(HttpClientInterface $client, string $apiKey, string $apiUrl, string $model)
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
        $this->apiUrl = $apiUrl;
        $this->model = $model;
    }

    public function ask(string $message): string
    {
        $response = $this->client->request('POST', $this->apiUrl, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => $this->model,
                'messages' => [
                    ['role' => 'user', 'content' => $message],
                ],
                'max_tokens' => 100,
            ],
        ]);

        $content = $response->toArray();

        return $content['choices'][0]['message']['content'] ?? 'No response';
    }
}
