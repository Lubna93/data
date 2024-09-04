<?php

namespace App\lib\CasCuardBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('l3_cas_cuard');

        $treeBuilder->getRootNode()
            ->children()
            ->scalarNode('host2')->defaultValue(300)->end()
            // ->scalarNode('host')->defaultValue('cas.univ-montp3.fr')->end()
            ->scalarNode('path2')->defaultValue('')->end()
            ->scalarNode('port2')->defaultValue(443)->end()
            ->scalarNode('ca2')->defaultNull()->end()
            ->booleanNode('handleLogoutRequest2')->defaultValue(false)->end()
            ->scalarNode('casLogoutTarget2')->defaultNull()->end()
            ->booleanNode('force2')->defaultValue(true)->end()
            ->booleanNode('gateway2')->defaultValue(true)->end()

            ->end();

        return $treeBuilder;
    }
}
