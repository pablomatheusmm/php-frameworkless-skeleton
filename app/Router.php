<?php

namespace App;

use Exception;

class Router
{
    private $routes;

    const CONTROLLER_NAMESPACE = '\\App\Controllers\\';

    public function __construct()
    {
        $this->routes = [
            'servico/salvar/' => 'servicoController@salvar',
            'servico/editar/' => 'servicoController@editar'
        ];
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function getRoute(string $route): void
    {
        if (array_key_exists($route, $this->routes)) {
            $routeData = $this->explodeRoute($this->routes[$route]);
            $class     = self::CONTROLLER_NAMESPACE . ucfirst($routeData['controller']);
            $action    = $routeData['action'];

            if (class_exists($class)) {
                $controller = new $class;
                if (method_exists($controller, $action)) {
                    $controller->{$action}();
                } else {
                    echo 'acao nao existe';
                }
            } else {
                echo 'Eita, não existe..' . $class;
            }
        } else {
            throw new Exception('Route not found',404);
        }
    }

    private function explodeRoute(string $route)
    {
        $routeExploded = explode('@', $route);

        return [
            'controller' => $routeExploded[0],
            'action'     => $routeExploded[1]
        ];
    }
}