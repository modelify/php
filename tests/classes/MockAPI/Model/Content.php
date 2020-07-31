<?php

namespace Modelify\Tests\Classes\MockAPI\Model;

use Modelify\Model;

/**
 * MockAPI Content
 *
 * @property string $id
 *  Content ID
 *
 * @property string $name
 *  Content Name
 *
 * @property string $username
 *  Content Username
 *
 * @property string $email
 *  Content Email
 *
 * @property string $avatar
 *  Content Avatar
 *
 * @property string $createdAt
 *  Date Created
 *
 *
 * @method Content[] all($query = [])
 *  Get All Contents
 *
 * @method Content get($id)
 *  Get Content
 *
 * @method Content create($data = [])
 *  Create New Content
 *
 * @method Content edit($data = [])
 *  Edit Content
 *
 * @method Content delete($id)
 *  Delete Content
 */
class Content extends Model {

  const PATH = '/content';

  const FIELDS = [
    'id' => ['type' => 'string'],
    'name' => ['type' => 'string'],
    'username' => ['type' => 'string'],
    'email' => ['type' => 'string'],
    'avatar' => ['type' => 'string'],
    'createdAt' => ['type' => 'string']
  ];

  const ACTIONS = [
    'all' => [
      'method' => 'GET',
      'arguments' => ['query'],
      'returns' => self::class.'[]'
    ],

    'get' => [
      'path' => '/{id}',
      'method' => 'GET',
      'arguments' => ['@id'],
      'returns' => self::class
    ],

    'create' => [
      'method' => 'POST',
      'data' => [
        'name' => '',
        'username' => '',
        'email' => '',
        'avatar' => '',
      ],
      'arguments' => ['data'],
      'returns' => self::class
    ],

    'edit' => [
      'method' => 'PATCH',
      'data' => [
        'name' => '',
        'username' => '',
        'email' => '',
        'avatar' => '',
      ],
      'arguments' => ['data'],
      'returns' => self::class
    ],

    'delete' => [
      'path' => '/{id}',
      'method' => 'DELETE',
      'arguments' => ['@id'],
      'returns' => self::class
    ],
  ];

}
