<?php

namespace Modelify\Config;

use Modelify\Core\ConfigType;
use Modelify\Interfaces\ConfigTypeHttpInterface;

final class HttpConfig extends ConfigType implements ConfigTypeHttpInterface {

  const FIELDS = [
    'endpoint' => ['type' => 'string', 'required' => true]
  ];

}
