<?php
/**
 * Created by PhpStorm.
 * User: Dcide
 * Date: 11/05/2016
 * Time: 17:09
 */

return [
    'doctrine'=> [
        'connection' =>[
            'orm_default' =>[
                'driver' => 'mysqli',
                'host' => 'localhost',
                'port' => '3306',
                'user' => 'root',
                'password' => '',
                'dbname' => 'code_generator',
            ]
        ],
        'orm' =>[
            'proxy_dir'=>'data/cache/EntityProxy',
            'proxy_namespace'=>'EntityProxy',
            'auto_generate_proxy_classes' => false,
            'underscore_naming_strategy'=> false
        ],
        'config' =>[
            'entity_paths'=>[
                'src\App\Entity'
            ]
        ],
        'cache'=> [
            'redis'=>[
                'host' => '192.168.0.35',
                'port' => '6379',
            ]
        ]
    ]
];