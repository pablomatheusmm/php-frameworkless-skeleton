<?php
/**
 * Created by PhpStorm.
 * User: pablo
 * Date: 18/11/2019
 * Time: 12:11
 */

use App\Core\Router\Router;

Router::get('servico/editar/', 'ServicoController@editar');
Router::get('servico/{$id}', 'ServicoController@editar');
Router::post('servico/editar/', 'ServicoController@editarPost');