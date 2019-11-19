<?php
/**
 * Created by PhpStorm.
 * User: pablo
 * Date: 18/11/2019
 * Time: 12:11
 */

use App\Providers\RouteServiceProvider as Router;

Router::get('servico/editar/', 'ServicoController@editar');
Router::post('servico/editar/', 'ServicoController@editarPost');