<?php

//PSR4 Simple autoloader
spl_autoload_register(function ($class) {
    $file = sprintf(
        __DIR__.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'%s.php',
        implode(DIRECTORY_SEPARATOR, explode('\\',$class))
    );

    // if the file exists, require it
    if (file_exists($file)) {
        require_once $file;
    }
});

$container = new \Deezer\DIC\SimpleDIC();

$container->share('router', function() {
    return new \Deezer\Router();
});
$container->share('notFoundResponse', function() {
    $response = new \Deezer\HTTP\HTMLResponse('<img src="https://http.cat/404"/>');
    $response->setStatusCode(404);
    return $response;
});
$container->share('routing', function() {
    $routing = require_once __DIR__.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'routing.php';
    return $routing;
});
$container->share('pdo', function() {
    return new PDO('sqlite:'. __DIR__.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'deezer.sqlite');
});