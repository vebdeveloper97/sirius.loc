<?php

return [
    'mysql' => [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=sirius',
        'username' => 'sirius',
        'password' => '571632',
        'charset' => 'utf8',

        // Schema cache options (for production environment)
        'enableSchemaCache' => true,
        'schemaCacheDuration' => 600,
        'schemaCache' => 'cache',
    ],
    'postgres' => [
        'class' => 'yii\db\Connection',
        'dsn' => 'pgsql:host=127.0.0.1;port=5432;dbname=sirius',
        'username' => 'sirius',
        'password' => '571632',
        'charset' => 'utf8',
        'tablePrefix' => '',
        'schemaMap' => [
            'pgsql' => [
                'class' => 'yii\db\pgsql\Schema',
                'defaultSchema' => 'public'
            ]
        ]
    ]
];
