<?php

namespace App\Controllers;

use App\Core\Request;
use Exception;
use App\Repositories\UserRepository;

class ServicoController
{
    public function salvar()
    {
        echo 'SALVEI O QUE TINHA QUE SALVAR';
    }

    public function editar(Request $request)
    {
        try {
            $param = $request->get('id');
            dd($param);
        } catch (Exception $e) {
        }
    }

    public function editarPost()
    {
        echo 'OPA POST';
    }

    public function teste(){
        var_dump((new UserRepository())->getAll());
    }

}
