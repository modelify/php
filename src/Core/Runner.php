<?php
namespace Modelify\Core;

use Modelify\Action\Action;
use Modelify\Interfaces\ModelifyInterface;
use Modelify\Interfaces\ModelInterface;

final class Runner extends Core {

  /**
   * @ignore
   *
   * @var ModelInterface
   */
  private $model;

  /**
   * @ignore
   *
   * @var string
   */
  private $modelClass;

  /**
   * @ignore
   *
   * @var Http
   */
  private $http;

  final function __construct(ModelifyInterface &$app, ModelInterface &$model) {
    parent::__construct($app);
    $this->http = $this->c(Http::class);
    $this->modelClass = get_class($model);
    $this->model = &$model;
  }

  /**
   * Runs an action called from Model
   *
   * @param Action $action
   * @param array $data
   * @return mixed
   */
  public function run(Action $action, array $data = []) {
    $path = $this->model->getActionPath($action);
    $returnType = (isset($action->returns)) ? $action->returns : $this->modelClass;

    $this->model->fill($data);

    $newData = $this->model->toArray();
    $response = $this->http->request($action->method, $path, $newData);

    return $this->cast($returnType, $response);
  }

}
