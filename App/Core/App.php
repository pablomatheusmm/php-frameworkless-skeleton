<?php
/**
 * Created by PhpStorm.
 * User: pablo
 * Date: 16/11/2019
 * Time: 16:10
 */

namespace App\Core;

use App\Core\Exceptions\ActionNotFoundException;
use App\Core\Exceptions\ClassNotFoundException;
use App\Core\Exceptions\MethodNotAllowedException;
use App\Core\Exceptions\RouteNotFoundException;
use App\Providers\RouteServiceProvider;
use Exception;
use ReflectionException;

class App
{
    /**
     * @throws ActionNotFoundException
     * @throws ClassNotFoundException
     * @throws MethodNotAllowedException
     * @throws RouteNotFoundException
     * @throws ReflectionException
     * @throws Exception
     */
    public function run(Request $request)
    {
        RouteServiceProvider::resolve($request->get('url'));
    }
}
