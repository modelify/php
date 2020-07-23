<?php

namespace Modelify\Traits;

use Modelify\Interfaces\ModelifyInterface;

trait MiniDynamicProperties {

  /**
   * @ignore
   *
   * @var array
   */
  private $xData = [];

  final function __construct(ModelifyInterface &$app, string $name, array $data = []) {
    parent::__construct($app);
    $data['name'] = $name;
    $this->merge($data);
  }

  /**
   * @ignore
   *
   * @return boolean
   */
  private function hasDefinedFields() {
    return defined(self::class . '::FIELDS');
  }

  /**
   * @ignore
   *
   * @return mixed
   */
  private function &getDefinedFields() {
    if (!$this->hasDefinedFields()) return NULL;
    return constant(self::class . '::FIELDS');
  }

  private function merge(array $data) {
    foreach ($data as $name => $value) {
      $this->__set($name, $value);
    }
  }

  final public function __isset($name) {
    return array_key_exists($name, $this->xData);
  }

  final public function __unset($name) {
    unset($this->xData[$name]);
  }

  final public function __get($name) {
    if (!array_key_exists($name, $this->xData)) return NULL;
    return $this->xData[$name];
  }

  final public function __set($name, $value) {
    if (!($fields = $this->getDefinedFields())) return;

    if ($name === 'name') return;
    if (!array_key_exists($name, $fields)) return;

    settype($value, $fields[$name]);

    $this->xData[$name] = $value;
  }

}
