<?php

declare(strict_types=1);

return [
    'oauth_key' => [
         'api' => [
            'url' => 'http://api.grocelivery.eu/auth/keys/public',
         ],
    ],
    'geolocalizer' => [
        'host' => env('GEOLOCALIZER_HOST', 'http://api.grocelivery.eu/map'),
    ],
];