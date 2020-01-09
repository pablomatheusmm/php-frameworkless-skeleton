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
        //dd('eita');
        $param = $request->get('id');

        $soma     = 0;
        $iterator = 0;

        while (true) {
            echo 'JOAO';
            break;
        }

        echo 'Nissama';
    }

    public function editarPost()
    {
        echo 'OPA POST';
    }
}