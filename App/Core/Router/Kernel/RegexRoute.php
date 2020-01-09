<?php
/**
 * Created by PhpStorm.
 * User: pablo
 * Date: 22/11/2019
 * Time: 01:47
 */

namespace App\Core\Router\Kernel;

use App\Core\Exceptions\ActionNotFoundException;
use App\Core\Exceptions\ClassNotFoundException;
use App\Core\Exceptions\MethodNotAllowedException;
use App\Core\Exceptions\RouteNotFoundException;
use App\Core\Request;
use App\Core\Router\Router;

class RegexRoute
{
    /**
     * @var RouterDi
     */
    private $routerDi;

    /**
     * @var RouteBuilder
     */
    private $routeBuilder;

    /**
     * @var string
     */
    private $namespace = '\\App\Controllers\\';

    /**
     * RouteRegex constructor.
     */
    public function __construct()
    {
        $this->routerDi     = new RouterDi();
        $this->routeBuilder = new RouteBuilder();
    }

    /**
     * @param string $httpMethod
     * @param array  $regexData
     * @param array  $routeArray
     *
     * @throws \ReflectionException
     * @throws ActionNotFoundException
     * @throws ClassNotFoundException
     * @throws MethodNotAllowedException
     */
    public function handle(string $httpMethod, array $regexData, array $routeArray): void
    {
        if (array_key_exists($httpMethod, $routeArray[$regexData['route']])) {

            $routeData = $this->routeBuilder->build($routeArray[$regexData['route']][$httpMethod]);
            $class     = $this->namespace . ucfirst($routeData['controller']);
            $action    = $routeData['action'];

            if (class_exists($class)) {
                $controller = $this->routerDi->getConstructorClass($class);

                if (method_exists($controller, $action)) {
                    $customParams = [];

                    foreach ($regexData['params'] as $key => $param) {
                        $customParams[$key] = $param;
                    }
                    $controller->{$action}(new Request($customParams));
                }
                throw new ActionNotFoundException();
            }
            throw new ClassNotFoundException();
        }
        throw new MethodNotAllowedException();
    }

    /**
     * @param string $route
     *
     * @return array|null
     * @throws RouteNotFoundException
     */
    public function resolve(string $route): ?array
    {
        foreach (Router::getRoutesRegex() as $routePath => $routeData) {

            $pattern = preg_replace(['/\//', '/\{\$([^}]+)\}/'], ['\\/', '(?P<$1>[^\/]+)'], $routePath);
            $pattern = "/{$pattern}/";

            preg_match($pattern, $route, $matches);

            if (!empty($matches)) {
                $matches = array_unique($matches);
                array_shift($matches);

                return [
                    'route'  => $routePath,
                    'params' => array_unique($matches)
                ];
            }
        }

        throw new RouteNotFoundException();
    }
}