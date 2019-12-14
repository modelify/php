<?php

use Modelify\Modelify;
use Models\FirstModelDemo;
use Models\SecondModelDemo;
use Models\ThirdModelDemo;

/**
 * Undocumented class
 *
 * @method FirstModelDemo firstModel($data = [])
 * @method SecondModelDemo secondModel($data = [])
 * @method ThirdModelDemo thirdModel($data = [])
 */
class ModelifyDemo extends Modelify {

  const MODELS = [
    'firstModel' => FirstModelDemo::class,
    'secondModel' => SecondModelDemo::class,
    'thirdModel' => ThirdModelDemo::class,
  ];

}
