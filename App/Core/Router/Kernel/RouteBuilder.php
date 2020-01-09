<?php
/**
 * Created by PhpStorm.
 * User: pablo
 * Date: 22/11/2019
 * Time: 01:51
 */

namespace App\Core\Router\Kernel;

class RouteBuilder
{
    /**
     * @param string $route
     *
     * @return array
     */
    public function build(string $route): array
    {
        $routeExploded = explode('@', $route);

        return [
            'controller' => $routeExploded[0],
            'action'     => $routeExploded[1]
        ];
    }
}