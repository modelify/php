<?php

namespace Modelify\Traits;

use Modelify\Exceptions\ReflectionException;
use ReflectionException as GlobalReflectionException;
use ReflectionMethod;

trait CallReflectionMethod {

  final public function call($name, array $parameters = []) {
    try {
      $method = new ReflectionMethod(static::class, $name);

      if ($method->isPrivate()) {
        $classMethod = static::class.'::'.$name;
        throw new ReflectionException("'{$classMethod}' cannot be private.");
      }

      $method->setAccessible(true);

      return $method->invokeArgs($this, $parameters);
    } catch (GlobalReflectionException $e) {
      throw new ReflectionException($e->getMessage(), $e->getCode());
    }
  }

}
