<?php
require_once __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'bootstrap.php';

$sql ='
    DROP Table IF EXISTS user;
    DROP Table IF EXISTS song;
    DROP Table IF EXISTS user_song;
    
    CREATE TABLE user (
       id CHAR(16) NOT NULL UNIQUE,
       name INT(11) NOT NULL,
       email VARCHAR(320) NOT NULL UNIQUE,
       INDEX index_email (email),
       PRIMARY KEY(id),
    ) DEFAULT CHARACTER SET utf8;
    
    CREATE TABLE user_song (
       user_id INT(11) NOT NULL,
       song_id VARCHAR(320) NOT NULL UNIQUE,
       INDEX index_user_id (user_id),
       FOREIGN KEY(user_id) REFERENCES user(id) ON DELETE CASCADE,
    ) DEFAULT CHARACTER SET utf8;
    
    CREATE TABLE song (
       user_id INT(11) NOT NULL,
       song_id VARCHAR(320) NOT NULL UNIQUE,
       INDEX index_user_id (user_id),
       FOREIGN KEY(user_id) REFERENCES user(id) ON DELETE CASCADE,
    ) DEFAULT CHARACTER SET utf8;
';

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