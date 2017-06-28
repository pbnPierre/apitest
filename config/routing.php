<?php
$routing = [
    [
        'match' => '/user',
        'callback' => [
            'class' => \Deezer\HTTP\Controller\User::class,
            'method' => 'index'
        ]
    ]
];
