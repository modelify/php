<?php

namespace Modelify\Core;

use JsonSerializable;
use Modelify\Exceptions\ReflectionException;
use Modelify\Interfaces\DataInterface;

class Data extends Core implements DataInterface, JsonSerializable {

  const FIELDS = [];

  /**
   * Field Information
   *
   * @var Field[]
   */
  private $xFields;

  /**
   * Attributes
   *
   * @var array
   */
  private $xAttributes = [];

  protected function init(array $data = []) {
    $fields = $this->mergeConstants('FIELDS');

    foreach ($fields as $name => $info) {
      $this->xFields[$name] = $this->makeField($name, $info);
    }

    $this->fill($data);
  }

  public function fill(array $data) {
    foreach ($data as $name => $value) {
      $this->__set($name, $value);
    }
  }

  final public function toArray() {
    return $this->xAttributes;
  }

  final public function jsonSerialize() {
    return (object)$this->toArray();
  }

  final protected function makeField($name, $info): Field {
    return $this->make(Field::class, $name, $info);
  }

  final protected function hasField($name) {
    return array_key_exists($name, $this->xFields);
  }

  final protected function getField($name) {
    if (!$this->hasField($name)) return false;
    return $this->xFields[$name];
  }

  public function getAttribute($name) {
    if (!$this->__isset($name)) return NULL;
    return $this->xAttributes[$name];
  }

  public function setAttribute($name, $value) {
    $field = $this->getField($name);
    if ($field === false) return;

    $value = $this->cast($value, $field->type);

    $this->xAttributes[$name] = $value;
  }

  /**
   * @ignore
   */
  final public function __isset($name) {
    return array_key_exists($name, $this->xAttributes);
  }

  /**
   * @ignore
   */
  final public function __unset($name) {
    unset($this->xAttributes[$name]);
  }

  /**
   * @ignore
   */
  final public function __get($name) {
    try {
      $method = ucfirst($name);
      $method = "get{$name}Attribute";
      return $this->call($method);
    } catch (ReflectionException $e) {
      return $this->getAttribute($name);
    }
  }

  /**
   * @ignore
   */
  final public function __set($name, $value) {
    try {
      $method = ucfirst($name);
      $method = "set{$name}Attribute";
      return $this->call($method, [$value]);
    } catch (ReflectionException $e) {
      return $this->setAttribute($name, $value);
    }
  }

}
