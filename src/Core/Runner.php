<?php
namespace Modelify\Core;

use Modelify\Interfaces\ModelInterface;
use Modelify\Interfaces\RunnerInterface;

class Runner extends Core implements RunnerInterface {

  /**
   * @ignore
   *
   * @var ModelInterface
   */
  private $xModel;

  /**
   * @ignore
   *
   * @var string
   */
  private $xModelClass;

  protected function init(ModelInterface &$model) {
    $this->http = $this->make(Http::class);

    $this->xModelClass = get_class($model);
    $this->xModel = &$model;
  }

  /**
   * Model Class
   *
   * @return string
   */
  final protected function &modelClass() {
    return $this->xModelClass;
  }

  /**
   * Model
   *
   * @return ModelInterface
   */
  final protected function &model() {
    return $this->xModel;
  }

  /**
   * Runs an action called from Model
   *
   * @param array $data
   * @return mixed
   */
  public function run(Action &$action, array $data = []) {
    //
  }

}
