<?php
namespace Modelify\Core;

use Modelify\Interfaces\ModelifyInterface;

class Core {

  /**
   * @ignore
   *
   * @var ModelifyInterface
   */
  private $_app;

  function __construct(ModelifyInterface &$app) {
    $this->_app = &$app;
  }

  protected function initialize() {
    //
  }

  final public function app() {
    return $this->_app;
  }

}
