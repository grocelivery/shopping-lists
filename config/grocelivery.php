<?php

declare(strict_types=1);

return [
    'oauth_key' => [
         'api' => [
            'url' => 'http://idp-webserver',
         ],
    ],
    'geolocalizer' => [
        'host' => env('GEOLOCALIZER_HOST', 'http://geolocalizer-webserver'),
    ],
];