<?php
namespace Modelify;

use Modelify\Traits\ChildModelInheritance;

class Model extends Data {

  const MODELS = [];

  use ChildModelInheritance;

}
