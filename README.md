# ChatGPTIntegrationBundle

This bundle provides a simple way to integrate ChatGPT API with Symfony applications.

## Installation

```bash
composer require HCH/chatgpt-integration-bundle
```

## Configuration

In your Symfony config, add your OpenAI API key, API URL, and model:

```yaml
# config/packages/chatgpt_integration.yaml
chatgpt_integration:
    api_key: '%env(CHATGPT_API_KEY)%'
    api_url: 'https://api.openai.com/v1/chat/completions'
    model: 'gpt-3.5-turbo'
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
