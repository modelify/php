<?php

namespace Modelify\Core;

use Modelify\Interfaces\FieldInterface;
use Modelify\Traits\MiniDynamicProperties;

class Field extends Core implements FieldInterface {

  use MiniDynamicProperties;

  const FIELDS = [
    'name' => 'string',
    'type' => 'string',
    'required' => 'bool',
    'reference' => 'string'
  ];

}
