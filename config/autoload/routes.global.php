<?php

$regex = '[a-z0-9]+';

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\FastRouteRouter::class,
        ],
    ],

    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'middleware' => App\Action\HomePageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'api',
            'path' => '/api/{domain:[a-zA-Z]+}[/{resource:[a-zA-Z]+}[/{action:[a-zA-Z]+}[/{resourceId:'.$regex.'}]]]',
            'middleware' => App\Action\ApiAction::class,
            'allowed_methods' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'],
        ]
       
    ],
];
