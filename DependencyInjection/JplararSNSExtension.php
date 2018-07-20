<?php

namespace Jplarar\SNSBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class JplararSNSExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        if (!isset($config['amazon_sns']['amazon_sns_key'])) {
            throw new \InvalidArgumentException(
                'The option "jplarar_sns.amazon_sns.amazon_sns_key" must be set.'
            );
        }

        $container->setParameter(
            'jplarar_sns.amazon_sns.amazon_sns_key',
            $config['amazon_sns']['amazon_sns_key']
        );

        if (!isset($config['amazon_sns']['amazon_sns_secret'])) {
            throw new \InvalidArgumentException(
                'The option "jplarar_sns.amazon_sns.amazon_sns_secret" must be set.'
            );
        }

        $container->setParameter(
            'jplarar_sns.amazon_sns.amazon_sns_secret',
            $config['amazon_sns']['amazon_sns_secret']
        );


        if (!isset($config['amazon_sns']['amazon_sns_region'])) {
            throw new \InvalidArgumentException(
                'The option "jplarar_sns.amazon_sns.amazon_sns_region" must be set.'
            );
        }

        $container->setParameter(
            'jplarar_sns.amazon_sns.amazon_sns_region',
            $config['amazon_sns']['amazon_sns_region']
        );
    }

    /**
     * {@inheritdoc}
     * @version 0.0.1
     * @since 0.0.1
     */
    public function getAlias()
    {
        return 'jplarar_sns';
    }
}
