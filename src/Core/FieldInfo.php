<?php

namespace Modelify\Core;

use Modelify\Interfaces\ModelifyInterface;

/**
 * Field Information
 *
 * @property string $name
 * @property string $type
 * @property bool $required
 * @property string $reference
 */
class FieldInfo extends Core {

  const FIELDS = [
    'name' => 'string',
    'type' => 'string',
    'required' => 'bool',
    'reference' => 'string'
  ];

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

  private function merge(array $data) {
    foreach ($data as $name => $value) {
      $this->__set($name, $value);
    }
  }

  final public function __get($name) {
    if (!array_key_exists($name, $this->xData)) return NULL;
    return $this->xData[$name];
  }

  final public function __set($name, $value) {
    if ($name === 'name') return;
    if (!array_key_exists($name, self::FIELDS)) return;

    settype($value, self::FIELDS[$name]);

    $this->xData[$name] = $value;
  }

}
