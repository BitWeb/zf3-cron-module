<?php

return [
    'invokables' => [
        'BitWeb\CronModule\Controller\Index' => 'BitWeb\CronModule\Controller\IndexController'
    ],
    'initializers' => [
        function (\Zend\ServiceManager\ServiceManager $cm, $controller) {
            if ($controller instanceof \BitWeb\CronModule\Service\Cron\CronServiceAwareInterface) {
                $controller->setCronService($cm->get('BitWeb\CronModule\Service\Cron'));
            }

            return $controller;
        }
    ]
];