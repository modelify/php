<?php
namespace Modelify\Traits;

use ReflectionClassConstant;

trait BuildModelPath {

  private $__path = NULL;

  final protected function path(): string {
    if (!is_null($this->__path)) {
      return $this->__path;
    }

    $path = '';

    $parentList = class_parents(static::class);
    $parentList = array_reverse($parentList);
    $parentList[] = static::class;

    foreach ($parentList as $parent) {
      if (!defined($parent.'::PATH')) continue;

      $const = new ReflectionClassConstant($parent, 'PATH');
      $class = $const->getDeclaringClass();
      if ($class->name !== $parent) continue;

      if (!empty($path)) $path .= '/';
      $path .= $this->sanitizePath($const->getValue());
    }

    return $path;
  }

  final protected function sanitizePath($path) {
    if (is_null($path)) $path = '';

    if (substr($path, 0, 1) === '/') {
      $path = substr($path, 1);
      $path = $this->sanitizePath($path);
    }

    if (substr($path, -1) === '/') {
      $path = substr($path, 0, -1);
      $path = $this->sanitizePath($path);
    }

    return $path;
  }

}
