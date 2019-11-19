<?php
/**
 * Created by PhpStorm.
 * User: pablo
 * Date: 18/11/2019
 * Time: 16:24
 */

namespace App\Core;

use App\Providers\RouteServiceProvider;

class Router
{
    /**
     * @throws Exceptions\ActionNotFoundException
     * @throws Exceptions\ClassNotFoundException
     * @throws Exceptions\MethodNotAllowedException
     * @throws Exceptions\RouteNotFoundException
     */
    public function resolve()
    {
        RouteServiceProvider::resolve($_GET['url']);
    }
}