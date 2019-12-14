<?php
namespace Models;

use ModelifyTestCase;

class ThirdModelDemoTest extends ModelifyTestCase {

  public function testCanCreateInstance() {
    $instance = &$this->instance();
    $model = $instance->thirdModel();
    $this->assertInstanceOf(ThirdModelDemo::class, $model);
    var_dump($model->getFullPath('additional/path'));
  }

}
