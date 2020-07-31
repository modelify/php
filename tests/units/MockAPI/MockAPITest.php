<?php

use Modelify\Tests\Cases\MockAPITestCase;
use Modelify\Tests\Classes\MockAPI\MockAPI;

class MockAPITest extends MockAPITestCase {

  public function testCanInstantiate() {
    $this->assertInstanceOf(MockAPI::class, $this->instance());
  }

}
