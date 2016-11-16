<?php

namespace BitWeb\CronModule\Factory;

use BitWeb\CronModule\Configuration;
use BitWeb\CronModule\Service\CronService;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class CronServiceFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container,
                             $requestedName, array $options = null)
    {
        $config = $container->get('Config');
        $config = $config['cronModule'];

        return new CronService(new Configuration($config));
    }
}