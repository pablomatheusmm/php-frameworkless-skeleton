<?php

namespace App;

use App\Router;

class App
{
    private $host;
    private $rota;

    public function __construct()
    {
        $this->host = 'http://localhost:8787/';
        $this->rota = $_GET['url'];
    }

    public function run()
    {
        $router = new Router();
        $router->getRoute($_GET['url']);
    }
}