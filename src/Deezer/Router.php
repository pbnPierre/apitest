<?php
namespace Deezer;

use Deezer\HTTP\Exception\NotFoundException;
use Deezer\HTTP\Response;

class Router {
    protected $routeConfigurations = [];

    public function addRoute(string $regex, $class, $method, $httpMethod ='GET'): self {
        $this->routeConfigurations[]  = [
            'match' => $regex,
            'httpMethod' => $httpMethod,
            'class' => $class,
            'method' => $method
        ];

        return $this;
    }

    public function match($uri, $httpMethod): Response {
        foreach ($this->routeConfigurations as $configuration) {
            $params = [];
            if ($httpMethod === $configuration['httpMethod']
                && 1 === preg_match('~^'.$configuration['match'].'~', $uri, $params)) {
                //Remove matched string from params
                unset($params[0]);
                return $this->callController($configuration['class'], $configuration['method'], $params);
            }
        }

        throw new NotFoundException('No route found for uri '.$uri);
    }

    protected function callController(string $class, string $method, array $params) : Response {
        if (!class_exists($class)) {
            throw new \InvalidArgumentException(sprintf('Class %s does not exist', $class));
        }
        $controller = new $class();
        if (!method_exists($controller, $method)) {
            throw new \InvalidArgumentException(sprintf('Method %s does not exist for class %s', $method, $class));
        }
        return $controller->$method(...$params);
    }
}