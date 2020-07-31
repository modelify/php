<?php

namespace Modelify\Interfaces;

/**
 * Configuration Type
 *
 * Base Class for Configuration Type
 */
interface ConfigTypeInterface {

  /**
   * Configuration Options
   *
   * @return array
   */
  public function options(): array;

}
