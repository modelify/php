<?php
namespace Modelify\Core;

use GuzzleHttp\Client;

final class Http extends Core {

  /**
   * @ignore
   *
   * @var Client
   */
  private $client;

  protected function initialize() {
    parent::initialize();

    // $this->client = new Client([
    //   'base_uri' => ''
    // ]);
  }

  public function request($method, $path, $data = NULL, array $headers = []) {
    return NULL;
  }

  public function get($path, array $data = [], array $headers = []) {
    return $this->request('GET', $path, $data, $headers);
  }

  public function post($path, array $data = [], array $headers = []) {
    return $this->request('POST', $path, $data, $headers);
  }

  public function patch($path, array $data = [], array $headers = []) {
    return $this->request('PATCH', $path, $data, $headers);
  }

  public function put($path, $data = NULL, array $headers = []) {
    return $this->request('PUT', $path, $data, $headers);
  }

  public function delete($path, $data = NULL, array $headers = []) {
    return $this->request('DELETE', $path, $data, $headers);
  }

}
