<?php
/**
 * Created by PhpStorm.
 * User: pablo
 * Date: 22/11/2019
 * Time: 01:52
 */

namespace App\Core\Router\Kernel;

use ReflectionClass;
use ReflectionException;

class RouterDi
{
    /**
     * @var string
     */
    protected static $namespace = '\\App\Controllers\\';

    /**
     * @param string $class
     *
     * @return mixed
     * @throws ReflectionException
     */
    public function getConstructorClass(string $class)
    {
        $reflectionClass            = new ReflectionClass($class);
        $reflectionClassConstructor = $reflectionClass->getConstructor();
        $constructorParams          = [];

        if (!is_null($reflectionClassConstructor)) {
            $reflectionParams = $reflectionClassConstructor->getParameters();

            foreach ($reflectionParams as $reflectionParam) {
                $param               = $reflectionParam->getType()->getName();
                $constructorParams[] = self::getConstructorClass($param);
            }
        }

        return new $class(...$constructorParams);
    }
}