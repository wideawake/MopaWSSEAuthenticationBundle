<?php

namespace Mopa\WSSEAuthenticationBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('mopa_wsse_authentication');

        $rootNode
	        ->children()
    		    ->scalarNode('provider_class')->defaultValue('Mopa\WSSEAuthenticationBundle\Security\Authentication\Provider\WsseAuthenticationProvider')->end()
        		->scalarNode('listener_class')->defaultValue('Mopa\WSSEAuthenticationBundle\Security\Firewall\WsseListener')->end()
        		->scalarNode('factory_class')->defaultValue('Mopa\WSSEAuthenticationBundle\Security\Factory\WsseFactory')->end()
        	->end()
        ;

        return $treeBuilder;
    }
}