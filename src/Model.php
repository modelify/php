<?php
namespace Modelify;

use Modelify\Traits\BuildModelPath;

class Model extends Data {

  use BuildModelPath;

  const PATH = '';

  const ACTIONS = [];

  protected function initialize() {
    parent::initialize();
    $this->__path = $this->path();
  }

  final public function getFullPath($path = NULL) {
    $fullPath = $this->path();

    $path = $this->sanitizePath($path);
    if (!empty($path)) $fullPath .= '/'.$path;

    return $fullPath;
  }

}
