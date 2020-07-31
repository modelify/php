<?php
namespace Modelify;

use Modelify\Exceptions\ModelException;
use Modelify\Interfaces\ConfigInterface;
use Modelify\Interfaces\ModelifyInterface;
use Modelify\Traits\CallReflectionMethod;

class Modelify implements ModelifyInterface {

  use CallReflectionMethod;

  const CONFIG = Config::class;

  const MODELS = [];

  /**
   * Configuration
   *
   * @var ConfigInterface
   */
  private $xConfig;

  function __construct(array $options = []) {
    // Configuration Class
    $config = static::CONFIG;

    // Initialize Configuration
    $this->xConfig = new $config($this, $options);
  }

  final public function &config(): ConfigInterface {
    return $this->xConfig;
  }

  private function model($name) {
    if (!array_key_exists($name, static::MODELS)) {
      throw new ModelException("Method '{$name}' does not exist!");
    }

    if (!is_subclass_of(static::MODELS[$name], Model::class)) {
      throw new ModelException("'".static::MODELS[$name]."' not an subclass of '".Model::class."'.");
    }

    return static::MODELS[$name];
  }

  final public function __call($name, $arguments) {
    $model = $this->model($name);
    return new $model($this, ...$arguments);
  }

}
