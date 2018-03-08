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
                ->arrayNode('options')
                ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('urls_linked')->defaultTrue()->end()
                        ->booleanNode('breaks_enabled')->defaultFalse()->end()
                        ->booleanNode('markup_escaped')->defaultFalse()->end()
                        ->booleanNode('safe_mode')->defaultFalse()->end()
                    ->end()
                ->end()
                ->arrayNode('parsers')
                ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('markdown')->defaultValue(MarkdownParser::class)->end()
                        ->scalarNode('markdown_extra')->defaultValue(MarkdownExtraParser::class)->end()
                    ->end()
                ->end()
            ->end()
        ;
        return $treeBuilder;
    }
}
