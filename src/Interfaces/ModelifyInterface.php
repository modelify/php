<?php
namespace Modelify\Interfaces;

interface ModelifyInterface {

  /**
   * Configuration
   *
   * @return ConfigInterface
   */
  public function &config(): ConfigInterface;

}
