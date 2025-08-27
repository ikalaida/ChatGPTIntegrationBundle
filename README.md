# ChatGPTIntegrationBundle

This bundle provides a simple way to integrate ChatGPT API with Symfony applications.

## Installation

```bash
 "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/ikalaida/ChatGPTIntegrationBundle.git"
        }
    ],
```

```bash
composer require ikalaida/chatgpt-integration-bundle
```

## Configuration

In your Symfony config, add your OpenAI API key, API URL, and model:

```yaml
# /config/services.yaml
HCH\ChatGPTIntegrationBundle\Service\ChatGPTClient:
    autowire: true
    autoconfigure: true
    arguments:
        $apiKey: '%env(OPENAI_API_KEY)%'
        $apiUrl: '%env(OPENAI_API_URL)%'
        $model: '%env(OPENAI_MODEL)%'
```

```
# .env
OPENAI_API_KEY=sk-xxxxxxxxxxxxxxxxxxxxxxx
OPENAI_API_URL=https://api.openai.com/v1/responses
OPENAI_MODEL=gpt-5-nano
```

## Usage

Inject the `ChatGPTClient` service wherever needed:

```php
use HCH\ChatGPTIntegrationBundle\Service\ChatGPTClient;

class SomeService
{
    private $chatGPTClient;

    public function __construct(ChatGPTClient $chatGPTClient)
    {
        $this->chatGPTClient = $chatGPTClient;
    }

    public function getResponseFromChatGPT(string $message): string
    {
        return $this->chatGPTClient->ask($message);
    }
}
```

## Testing

Run tests with PHPUnit:

```bash
php bin/phpunit
```

## License

This bundle is released under the MIT License.
