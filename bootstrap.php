<?php

//PSR4 Simple autoloader
spl_autoload_register(function ($class) {
    $file = sprintf(
        '%s'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'%s.php',
        __DIR__,
        implode(DIRECTORY_SEPARATOR, explode('/',$class))
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
    $routing = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'routing.php';
    return $routing;
});
