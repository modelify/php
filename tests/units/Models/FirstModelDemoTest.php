<?php
namespace Models;

use ModelifyTestCase;

class FirstModelDemoTest extends ModelifyTestCase {

  /**
   * @var FirstModelDemo
   */
  protected $model;

  protected function setUp() {
    $instance = &$this->instance();
    $this->model = $instance->firstModel();
  }

  public function testCanCreateInstance() {
    $this->assertInstanceOf(FirstModelDemo::class, $this->model);
  }

  public function testCanCallAction() {
    $model = $this->model->create();
    // $this->assertInstanceOf(FirstModelDemo::class, $model);
  }

}
