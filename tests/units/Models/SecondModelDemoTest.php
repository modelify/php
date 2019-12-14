<?php
namespace Models;

use ModelifyTestCase;

class SecondModelDemoTest extends ModelifyTestCase {

  public function testCanCreateInstance() {
    $instance = &$this->instance();
    $model = $instance->secondModel();
    $this->assertInstanceOf(SecondModelDemo::class, $model);
    var_dump($model->getFullPath());
  }

}
