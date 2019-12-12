<?php

class ModelifyDemoTest extends ModelifyTestCase {

  public function testCanCreateInstance() {
    $instance = &$this->instance();

    $this->assertInstanceOf(ModelifyDemo::class, $instance);
  }

}
