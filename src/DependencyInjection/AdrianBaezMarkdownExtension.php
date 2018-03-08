<?php

namespace AdrianBaez\Bundle\MarkdownBundle\DependencyInjection;

use AdrianBaez\Bundle\MarkdownBundle\Helper;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class AdrianBaezMarkdownExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yaml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        
        $helperDef = $container->getDefinition( Helper::class );
        $helperDef->addMethodCall('setDefaults', [$config['options']]);
        $helperDef->addMethodCall('setMarkdownParserClass', [$config['parsers']['markdown']]);
        $helperDef->addMethodCall('setMarkdownExtraParserClass', [$config['parsers']['markdown_extra']]);
    }
}
