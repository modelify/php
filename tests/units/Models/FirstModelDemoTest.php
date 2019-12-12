<?php
namespace Models;

use ModelifyTestCase;

class FirstModelDemoTest extends ModelifyTestCase {

  public function testCanCreateInstance() {
    $instance = &$this->instance();
    $model = $instance->firstModel();
    $this->assertInstanceOf(FirstModelDemo::class, $model);
    var_dump($model->path());
  }

}
