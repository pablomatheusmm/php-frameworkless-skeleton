<?php
/**
 * Created by PhpStorm.
 * User: pablo
 * Date: 22/11/2019
 * Time: 01:28
 */

namespace App\Core;

use Exception;

class Request
{
    private $requestParams;

    public function __construct(array $customParams = [])
    {
        $this->requestParams = array_merge($_GET, $_POST, $_REQUEST, $customParams);
    }

    /**
     * @param string $key
     *
     * @return mixed
     * @throws Exception
     */
    public function get(string $key)
    {
        if (array_key_exists($key, $this->requestParams)) {
            return $this->requestParams[$key];
        }

        throw new Exception('Campo não existente');
    }

    public function getAll()
    {
        dd($this->requestParams);
    }
}