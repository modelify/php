<?php

namespace Modelify\Interfaces;

interface ConfigInterface {

  /**
   * Call Method
   *
   * @param string $name
   * @param array $parameters
   *
   * @return mixed
   */
  public function call($name, array $parameters = []);

}
