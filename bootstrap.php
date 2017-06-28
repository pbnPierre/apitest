<?php

//PSR4 Simple autoloader
spl_autoload_register(function ($class) {
    $file = sprintf(
        '%s../src/%s',
        __DIR__,
        $class,
        '.php'
    );

    // if the file exists, require it
    if (file_exists($file)) {
        require_once $file;
    }
});

$container = new \Deezer\DIC\SimpleDIC();
