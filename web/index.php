<?php
require_once __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'bootstrap.php';

foreach ($container->routing as $route)  {
    $httpMethod = $route['httpMethod']??'GET';
    $container->router->addRoute($route['match'], $route['class'], $route['method'], $httpMethod);
}

try {
    $request = new \Deezer\HTTP\Request();
    $response = $container->router->match($container, $request);
} catch (\Deezer\HTTP\Exception\NotFoundException $e) {
    $response = $container->notFoundResponse;
    $response->addHeader('X-Error', $e->getMessage());
} catch (\InvalidArgumentException $e) {
    $response = $container->badRequestResponse;
    $response->addHeader('X-Error', $e->getMessage());
} catch (\OutOfRangeException $e) {
    $response = $container->badRequestResponse;
    $response->addHeader('X-Error', $e->getMessage());
}

//Dirty and lasy mode to reset my database for tests
if ($container->request->get('resetDatabase') !== false) {
    require_once __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'data'.DIRECTORY_SEPARATOR.'dataFixtures.php';
}
$response->sendHeaders();
http_response_code($response->getStatusCode());
echo $response->getBody();