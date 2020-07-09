<?php
namespace Models;

use Modelify\Model;

/**
 * Undocumented class
 *
 * @method FirstModelDemo create($data = [])
 */
class FirstModelDemo extends Model {

  const PATH = '{{first}}';

  const PARAMS = [
    'first' => 'id'
  ];

  const FIELDS = [
    'id' => ['type' => 'string'],
    'firstName' => ['type' => 'string'],
    'lastName' => ['type' => 'string'],
    'email' => ['type' => 'string'],
    'phone' => ['type' => 'string'],
  ];

  const ACTIONS = [
    'create' => [
      'method' => 'POST',
      // 'params' => ['type' => 'array'],
      'data' => [
        'firstName' => ['required' => true],
        'lastName' => ['required' => true],
        'email' => ['required' => true],
        'phone' => ['required' => true]
      ],
      'returns' => FirstModelDemo::class
    ]
  ];

}
