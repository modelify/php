<?php

namespace Modelify\Core;

use JsonSerializable;
use Modelify\Exceptions\InvalidMethodException;
use Modelify\Interfaces\ModelifyInterface;

class CoreData extends Core implements JsonSerializable {

  const FIELDS = [];

  /**
   * Field Information
   *
   * @var FieldInfo[]
   */
  private $xFields;

  /**
   * Attributes
   *
   * @var array
   */
  private $xAttributes = [];

  final function __construct(ModelifyInterface &$app, array $data = []) {
    parent::__construct($app);

    $fields = $this->mergeConstants('FIELDS');

    foreach ($fields as $name => $info) {
      $this->xFields[$name] = $this->makeFieldInfo($name, $info);
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

  final protected function makeFieldInfo($name, $info): FieldInfo {
    return $this->c(FieldInfo::class, $name, $info);
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
    if (!$this->hasField($name)) return;
    $this->xAttributes[$name] = $value;
  }

  final public function __isset($name) {
    return array_key_exists($name, $this->xAttributes);
  }

  final public function __unset($name) {
    unset($this->xAttributes[$name]);
  }

  final public function __get($name) {
    try {
      $method = ucfirst($name);
      $method = "get{$name}Attribute";
      return $this->call($method);
    } catch (InvalidMethodException $e) {
      return $this->getAttribute($name);
    }
  }

  final public function __set($name, $value) {
    try {
      $method = ucfirst($name);
      $method = "set{$name}Attribute";
      return $this->call($method, [$value]);
    } catch (InvalidMethodException $e) {
      return $this->setAttribute($name, $value);
    }
  }

}
