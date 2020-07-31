<?php

namespace Modelify\Traits;

use ReflectionClass;
use ReflectionException;

trait ManageConstants {

  final protected function implodeConstants($name, string $glue = '/') {
    $values = self::getConstantValues(static::class, $name);

    $values = array_map(function ($value) use ($glue) {
      return trim($value, $glue);
    }, $values);

    return implode($glue, $values);
  }

  final protected function mergeConstants($name) {
    $values = self::getConstantValues(static::class, $name);
    return array_merge(...$values);
  }

  final protected static function getConstantValues($class, $name, array $values = []): array {
    try {
      if (!($class instanceof ReflectionClass)) {
        if(is_string($class)) {
          $class = new ReflectionClass($class);
        } else {
          $class = new ReflectionClass(static::class);
        }
      }

      if ($class->hasConstant($name)) {
        $constant = $class->getReflectionConstant($name);
        // Check if constant is declared by this class
        if ($constant->getDeclaringClass()->name === $class->name) {
          array_unshift($values, $constant->getValue());
        }
      }

      if ($parent = $class->getParentClass()) {
        return self::getConstantValues($parent, $name, $values);
      }
    } catch (ReflectionException $e) {
      return $values;
    }

    return $values;
  }

}
