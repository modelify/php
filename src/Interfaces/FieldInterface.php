<?php

namespace Modelify\Interfaces;

/**
 * Field Interface
 *
 * @property string $name
 *  Name of field
 *
 * @property string $type
 *  Data type for field
 *
 * @property bool $required
 *  This property is `true` if the field is required and `false` if it is not.
 *
 * @property string $reference
 *  Reference to another field. If this property is specified
 *  the Field acts as a symbolic link to another field in the same object
 */
interface FieldInterface {

  //

}

