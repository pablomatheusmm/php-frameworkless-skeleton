<?php
/**
 * Created by PhpStorm.
 * User: pablo
 * Date: 18/11/2019
 * Time: 22:57
 */

namespace App\Core\Exceptions;

use Exception;
use Throwable;

class RouteNotFoundException extends Exception
{
    /**
     * RouteNotFoundException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct('Your route was not found', $code, $previous);
    }
}