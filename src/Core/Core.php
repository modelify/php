<?php

namespace Modelify\Core;

use Closure;
use Modelify\Exceptions\Exception;
use Modelify\Exceptions\ReflectionException;
use Modelify\Interfaces\Castable;
use Modelify\Interfaces\CoreInterface;
use Modelify\Interfaces\ModelifyInterface;
use Modelify\Traits\CallReflectionMethod;
use Modelify\Traits\ManageConstants;

class Core implements CoreInterface, Castable {

  use CallReflectionMethod, ManageConstants;

  /**
   * @ignore
   *
   * @var ModelifyInterface
   */
  private $xApp;

  final function __construct(ModelifyInterface &$app, ...$args) {
    $this->xApp = &$app;

    try {
      $this->call('init', $args);
    } catch (ReflectionException $e) {
      // ...
    }
  }

  public static function from(ModelifyInterface &$app, ...$params) {
    return new static($app, ...$params);
  }

  final protected function app() {
    return $this->xApp;
  }

  final protected function &config() {
    return $this->xApp->config();
  }

  final protected function make(string $className, ...$args): Core {
    if (!is_subclass_of($className, self::class)) {
      throw new Exception("Class '{$className}' not a subclass of '".self::class."'");
    }

    return new $className($this->xApp, ...$args);
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
