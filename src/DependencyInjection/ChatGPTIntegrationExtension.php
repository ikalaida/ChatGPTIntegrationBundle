<?php

namespace HCH\ChatGPTIntegrationBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

class ChatGPTIntegrationExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new PhpFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        $container->setParameter('chatgpt_integration.api_key', $config['api_key']);
        $container->setParameter('chatgpt_integration.api_url', $config['api_url']);
        $container->setParameter('chatgpt_integration.model', $config['model']);
    }
}
