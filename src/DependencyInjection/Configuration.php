<?php

namespace Lemonmind\PimcoreSimpleSeoBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('lemon_mind_pimcore_simple_seo');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->scalarNode('thumbnail_name')
                    ->defaultValue('meta_image')
                ->end()
                ->arrayNode('title_pattern')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('before')
                            ->defaultNull()
                        ->end()
                        ->scalarNode('after')
                            ->defaultNull()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
