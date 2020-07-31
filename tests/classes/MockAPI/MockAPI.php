<?php

namespace Modelify\Tests\Classes\MockAPI;

use Modelify\Modelify;
use Modelify\Tests\Classes\MockAPI\Model\Content;

/**
 * MockAPI SDK
 *
 * @method Content content(array $data = [])
 *  Content of MockAPI
 */
class MockAPI extends Modelify {

  const CONFIG = Config::class;

  const MODELS = [
    'content' => Content::class
  ];

}
