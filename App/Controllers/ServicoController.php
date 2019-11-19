<?php

namespace App\Controllers;

use App\Services\MyNewService;
use App\Services\MyService;

class ServicoController
{
    protected $service;
    protected $newService;

    public function __construct(MyService $service, MyNewService $newService)
    {
        $this->service    = $service;
        $this->newService = $newService;
    }

    public function salvar()
    {
        echo 'SALVEI O QUE TINHA QUE SALVAR';
    }

    public function editar()
    {
        echo 'SALVEI O QUE TINHA QUE SALVAR';
    }

    public function editarPost()
    {
        echo 'OPA POST';
    }
}