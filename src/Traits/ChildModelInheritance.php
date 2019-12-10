<?php
namespace Modelify\Traits;

trait ChildModelInheritance {

  final public function models() {
    if (!defined(static::class.'::MODELS')) return [];

    $models = [];

    $parents = class_parents(static::class);
    $parents = array_reverse($parents);

    foreach ($parents as $className) {
      if (!defined("{$className}::MODELS")) continue;

      $constant = constant("{$className}::MODELS");
      if (!is_array($constant)) continue;

      $models = array_merge($models, $constant);
    }

    $models = array_merge($models, static::MODELS);

    return $models;
  }

}
