<?php

namespace Mopa\Bundle\WSSEAuthenticationBundle\Security\Factory;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\AbstractFactory;

class WsseFactory extends AbstractFactory
{
    protected function createAuthProvider(ContainerBuilder $container, $id, $config, $userProviderId)
    {
        $authProviderId = 'mopa_wsse_authentication.'.$id;

        $definition = $container
            ->setDefinition($authProviderId, new DefinitionDecorator('mopa_wsse_authentication'))
            ->replaceArgument(0, $id)
            ->replaceArgument(1, $config['nonce_dir'])
            ->replaceArgument(2, $config['lifetime'])
            ->addArgument(new Reference($userProviderId))
            ->addArgument(new Reference('security.user_checker'));

        return $authProviderId;
    }

    protected function getListenerId()
    {
        return 'mopa_wsse_authentication.security.listener';
    }
    protected function isRememberMeAware($config)
    {
        return false;
    }

    public function getPosition()
    {
        return 'pre_auth';
    }

    public function getKey()
    {
        return 'wsse';
    }

    public function addConfiguration(NodeDefinition $node)
    {
        $node
            ->children()
                ->scalarNode('nonce_dir')->defaultValue(null)->end()
                ->scalarNode('lifetime')->defaultValue(300)->end()
                ->scalarNode('provider')->end()
            ->end()
        ;
    }
}
