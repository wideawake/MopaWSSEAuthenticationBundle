## Introduction

The MopaWSSEAuthentication bundle is a simple and easy way to implement WSSE authentication into Symfony2 applications

## Installation

app/autoload.php

```
$loader->registerNamespaces(array(
    //other namespaces
    'Mopa' => __DIR__.'/../vendor/bundles',
  ));
```

app/AppKernel.php

```
public function registerBundles()
{
    return array(
        //other bundles
        new Mopa\WSSEAuthenticationBundle\MopaWSSEAuthenticationBundle(),
    );
    ...
```

## Configuration

app/config/config.yml

```
# Mopa Rackspace Cloud Files configuration
mopa_wsse_authentication:
    provider_class: Mopa\WSSEAuthenticationBundle\Security\Authentication\Provider\Provider
    listener_class: Mopa\WSSEAuthenticationBundle\Security\Firewall\Listener
    factory_class: Mopa\WSSEAuthenticationBundle\Security\Factory\WSSEFactory
```

## Usage example

app/config/security.yml

nonce_dir: location where nonces will be saved (use null to skip nonce-validation)
lifetime: lifetime of nonce
provider: user provider for wsse, optional, if not set first user provider configured will be used

```
firewalls:
    wsse_secured:
        pattern:   ^/api/.*
        wsse:
            nonce_dir: null
            lifetime: 300
            provider: my_user_provider

factories:
    - "%kernel.root_dir%/../vendor/bundles/Mopa/WSSEAuthenticationBundle/Resources/config/security_factories.yml"
```
