<?php

namespace AdrianBaez\Bundle\MarkdownBundle\DependencyInjection;

use AdrianBaez\Bundle\MarkdownBundle\MarkdownExtraParser;
use AdrianBaez\Bundle\MarkdownBundle\MarkdownParser;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('adrian_baez_markdown');
        $rootNode
            ->children()
                ->variableNode('options')
                ->defaultValue([])
                ->end()
                ->scalarNode('parser')->defaultValue(MarkdownParser::class)->end()
            ->end()
        ;
        return $treeBuilder;
    }
}
