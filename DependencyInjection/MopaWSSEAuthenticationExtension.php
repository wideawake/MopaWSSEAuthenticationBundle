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

		$loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
		$loader->load('security.xml');

		$container->setParameter('mopa_wsse.authentication.provider.class', $config['provider_class']);
		$container->setParameter('mopa_wsse.authentication.listener.class', $config['listener_class']);
	}
}