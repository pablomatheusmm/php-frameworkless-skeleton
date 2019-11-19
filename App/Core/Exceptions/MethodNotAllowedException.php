<?php
/**
 * Created by PhpStorm.
 * User: pablo
 * Date: 18/11/2019
 * Time: 23:03
 */

namespace App\Core\Exceptions;

use Exception;
use Throwable;

class MethodNotAllowedException extends Exception
{
    /**
     * MethodNotAllowedException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct('Your requested method is not allowed.', $code, $previous);
    }
}