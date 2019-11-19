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
use ReflectionClass;
use ReflectionException;

class RouteServiceProvider
{
    protected static $routes;
    protected static $namespace = '\\App\Controllers\\';

    /**
     * RouteServiceProvider constructor.
     */
    public function __construct()
    {
        self::$routes = [];
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
        $httpMethod = $_SERVER['REQUEST_METHOD'];

        if (array_key_exists($route, self::$routes)) {
            if (array_key_exists($httpMethod, self::$routes[$route])) {

                $routeData = self::getControllerAction(self::$routes[$route][$httpMethod]);
                $class     = self::$namespace . ucfirst($routeData['controller']);
                $action    = $routeData['action'];

                if (class_exists($class)) {
                    $controller = self::getConstructorClass($class);

                    if (method_exists($controller, $action)) {
                        $controller->{$action}();
                    } else {
                        throw new ActionNotFoundException();
                    }
                } else {
                    throw new ClassNotFoundException();
                }
            } else {
                throw new MethodNotAllowedException();
            }
        } else {
            throw new RouteNotFoundException();
        }
    }

    /**
     * @param string $route
     *
     * @return array
     */
    private static function getControllerAction(string $route): array
    {
        $routeExploded = explode('@', $route);

        return [
            'controller' => $routeExploded[0],
            'action'     => $routeExploded[1]
        ];
    }

    /**
     * @param string $route
     * @param string $action
     */
    public static function get(string $route, string $action): void
    {
        self::$routes[$route]['GET'] = $action;
    }

    /**
     * @param string $route
     * @param string $action
     */
    public static function post(string $route, string $action): void
    {
        self::$routes[$route]['POST'] = $action;
    }

    /**
     * @param string $route
     * @param string $action
     */
    public static function put(string $route, string $action): void
    {
        self::$routes[$route]['PUT'] = $action;
    }

    /**
     * @param string $route
     * @param string $action
     */
    public static function delete(string $route, string $action): void
    {
        self::$routes[$route]['DELETE'] = $action;
    }

    /**
     * @param string $class
     *
     * @return mixed
     * @throws ReflectionException
     */
    private static function getConstructorClass(string $class)
    {
        $reflectionClass            = new ReflectionClass($class);
        $reflectionClassConstructor = $reflectionClass->getConstructor();
        $constructorParams          = [];

        if (!is_null($reflectionClassConstructor)) {
            $reflectionParams = $reflectionClassConstructor->getParameters();

            foreach ($reflectionParams as $reflectionParam) {
                $param               = $reflectionParam->getType()->getName();
                $constructorParams[] = self::getConstructorClass($param);
            }
        }

        return new $class(...$constructorParams);
    }
}