<?php

namespace App\Controllers;

use App\Core\Request;

class ServicoController
{
    public function salvar()
    {
        echo 'SALVEI O QUE TINHA QUE SALVAR';
    }

    public function editar(Request $request)
    {
        $param = $request->get('id');
        dd($param);
    }

    public function editarPost()
    {
        echo 'OPA POST';
    }
}