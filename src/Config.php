<?php

namespace Modelify;

use Modelify\Config\HttpConfig;
use Modelify\Exceptions\ConfigException;
use Modelify\Exceptions\ReflectionException;
use Modelify\Interfaces\ConfigInterface;
use Modelify\Interfaces\ModelifyInterface;
use Modelify\Traits\CallReflectionMethod;
use ReflectionException as GlobalReflectionException;
use ReflectionMethod;

/**
 * Configuration
 */
class Config implements ConfigInterface {

  use CallReflectionMethod;

  const CONFIG = [
    'http' => HttpConfig::class
  ];

  protected $type = 'http';

  protected $default = [];

  protected $fixed = [];

  private $xInstance;

  final public function __construct(ModelifyInterface &$app, array $options = []) {
    if (!array_key_exists($this->type, self::CONFIG)) {
      throw new ConfigException("Invalid Config type, '{$this->type}'!");
    }

    $config = self::CONFIG[$this->type];

    $this->xInstance = new $config($this, $app, $options);
  }

  private function hasDefaultOption($name) {
    return array_key_exists($name, $this->default);
  }

  private function hasFixedOption($name) {
    return array_key_exists($name, $this->fixed);
  }

  /**
   * @ignore
   */
  final public function __isset($name) {
    // Check if option is in fixed options
    if (array_key_exists($name, $this->fixed)) return true;
    // Check if option is in type instance
    if (isset($this->xInstance->{$name})) return true;
    // Check if option is in default options
    return array_key_exists($name, $this->default);
  }

  /**
   * @ignore
   */
  final public function __unset($name) {
    unset($this->xInstance->{$name});
  }

  /**
   * @ignore
   */
  final public function __get($name) {
    // Check if option is in fixed options
    if (array_key_exists($name, $this->fixed)) {
      return $this->fixed[$name];
    }

    // Check if option is in type instance
    if (isset($this->xInstance->{$name})) {
      return $this->xInstance->{$name};
    }

    // Check if option is in default options
    return array_key_exists($name, $this->default);

    return $this->xInstance->{$name};
  }

  /**
   * @ignore
   */
  final public function __set($name, $value) {
    $this->xInstance->{$name} = $value;
  }

  /**
   * @ignore
   */
  final public function __call($name, $arguments) {
    try {
      $method = new ReflectionMethod($this->xInstance, $name);
      return $method->invokeArgs($this->xInstance, $arguments);
    } catch (GlobalReflectionException $e) {
      throw new ReflectionException($e->getMessage(), $e->getCode());
    }
  }

}
