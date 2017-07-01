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
                           'user_id' TEXT NOT NULL REFERENCES user(id) ON DELETE CASCADE,
                           'song_id' TEXT NOT NULL REFERENCES song(id) ON DELETE CASCADE,
                           UNIQUE (user_id, song_id) 
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

$userModels = [];
foreach ($users as $userData) {
    $user = \Deezer\Model\User::register($userData[0], $userData[1]);
    $userModels[] = $user;
    $command = new \Deezer\Command\CreateUser($container->pdo, $user);
    $command->execute();
}

$songs = [
    ['Never gonna', 120],
    ['Give you up', 15],
    ['Let you down', 80],
];

foreach ($songs as $songData) {
    $song = \Deezer\Model\Song::create($songData[0], $songData[1]);
    $command = new \Deezer\Command\CreateSong($container->pdo, $song);
    $command->execute();

    foreach ($userModels as $user) {
        $command = new \Deezer\Command\AddSongToUserFavorites($container->pdo, $user, $song);
        $command->execute();
    }
}