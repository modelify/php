<?php

namespace Modelify\Core;

use Closure;
use Modelify\Exceptions\ActionException;
use Modelify\Interfaces\ModelInterface;

/**
 * Model Action
 *
 * @property string $name
 *
 * @property string $path
 *
 * @property array $params
 *
 * @property string $method
 *
 * @property array $data
 *
 * @property string[] $arguments
 *
 * @property string $returns
 */
class Action extends Core {

  const FIELDS = [
    'name' => 'string',
    'path' => 'string',
    'params' => 'array',
    'method' => 'string',
    'data' => 'array',
    'arguments' => 'array',
    'returns' => 'string'
  ];

  /**
   * Model
   *
   * @var ModelInterface
   */
  private $xModel;

  private $xData = [];

  private static $http;

  final protected function init(ModelInterface &$model, string $name, array $data = []) {
    $this->xModel = &$model;
    $data['name'] = $name;

    foreach ($data as $name => $value) {
      $this->__set($name, $value);
    }

    if (!self::$http) {
      self::$http = $this->make(Http::class);
    }
  }

  private function interpolate($path, $params = []) {
    $callback = Closure::bind(function ($match) use (&$params) {
      if (!array_key_exists($match[1], $params)) return NULL;
      return $this->{$params[$match[1]]};
    }, $this);

    return preg_replace_callback("/\{(\w)+\}/", $callback, $path);
  }

  private function &http() {
    return self::$http;
  }

  final public function path() {
    // $path = $this->xModel->path();
    // $params = $this->xModel->params();

    // $parsed = $this->interpolate();
  }

  final public function exec() {
    //
  }

  /**
   * @ignore
   */
  final public function __isset($name) {
    return array_key_exists($name, $this->xData);
  }

  /**
   * @ignore
   */
  final public function __unset($name) {
    unset($this->xData);
  }

  /**
   * @ignore
   */
  final public function __get($name) {
    if (!$this->__isset($name)) return NULL;
    return $this->xData[$name];
  }

  /**
   * @ignore
   */
  final public function __set($name, $value) {
    if (!array_key_exists($name, self::FIELDS)) return;
    settype($value, self::FIELDS[$name]);
    $this->xData[$name] = $value;
  }

}
