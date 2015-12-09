<?php
session_start();

$GLOBALS['config'] = [
  'mysql' => [
      'host' =>'127.0.0.1',
      'username' => 'root',
      'password' => '',
      'db' => 'registration'
  ],
    'remember' => [
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800,
    ],
    'session' => [
        'session_name' => 'user'
    ]
];

spl_autoload_register(function($class){
    require_once 'classes/' . $class . '.php';
});
require_once "functions/sanitize.php";