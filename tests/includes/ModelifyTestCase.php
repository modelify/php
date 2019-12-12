<?php

use PHPUnit\Framework\TestCase;

class ModelifyTestCase extends TestCase {

  /**
   * @var ModelifyDemo
   */
  private static $instance = NULL;

  final public function &instance() {
    return self::$instance;
  }

  public static function setUpBeforeClass() {
    if (self::$instance) return;
    self::$instance = new ModelifyDemo();
  }

}
