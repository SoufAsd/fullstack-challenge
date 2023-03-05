<?php

declare(strict_types=1);

use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\Repositories\MemoryRepository;

return [

    /*
    |--------------------------------------------------------------------------
    | Default MQTT Connection
    |--------------------------------------------------------------------------
    |
    | This setting defines the default MQTT connection returned when requesting
    | a connection without name from the facade.
    |
    */

    'default_connection' => 'public',

    'connections' => [
        'private' => [
            'host' => 'mqtt.example.com',
            'port' => 1883,
        ],
        'public' => [
            'host' => 'test.mosquitto.org',
            'port' => 1883,
        ],
    ],
];
