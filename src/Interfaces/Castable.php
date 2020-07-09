<?php

namespace Modelify\Interfaces;

interface Castable {

  /**
   * Cast data from `$data` to `Castable`
   *
   * @param ModelifyInterface $app
   * @param mixed ...$params
   *
   * @return Castable
   */
  public static function from(ModelifyInterface &$app, ...$params);

}

