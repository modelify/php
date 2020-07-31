<?php

namespace Modelify\Core;

use Modelify\Exceptions\ReflectionException;
use Modelify\Interfaces\ConfigInterface;
use Modelify\Interfaces\ConfigTypeInterface;
use Modelify\Interfaces\ModelifyInterface;
use Modelify\Traits\CallReflectionMethod;

class ConfigType implements ConfigTypeInterface {

  use CallReflectionMethod;

  const FIELDS = [];

  private $xOptions = [];

  /**
   * Modelify Instance
   *
   * @var ModelifyInterface
   */
  private $xApp;

  /**
   * Configuration
   *
   * @var ConfigInterface
   */
  private $xConfig;

  /**
   * Configuration Type Constructor
   *
   * @param ConfigInterface $config
   *  Configuration Instance
   *
   * @param ModelifyInterface $app
   *  Modelify Instance
   *
   * @param array $options
   *  Configuration Options
   */
  final function __construct(ConfigInterface &$config, ModelifyInterface &$app, array $options = []) {
    $this->xConfig =& $config;

    $this->xApp =& $app;

    foreach ($options as $name => $value) {
      $this->set($name, $value);
    }
  }

  final public function options(): array {
    return $this->xOptions;
  }

  final public function getOption($name) {
    if (!$this->__isset($name)) return NULL;
    return $this->xOptions[$name];
  }

  private function setOption($name, $value) {
    $this->xOptions[$name] = $value;
  }

  /**
   * @ignore
   */
  private function set($name, $value) {
    try {
      $method = ucfirst($name);
      $method = "set{$method}Option";
      $this->xConfig->call($method, [$value]);
    } catch (ReflectionException $e) {
      $this->setOption($name, $value);
    }
  }

  /**
   * @ignore
   */
  final public function __isset($name) {
    return array_key_exists($name, $this->xOptions);
  }

  /**
   * @ignore
   */
  final public function __get($name) {
    try {
      $method = ucfirst($name);
      $method = "get{$method}Option";
      return $this->xConfig->call($method);
    } catch (ReflectionException $e) {
      return $this->getOption($name);
    }
  }

}
