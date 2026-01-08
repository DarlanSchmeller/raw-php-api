<?php

namespace App\Framework;

class Router
{
    protected array $routes;

    public function registerRoute($method, string $uri, $action): void
    {
        [$controller, $controllerMethod] = explode('@', $action);

        $this->routes[] = [
            'method' => strtoupper($method),
            'uri' => $uri,
            'controller' => $controller,
            'controllerMethod' => $controllerMethod
        ];
    }

    public function handleRequest(): void
    {
        // Get the requested url parsed
        $requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $pathSegments = explode('/', trim($requestPath, '/'));

        // Check if route exists
        [$route, $params] = $this->matchRoute($pathSegments);
        if (empty($route)) {
            http_response_code(404);
            exit();
        }

        $controller = 'App\\Controllers\\' . $route['controller'];
        $controllerMethod = $route['controllerMethod'];
        
        // Instantiate controller and execute method
        $controllerInstance = new $controller();
        $controllerInstance->$controllerMethod($params);

        return;
    }

    protected function matchRoute(array $pathSegments): ?array
    {
        // Get incoming request data
        $uri = $pathSegments[0] ?? null;
        $params = $pathSegments[1] ?? null;
        $method = $_SERVER['REQUEST_METHOD'];

        $fallbackRoute = null;
        $routeWithParams = null;

        foreach ($this->routes as $route) {
            // Early skip if method doesn't match
            if ($method !== $route['method']) {
                continue;
            }

            // Get parts of the registered url
            $pagePath = explode('/', trim($route['uri'], '/'));
            $pageURI = $pagePath[0] ?? null;
            $expectsParams = isset($pagePath[1]);

            if ($pageURI !== $uri) {
                continue;
            }
            
            if ($expectsParams) {
                if (! empty($params)) {
                    $routeWithParams = [$route, $params];
                }

                continue;
            }

            $fallbackRoute = [$route, null];
        }

        // Get the most specific matched route
        return $routeWithParams ?? $fallbackRoute;
    }
}
