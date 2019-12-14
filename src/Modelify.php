<?php
namespace Modelify;

use Modelify\Exceptions\InvalidModelException;
use Modelify\Exceptions\MethodDoesNotExistException;
use Modelify\Interfaces\ModelifyInterface;
use Modelify\Traits\ChildModelInheritance;

class Modelify implements ModelifyInterface {

  use ChildModelInheritance;

  const MODELS = [];

  public function __call($name, $arguments) {
    $models = $this->models();

    if (!array_key_exists($name, $models)) {
      throw new MethodDoesNotExistException("Method '{$name}' does not exist!");
    }

    if (!is_subclass_of($models[$name], Model::class)) {
      throw new InvalidModelException("'{$models[$name]}' not an subclass of '".Model::class."'.");
    }

    return new $models[$name]($this, ...$arguments);
  }

}
