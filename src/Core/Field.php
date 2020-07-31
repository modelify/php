<?php

namespace Modelify\Core;

use Modelify\Interfaces\FieldInterface;

/**
 * Field
 *
 * @property string $name
 *
 * @property string $type
 *
 * @property bool $required
 *
 * @property mixed $default
 *
 * @property string $reference
 */
class Field extends Core implements FieldInterface {

  const FIELDS = [
    'name' => 'string',
    'type' => 'string',
    'required' => 'bool',
    'default' => 'mixed',
    'reference' => 'string'
  ];

  private $xData = [];

  final protected function init(string $name, array $data = []) {
    $data['name'] = $name;

    foreach ($data as $name => $value) {
      $this->__set($name, $value);
    }
  }

  /**
   * @ignore
   */
  final public function __isset($name) {
    return array_key_exists($name, $this->xData);
  }

  /**
   * @ignore
   */
  final public function __unset($name) {
    unset($this->xData);
  }

  /**
   * @ignore
   */
  final public function __get($name) {
    if (!$this->__isset($name)) return NULL;
    return $this->xData[$name];
  }

  /**
   * @ignore
   */
  final public function __set($name, $value) {
    if (!array_key_exists($name, self::FIELDS)) return;
    settype($value, self::FIELDS[$name]);
    $this->xData[$name] = $value;
  }

}
