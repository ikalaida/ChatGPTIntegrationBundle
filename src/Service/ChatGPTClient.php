<?php

declare(strict_types=1);

namespace HCH\ChatGPTIntegrationBundle\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ChatGPTClient
{
    private HttpClientInterface $client;
    private string $apiKey;
    private string $apiUrl;
    private string $model;

    public function __construct(HttpClientInterface $client, string $apiKey, string $apiUrl, string $model)
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
        $this->apiUrl = $apiUrl;
        $this->model = $model;
    }

    public function ask(string $input): string
    {
        $response = $this->client->request('POST', $this->apiUrl, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => $this->model,
                'input' => $input,
            ],
        ]);

        $content = $response->toArray();

        $assistantText = '';

        foreach ($content['output'] as $item) {
            if (isset($item['role']) && $item['role'] === 'assistant') {
                foreach ($item['content'] as $contentItem) {
                    if ($contentItem['type'] === 'output_text') {
                        $assistantText .= $contentItem['text'];
                    }
                }
            }
        }

        return $assistantText ?? 'No response';
    }
}
