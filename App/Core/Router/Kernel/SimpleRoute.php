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
use App\Core\Request;
use ReflectionException;

class SimpleRoute
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
    protected $namespace = '\\App\Controllers\\';

    /**
     * RouteRegex constructor.
     */
    public function __construct()
    {
        $this->routerDi     = new RouterDi();
        $this->routeBuilder = new RouteBuilder();
    }

    /**
     * @param string $route
     * @param        $httpMethod
     * @param array  $routeArray
     *
     * @throws ActionNotFoundException
     * @throws ClassNotFoundException
     * @throws MethodNotAllowedException
     * @throws ReflectionException
     */
    public function handle(string $route, $httpMethod, array $routeArray): void
    {
        if (array_key_exists($httpMethod, $routeArray[$route])) {

            $routeData = $this->routeBuilder->build($routeArray[$route][$httpMethod]);
            $class     = $this->namespace . ucfirst($routeData['controller']);
            $action    = $routeData['action'];

            if (class_exists($class)) {
                $controller = $this->routerDi->getConstructorClass($class);

                if (method_exists($controller, $action)) {
                    $controller->{$action}(new Request());
                } else {
                    throw new ActionNotFoundException();
                }
            } else {
                throw new ClassNotFoundException();
            }
        } else {
            throw new MethodNotAllowedException();
        }
    }
}