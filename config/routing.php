<?php
$routing = [
    [
        'match' => '/user',
        'callback' => [
            'class' => \Deezer\HTTP\Controller\User::class,
            'method' => 'index'
        ]
    ],
    [
        'match' => '/user/(\w+)',
        'callback' => [
            'class' => \Deezer\HTTP\Controller\User::class,
            'method' => 'get'
        ]
    ]
];

return $routing;
