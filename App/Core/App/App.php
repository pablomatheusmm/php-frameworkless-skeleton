<?php
/**
 * Created by PhpStorm.
 * User: pablo
 * Date: 16/11/2019
 * Time: 16:10
 */

namespace App\Core\App;

use App\Core\Exceptions\ActionNotFoundException;
use App\Core\Exceptions\ClassNotFoundException;
use App\Core\Exceptions\MethodNotAllowedException;
use App\Core\Exceptions\RouteNotFoundException;
use App\Core\Router;

class App
{
    private $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * @throws ActionNotFoundException
     * @throws ClassNotFoundException
     * @throws MethodNotAllowedException
     * @throws RouteNotFoundException
     */
    public function run()
    {
        $this->router->resolve();
    }
}