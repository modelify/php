<?php
require_once __DIR__.'/../vendor/autoload.php';

spl_autoload_register(function ($className) {
  if (substr($className, -4) !== 'Demo') return;

  $className = str_replace('\\', '/', $className);
  $path = __DIR__."/demo/{$className}.php";
  if (!is_file($path)) return;

  require_once $path;
});

require_once __DIR__.'/includes/ModelifyTestCase.php';

