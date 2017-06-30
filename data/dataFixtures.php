<?php
require_once __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'bootstrap.php';

$container->pdo->exec("DROP Table IF EXISTS user;
                       DROP Table IF EXISTS song;
                       DROP Table IF EXISTS user_song;");

$container->pdo->exec("CREATE TABLE user(
                         'id' TEXT UNIQUE NOT NULL PRIMARY KEY,
                         'name' TEXT NOT NULL,
                         'email' TEXT  NOT NULL UNIQUE
                       );");

$container->pdo->exec("CREATE TABLE user_song(
                           'user_id' TEXT NOT NULL UNIQUE REFERENCES user(id) ON DELETE CASCADE,
                           'song_id' TEXT NOT NULL UNIQUE REFERENCES song(id) ON DELETE CASCADE
                        );
                        CREATE INDEX index_user_id_song ON user_song(user_id);");

$container->pdo->exec("CREATE TABLE song(
                       'id' TEXT UNIQUE NOT NULL PRIMARY KEY,
                       'name' TEXT NOT NULL,
                       'length' INTEGER NOT NULL
                    );");

$users = [
    ['Georges Abitdbol', 'gabitdbol@gmail.com'],
    ['John Doe', 'jdoe@gmail.com'],
    ['Me Maillessailfe', 'me@gmail.com'],
];

foreach ($users as $userData) {
    $userModel = \Deezer\Model\User::register($userData[0], $userData[1]);
    $command = new \Deezer\Command\CreateUser($container->pdo, $userModel);
    $command->execute();
}

$songs = [
    ['Never gonna', 120],
    ['Give you up', 15],
    ['Let you down', 80],
];

foreach ($songs as $songData) {
    $songModel = \Deezer\Model\Song::create($userData[0], $userData[1]);
    $command = new \Deezer\Command\CreateSong($container->pdo, $songModel);
    $command->execute();
}