<?php
/**
 * Created by PhpStorm.
 * User: pablo
 * Date: 18/11/2019
 * Time: 14:24
 */

namespace App\Providers;

use App\Core\Exceptions\ActionNotFoundException;
use App\Core\Exceptions\ClassNotFoundException;
use App\Core\Exceptions\MethodNotAllowedException;
use App\Core\Exceptions\RouteNotFoundException;
use App\Core\Request;
use App\Core\Router\Kernel\SimpleRoute;
use App\Core\Router\Router;
use App\Core\Router\Kernel\RegexRoute;
use ReflectionException;

class RouteServiceProvider
{
    private $request;

    /**
     * RouteServiceProvider constructor.
     */
    public function __construct()
    {
        $this->request = new Request();
    }

    /**
     * @param string $route
     *
     * @throws ActionNotFoundException
     * @throws ClassNotFoundException
     * @throws MethodNotAllowedException
     * @throws ReflectionException
     * @throws RouteNotFoundException
     */
    public static function resolve(string $route): void
    {
        $httpMethod = trim($_SERVER['REQUEST_METHOD'], '/');
        $route = trim($route, '/');

        if (array_key_exists($route, Router::getRoutes())) {
            $simpleRoute = new SimpleRoute();
            $simpleRoute->handle($route, $httpMethod, Router::getRoutes());
        } else {
            $routeRegex     = new RegexRoute();
            $routeRegexData = $routeRegex->resolve($route);

            if (is_array($routeRegexData)) {
                $routeRegex->handle($httpMethod, $routeRegexData, Router::getRoutesRegex());
            } else {
                throw new RouteNotFoundException();
            }
        }
    }
}