<?php

use Monolog\Logger;
use Symfony\Component\Yaml\Yaml;

return [

    'parameters' => Yaml::parse(file_get_contents(__DIR__ . '/parameters.yml'))['parameters'],

    'sentinel' => require __DIR__ . '/sentinel.php',

    'oauth' => [
        'pdo' => [
            'user_table' => 'user'
        ]
    ],

    'rest' => [
        // All URLs generated with the RestRouter will be prefixed with this.
        'prefix' => '/api',
        // Default placeholder to use for single resources.
        'key'    => 'id',
        /**
         * Default requirement for single resources route placeholder.
         * To disable it, use empty string ('') rather than null.
         */
        'requirement' => '[0-9]+',
        // The routes that should be generated by the CRUD method of the RestRouter.
        'crud' => [
            'get'               => true,
            'get_collection'    => true,
            'post'              => true,
            'put'               => true,
            'delete'            => true,
            'delete_collection' => false
        ]
    ],

    'cors' => [
        'origin'         => '*',
        'allow_headers'  => 'X-Requested-With, Content-Type, Accept, Origin, Authorization',
        'expose_headers' => 'Location, Content-Range',
        'methods'        => 'GET, POST, PUT, PATCH, DELETE',
        'max_age'        => 3600
    ],

    'monolog' => [
        'name' => 'app',
        'path' => $app->getLogDir().'/'.$app->getEnvironment().'.log',
        'level' => Logger::ERROR
    ]

];