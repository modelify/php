<?php
namespace Modelify\Action;

use Modelify\Core\DataCore;

/**
 * Undocumented class
 *
 * @property string $method
 * @property string $path
 * @property array $params
 * @property array $data
 * @property string $returns
 */
class Action extends DataCore {

  const FIELDS = [
    'method' => ['type' => 'string'],
    'path' => ['type' => 'string'],
    'params' => ['type' => 'array'],
    'data' => ['type' => 'array'],
    'returns' => ['type' => 'string'],
  ];

  protected function initialize() {
    parent::initialize();
    if (!isset($this->path)) $this->path = '';
    if (!is_array($this->params)) $this->params = [];
  }

}
