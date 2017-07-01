<?php
declare(strict_types = 1);

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

$container->share('notFoundResponse', function() {
    $response = new \Deezer\HTTP\HTMLHTTPCodeResponse(404);
    return $response;
});
$container->share('badRequestResponse', function() {
    $response = new \Deezer\HTTP\HTMLHTTPCodeResponse(400);
    return $response;
});
$container->share('routing', function() {
    $routing = require_once __DIR__.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'routing.php';
    return $routing;
});
$container->share('pdo', function() {
    $pdo= new \PDO('sqlite:'. __DIR__.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'deezer.sqlite');
    $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    return $pdo;
});
$container->share('request', function() use ($container) {
    return new \Deezer\HTTP\Request();
});
$container->share('router', function() use ($container) {
    return new \Deezer\Router();
});
