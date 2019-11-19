<?php
/**
 * Created by PhpStorm.
 * User: pablo
 * Date: 18/11/2019
 * Time: 23:38
 */

namespace App\Core\App\Factory;

use App\Core\App\App;
use App\Core\Router;

class AppFactory
{
    /**
     * @return App
     */
    public function createApp(): App
    {
        return new App(
            new Router()
        );
    }
}