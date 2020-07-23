<?php

namespace Modelify;

use Modelify\Config\HttpConfig;
use Modelify\Exceptions\ConfigException;

/**
 * Configuration
 */
class Config {

  const CONFIG = [
    'http' => HttpConfig::class
  ];

  private $xInstance;

  public function __construct($type, $options) {
    if (!$this->hasType($type)) {
      throw new ConfigException("Invalid type '{$type}'!");
    }
  }

  public function hasType($type) {
    return array_key_exists($type, self::CONFIG);
  }

  final public static function __callStatic($name, $arguments) {
    if (!array_key_exists($name, self::CONFIG)) {
      //
    }

    $config = self::CONFIG[$name];

    return new $config(...$arguments);
  }

}
