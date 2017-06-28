<?php
require_once __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'bootstrap.php';
$container->router->addRoute('/user', function () {
    $controller = new \Deezer\Controller\User();
    return $controller->index();
});

try {
    $response = $container->router->match($_SERVER['PATH_INFO'], $_SERVER['REQUEST_METHOD']);
} catch (\Deezer\HTTP\Exception\NotFoundException $e) {
    $response = $container->notFoundResponse;
}

$response->sendHeaders();
http_response_code($response->getStatusCode());
echo $response->getBody();