<?php
namespace Modelify\Core;

use Modelify\Interfaces\ModelifyInterface;

class DataCore extends Core {

  const FIELDS = [];

  private $_data = [];

  final function __construct(ModelifyInterface &$app, array $data = []) {
    parent::__construct($app);
    $this->merge($data);
    $this->initialize();
  }

  protected function initialize() {
    parent::initialize();
  }

  public function merge(array $data) {
    foreach ($data as $name => $value) {
      $this->__set($name, $value);
    }
  }

  public function __isset($name) {
    return array_key_exists($name, $this->_data);
  }

  public function __unset($name) {
    unset($this->_data[$name]);
  }

  public function __get($name) {
    if (array_key_exists($name, $this->_data)) {
      return $this->_data[$name];
    }

    return NULL;
  }

  public function __set($name, $value) {
    //
  }

}
