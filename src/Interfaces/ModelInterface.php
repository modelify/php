<?php
namespace Modelify\Interfaces;

use Modelify\Action\Action;

interface ModelInterface extends DataInterface {

  public function getFullPath($path = NULL);

  /**
   * @param Action $action
   * @return string
   */
  public function getActionPath(Action $action);

}
