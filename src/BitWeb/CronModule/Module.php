<?php

namespace BitWeb\CronModule;

use Zend\Console\Adapter\AdapterInterface;
use Zend\ModuleManager\Feature\ControllerProviderInterface;
use Zend\ServiceManager\ServiceManager;

class Module implements ControllerProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../../../config/module.config.php';
    }

    public function getControllerConfig()
    {
        return [
            'invokables' => [
                'BitWeb\CronModule\Controller\Index' => 'BitWeb\CronModule\Controller\IndexController'
            ],
            'initializers' => [
                function (ServiceManager $cm, $controller) {
                    if ($controller instanceof \BitWeb\CronModule\Service\Cron\CronServiceAwareInterface) {
                        $controller->setCronService($cm->get('BitWeb\CronModule\Service\Cron'));
                    }

                    return $controller;
                }
            ]

        ];
    }

    public function getAutoloaderConfig()
    {
        $dir = dirname(dirname(dirname(__DIR__)));
        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => $dir . '/src/' . __NAMESPACE__,
                ],
            ],
        ];
    }

    public function getConsoleUsage(AdapterInterface $console)
    {
        return [
            'cron module start' => 'Run cron processes.',
        ];
    }
}
