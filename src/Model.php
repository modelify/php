<?php
namespace Modelify;

use Modelify\Core\Action;
use Modelify\Core\Data;
use Modelify\Exceptions\ActionException;
use Modelify\Exceptions\ReflectionException;
use Modelify\Interfaces\ModelInterface;

class Model extends Data implements ModelInterface {

  const PATH = '';

  const PARAMS = [];

  const ACTIONS = [];

  /**
   * @var string
   */
  private $xPath;

  /**
   * @var array
   */
  private $xParams;

  /**
   * @var array
   */
  private $xActions = [];

  protected function init(array $data = []) {
    parent::init($data);

    // Initialize Path
    $this->xPath = $this->implodeConstants('PATH');

    // Initialize URL Parameters
    $this->xParams = $this->mergeConstants('PARAMS');

    // Initialize Actions
    $actions = $this->mergeConstants('ACTIONS');

    foreach ($actions as $name => &$action) {
      $this->xActions[$name] = $this->makeAction($name, $action);
    }
  }

  final public function path($path = NULL) {
    $fullPath = $this->xPath;

    $path = trim($path, '/');

    if (!empty($path)) {
      $fullPath .= '/'.$path;
    }

    return $fullPath;
  }

  final public function params($params = []) {
    return array_merge([], $this->xParams, $params);
  }

  /**
   * Creates a new instance of Action
   *
   * @param array $info
   * @return Action
   */
  private function makeAction($name, $info) {
    return $this->make(Action::class, $this, $name, $info);
  }

  final public function getFullPath($path = NULL) {
    $fullPath = $this->xPath;

    $path = trim($path, '/');
    if (!empty($path)) $fullPath .= '/'.$path;

    return $fullPath;
  }

  public function hasAction($name) {
    return array_key_exists($name, $this->xActions);
  }

  public function getAction($name): Action {
    if (!$this->hasAction($name)) {
      $message = "Action '{$name}' does not exist!";
      throw new ActionException($message);
    }

    return $this->xActions[$name];
  }

  final protected function callAction($name, ...$arguments) {
    $action = $this->getAction($name);
    return $action->exec(...$arguments);
  }

  final public function __call($name, $arguments) {
    try {
      $method = ucfirst($name);
      $method = "call{$method}Action";
      return $this->call($method, $arguments);
    } catch (ReflectionException $e) {
      return $this->callAction($name, ...$arguments);
    }
  }

}
