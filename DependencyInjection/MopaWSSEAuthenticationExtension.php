<?php

namespace Mopa\Bundle\WSSEAuthenticationBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Config\FileLocator;

class MopaWSSEAuthenticationExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        foreach (array("security.yml", "services.yml") as $file) {
            $loader->load($file);
        }

        $container->setParameter('mopa_wsse_authentication.provider.class', $config['provider_class']);
        $container->setParameter('mopa_wsse_authentication.security.listener.class', $config['listener_class']);
    }
}