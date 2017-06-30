<?php
namespace Deezer;

use Deezer\DIC\SimpleDIC;
use Deezer\HTTP\Exception\NotFoundException;
use Deezer\HTTP\Response;

class Router {
    protected $routeConfigurations = [];

    public function addRoute(string $regex, string $class, string $method, string $httpMethod ='GET'): self {
        $this->routeConfigurations[]  = [
            'match' => $regex,
            'httpMethod' => $httpMethod,
            'class' => $class,
            'method' => $method
        ];

        return $this;
    }

    /**
     * @param string $prefix
     * @param array $configurations
     */
    public function mount(string $prefix, array $configurations){

    }

    public function match(SimpleDIC $container, $uri, $httpMethod): Response {
        foreach ($this->routeConfigurations as $configuration) {
            $params = [];
            if ($httpMethod === $configuration['httpMethod']
                && 1 === preg_match('~^'.$configuration['match'].'/?$~', $uri, $params)) {
                //Remove matched string from params
                unset($params[0]);
                return $this->callController($container, $configuration['class'], $configuration['method'], $params);
            }
        }

        throw new NotFoundException('No route found for uri '.$uri);
    }

    protected function callController(SimpleDIC $container, string $class, string $method, array $params) : Response {
        if (!class_exists($class)) {
            throw new \InvalidArgumentException(sprintf('Class %s does not exist', $class));
        }
        $controller = new $class();
        if (!method_exists($controller, $method)) {
            throw new \InvalidArgumentException(sprintf('Method %s does not exist for class %s', $method, $class));
        }
        return $controller->$method($container, ...$params);
    }
}