<?php
error_reporting(E_ALL);
require_once __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'bootstrap.php';

foreach ($container->routing as $route) {
    $callbackParameters = $route['callback'];
    $httpMethod = $route['method']??'GET';

    $container->router->addRoute($route['match'], $callbackParameters['class'], $callbackParameters['method'], $httpMethod);
}

try {
    $response = $container->router->match($_SERVER['PATH_INFO'], $_SERVER['REQUEST_METHOD']);
} catch (\Deezer\HTTP\Exception\NotFoundException $e) {
    $response = $container->notFoundResponse;
}

$response->sendHeaders();
http_response_code($response->getStatusCode());
echo $response->getBody();