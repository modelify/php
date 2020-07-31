<?php

namespace Modelify\Tests\Cases;

use Modelify\Tests\Classes\MockAPI\MockAPI;
use PHPUnit\Framework\TestCase;

class MockAPITestCase extends TestCase {

  /**
   * @var MockAPI
   */
  private static $instance = NULL;

  final public function &instance() {
    return self::$instance;
  }

  public static function setUpBeforeClass() {
    if (self::$instance) return;

    self::$instance = new MockAPI([
      'endpoint' => 'https://'.MOCKAPI_KEY.'.mockapi.io'
    ]);
  }

}
