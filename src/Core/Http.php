<?php
namespace Modelify\Core;

use GuzzleHttp\Client;
use Modelify\Interfaces\RunnerInterface;
use Psr\Http\Message\ResponseInterface;

final class Http extends Core {

  /**
   * @ignore
   *
   * @var Client
   */
  private $client;

  /**
   * Runner
   *
   * @var RunnerInterface
   */
  private $xRunner;

  protected function init(RunnerInterface &$runner) {
    // $this->client = new Client([
    //   'base_uri' => ''
    // ]);
  }

  private function response(ResponseInterface &$response) {
    //
  }

  public function request($method, $path, array $options = []) {

    $options = [];

    $response = $this->client->request($method, $path, $options);

    return $this->response($response);
  }

  public function get($path, array $options = []) {
    return $this->request('GET', $path, $options);
  }

  public function post($path, array $options = []) {
    return $this->request('POST', $path, $options);
  }

  public function patch($path, array $options = []) {
    return $this->request('PATCH', $path, $options);
  }

  public function put($path, array $options = []) {
    return $this->request('PUT', $path, $options);
  }

  public function delete($path, array $options = []) {
    return $this->request('DELETE', $path, $options);
  }

}
