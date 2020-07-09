<?php
namespace Modelify;

use Modelify\Action\Action;
use Modelify\Core\Runner;
use Modelify\Exceptions\ActionDoesNotExistException;
use Modelify\Exceptions\InvalidMethodException;
use Modelify\Interfaces\ModelInterface;
use Modelify\Traits\BuildModelParams;
use Modelify\Traits\BuildModelPath;

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
   * @var Runner
   */
  private $xRunner;

  /**
   * @var array
   */
  private $xActions = [];

  protected function initialize() {
    $this->xPath = $this->implodeConstants('PATH');

    $this->xParams = $this->mergeConstants('PARAMS');
    $this->xActions = $this->mergeConstants('ACTIONS');

    $this->xRunner = $this->c(Runner::class, $this);
  }

  /**
   * Creates a new instance of Action
   *
   * @param array $info
   * @return Action
   */
  private function makeAction($info) {
    $action = $this->c(Action::class, $info);
    return $action;
  }

  final public function getFullPath($path = NULL) {
    $fullPath = $this->xPath;

    $path = trim($path, '/');
    if (!empty($path)) $fullPath .= '/'.$path;

    return $fullPath;
  }

  final public function getActionPath($name) {
    $action = $this->getAction($name);
    if (!array_key_exists('path', $action)) $action['path'] = '';
    if (!array_key_exists('params', $action)) $action['params'] = [];

    $fullPath = $this->getFullPath($action['path']);
    $params = array_merge($this->xParams, $action['params']);

    return $this->interpolate($fullPath, $params);
  }

  public function hasAction($name) {
    return array_key_exists($name, $this->xActions);
  }

  public function getAction($name) {
    if (!$this->hasAction($name)) {
      $message = "Action '{$name}' does not exist!";
      throw new ActionDoesNotExistException($message);
    }

    return $this->xActions[$name];
  }

  final public function callAction($name, ...$arguments) {
    $action = $this->getAction($name);
    return $this->xRunner->run($action, ...$arguments);
  }

  final public function __call($name, $arguments) {
    try {
      $method = ucfirst($name);
      $method = "call{$method}Action";
      return $this->call($method, $arguments);
    } catch (InvalidMethodException $e) {
      return $this->callAction($name, ...$arguments);
    }
  }

}
