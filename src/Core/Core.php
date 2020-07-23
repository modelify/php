<?php

namespace Modelify\Core;

use Closure;
use Modelify\Exceptions\Exception;
use Modelify\Exceptions\InvalidMethodException;
use Modelify\Exceptions\ReflectionException;
use Modelify\Interfaces\Castable;
use Modelify\Interfaces\CoreInterface;
use Modelify\Interfaces\ModelifyInterface;
use ReflectionClass;
use ReflectionException as GlobalReflectionException;
// use ReflectionException;
use ReflectionMethod;

class Core implements CoreInterface, Castable {

  /**
   * @ignore
   *
   * @var ModelifyInterface
   */
  private $xApp;

  function __construct(ModelifyInterface &$app) {
    $this->xApp = &$app;

    try {
      $this->call('initialize');
    } catch (InvalidMethodException $e) {
      // ...
    }
  }

  public static function from(ModelifyInterface &$app, ...$params) {
    return new static($app, ...$params);
  }

  final protected function app() {
    return $this->xApp;
  }

  final protected function make(string $className, ...$args): Core {
    if (!is_subclass_of($className, self::class)) {
      throw new Exception("Class '{$className}' not a subclass of '".self::class."'");
    }

    return new $className($this->xApp, ...$args);
  }

  final protected function call($name, array $parameters = []) {
    try {
      $method = new ReflectionMethod(static::class, $name);

      if ($method->isPrivate()) {
        $classMethod = static::class.'::'.$name;
        throw new ReflectionException("'{$classMethod}' cannot be private.");
      }

      return $method->invokeArgs($this, $parameters);
    } catch (GlobalReflectionException $e) {
      throw new ReflectionException($e->getMessage(), $e->getCode());
    }
  }

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
        $class = new ReflectionClass(static::class);
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

  final public function cast($data, string $type) {
    if (($baseType = substr($type, -2)) === '[]') {
      if (!is_array($data)) return NULL;

      $value = [];

      foreach ($data as $item) {
        $value[] = $this->cast($item, $baseType);
      }

      return $value;
    } else if (is_subclass_of($type, Castable::class)) {
      $callback = Closure::fromCallable("{$type}::from");
      return $callback($data);
    } else if (settype($data, $type) !== false) {
      return $data;
    }

    return NULL;
  }

}
