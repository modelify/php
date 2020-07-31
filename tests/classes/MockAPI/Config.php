<?php

namespace Modelify\Tests\Classes\MockAPI;

use Modelify\Config as ModelifyConfig;

class Config extends ModelifyConfig {

  protected $type = 'http';

  protected $fixed = [
    'endpoint' => 'https://'.MOCKAPI_KEY.'.mockapi.io'
  ];

}
