<?php
namespace Modelify;

use Modelify\Traits\BuildModelPath;

class Model extends Data {

  use BuildModelPath;

  const PATH = '';

  protected function initialize() {
    parent::initialize();
    $this->path();
  }

}
