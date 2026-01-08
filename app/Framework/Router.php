<?php

namespace App\Framework;

class Router
{
    protected array $routes;

    public function registerRoute(string $uri, $action): void
    {
        [$controller, $method] = explode('@', $action);

        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method
        ];
    }

    public function handleRequest(): void
    {
        // Get the requested url parsed
        $requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $pathSegments = explode('/', trim($requestPath, '/'));

        // Check if route exists
        $route = $this->matchRoute($pathSegments);
        if (empty($route)) {
            http_response_code(404);
            exit();
        }

        $controller = 'App\\Controllers\\' . $route['controller'];
        $controllerMethod = $route['method'];
        
        // Instantiate controller and execute method
        $controllerInstance = new $controller();
        $controllerInstance->$controllerMethod();

        return;
    }

    protected function matchRoute(array $pathSegments): ?array
    {
        $uri = $pathSegments[0];

        foreach ($this->routes as $route) {
            if (trim($route['uri'], '/') === $uri) {
                return $route;
            };
        }

        return null;
    }
}
