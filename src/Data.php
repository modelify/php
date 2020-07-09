<?php

namespace Modelify;

use Modelify\Core\CoreData;
use Modelify\Interfaces\DataInterface;

class Data extends CoreData implements DataInterface {

  final public function getAttribute($name) {
    if (!$this->__isset($name)) return NULL;

    $value = parent::getAttribute($name);

    return $value;
  }

  final public function setAttribute($name, $value) {
    $field = $this->getField($name);
    if ($field === false) return;

    $value = $this->cast($value, $field->type);

    parent::setAttribute($name, $value);
  }

}
