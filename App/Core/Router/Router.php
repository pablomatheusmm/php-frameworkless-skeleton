<?php
/**
 * Created by PhpStorm.
 * User: pablo
 * Date: 22/11/2019
 * Time: 02:11
 */

namespace App\Core\Router;

class Router
{
    protected static $routes;
    protected static $routesRegex;

    public function __construct()
    {
        self::$routes      = [];
        self::$routesRegex = [];
    }

    /**
     * @param string $route
     * @param string $action
     */
    public static function get(string $route, string $action): void
    {
        self::addRoute($route, $action, 'GET');
    }

    /**
     * @param string $route
     * @param string $action
     */
    public static function post(string $route, string $action): void
    {
        self::addRoute($route, $action, 'POST');
    }

    /**
     * @param string $route
     * @param string $action
     */
    public static function delete(string $route, string $action): void
    {
        self::addRoute($route, $action, 'DELETE');
    }

    /**
     * @param string $routeConfig
     * @param string $action
     * @param string $method
     */
    private static function addRoute(string $routeConfig, string $action, string $method)
    {
        if (self::isRouteRegex($routeConfig)) {
            self::$routesRegex[$routeConfig][$method] = $action;
        } else {
            self::$routes[$routeConfig][$method] = $action;
        }
    }

    /**
     * @param string $routeConfig
     *
     * @return bool
     */
    private static function isRouteRegex(string $routeConfig): bool
    {
        if (strpos($routeConfig, '{') !== false) {
            return true;
        }

        return false;
    }

    /**
     * @return array
     */
    public static function getRoutes(): array
    {
        return self::$routes;
    }

    /**
     * @return array
     */
    public static function getRoutesRegex(): array
    {
        return self::$routesRegex;
    }

}