<?php

namespace Modelify\Tests;

use Modelify\Tests\MockAPI\Project;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

class TestCase extends PHPUnitTestCase {

  /**
   * @var Project
   */
  private static $instance = NULL;

  final public function &instance() {
    return self::$instance;
  }

  public static function setUpBeforeClass() {
    if (self::$instance) return;
    self::$instance = new Project();
  }

}
