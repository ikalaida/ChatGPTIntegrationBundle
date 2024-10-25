<?php

namespace HCH\ChatGPTIntegrationBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('chatgpt_integration');
        $treeBuilder->getRootNode()
            ->children()
            ->scalarNode('api_key')
            ->defaultValue('YOUR_API_KEY_HERE')
            ->end()
            ->scalarNode('api_url')
            ->defaultValue('https://api.openai.com/v1/chat/completions')
            ->end()
            ->scalarNode('model')
            ->defaultValue('gpt-3.5-turbo')
            ->end()
            ->end();

        return $treeBuilder;
    }
}