<?php
namespace Modelify\Interfaces;

use Modelify\Action\Action;

interface ModelInterface extends DataInterface {

  /**
   * Get Full Path for model
   *
   * @param string $path
   *
   * @return string
   */
  public function path($path = NULL);

  /**
   * Get all URL parameters for model
   *
   * @param array $params
   *
   * @return void
   */
  public function params($params = []);

}
