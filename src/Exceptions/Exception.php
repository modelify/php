<?php
namespace Modelify\Exceptions;

use Exception as GlobalException;

/**
 * Exception is the base class for all Modelify Exceptions.
 */
class Exception extends GlobalException {

  function __construct($message, $code = 0) {
    parent::__construct($message, $code);
  }

}
