<?php

namespace Modelify\Interfaces;

interface DataInterface {

  /**
   * Fill in the data
   *
   * @param array $data
   *
   * @return void
   */
  public function fill(array $data);

  /**
   * @return array
   */
  public function toArray();

  /**
   * Get Attribute
   *
   * @param string $name
   *
   * @return mixed
   */
  public function getAttribute($name);

  /**
   * Set Attribute
   *
   * @param string $name
   * @param mixed $value
   *
   * @return void
   */
  public function setAttribute($name, $value);

}
