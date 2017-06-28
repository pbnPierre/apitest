<?php
namespace Deezer;

use Deezer\HTTP\Exception\NotFoundException;
use Deezer\HTTP\Response;

class Router {
    protected $routeConfigurations = [];

    public function addRoute(string $regex, callable $callBack, $method ='GET'): self {
        $this->routeConfigurations[]  = [
            'match' => $regex,
            'method' => $method,
            'callback' => $callBack
        ];

        return $this;
    }

    public function match($uri, $method): Response {
        foreach ($this->routeConfigurations as $configuration) {
            $params = [];
            if ($method === $configuration['method']
                && 1 === preg_match('~^'.$configuration['match'].'~', $uri, $params)) {
                return $configuration['callback']();
            }
        }

        throw new NotFoundException('No route found for uri '.$uri);
    }
}