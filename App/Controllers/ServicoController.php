<?php

namespace App\Controllers;

use App\Core\Request;
use Exception;

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
}
