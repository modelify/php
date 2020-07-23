<?php

namespace Modelify\Core;

use Modelify\Interfaces\ActionInterface;
use Modelify\Traits\MiniDynamicProperties;

class Action extends Core implements ActionInterface {

  use MiniDynamicProperties;

  const FIELDS = [
    'name' => 'string',
    'type' => 'string',
    'required' => 'bool',
    'reference' => 'string'
  ];

  public function exec() {
    //
  }

}
