<?php
$routing = [
    //User
    [
        'match' => '/user',
        'class' => \Deezer\Controller\User::class,
        'method' => 'index'
    ],
    [
        'match' => '/user/offset/(\d+)/limit/(\d+)',
        'class' => \Deezer\Controller\User::class,
        'method' => 'index'
    ],
    [
        'match' => '/user/(\w+)',
        'class' => \Deezer\Controller\User::class,
        'method' => 'get'
    ],
    //Song
    [
        'match' => '/song',
        'class' => \Deezer\Controller\Song::class,
        'method' => 'index'
    ],
    [
        'match' => '/song/offset/(\d+)/limit/(\d+)',
        'class' => \Deezer\Controller\Song::class,
        'method' => 'index'
    ],
    [
        'match' => '/song/(\w+)',
        'class' => \Deezer\Controller\Song::class,
        'method' => 'get'
    ]
];

return $routing;
