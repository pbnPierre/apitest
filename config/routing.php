<?php
$routing = [
    //Proxy to avoid CORS issues
    [
        'match' => '/proxy',
        'class' => \Deezer\Controller\Proxy::class,
        'method' => 'index'
    ],
    //Front
    [
        'match' => '/front',
        'class' => \Deezer\Controller\Front::class,
        'method' => 'index'
    ],
    //User
    [
        'match' => '/users',
        'class' => \Deezer\Controller\User::class,
        'method' => 'index'
    ],
    [
        'match' => '/users/offset/(\d+)/limit/(\d+)',
        'class' => \Deezer\Controller\User::class,
        'method' => 'index'
    ],
    [
        'match' => '/users/(\w+)',
        'class' => \Deezer\Controller\User::class,
        'method' => 'get'
    ],
    [
        'match' => '/users/(\w+)/favoritesSongs',
        'class' => \Deezer\Controller\User::class,
        'method' => 'getFavoriteSongs'
    ],
    [
        'match' => '/users/(\w+)/favoritesSongs/(\w+)',
        'class' => \Deezer\Controller\User::class,
        'method' => 'addSongToFavorite',
        'httpMethod' => 'POST'
    ],
    [
        'match' => '/users/(\w+)/favoritesSongs/(\w+)',
        'class' => \Deezer\Controller\User::class,
        'method' => 'removeFavoriteSong',
        'httpMethod' => 'DELETE'
    ],
    //Song
    [
        'match' => '/songs',
        'class' => \Deezer\Controller\Song::class,
        'method' => 'index'
    ],
    [
        'match' => '/songs/offset/(\d+)/limit/(\d+)',
        'class' => \Deezer\Controller\Song::class,
        'method' => 'index'
    ],
    [
        'match' => '/songs/(\w+)',
        'class' => \Deezer\Controller\Song::class,
        'method' => 'get'
    ]
];

return $routing;
