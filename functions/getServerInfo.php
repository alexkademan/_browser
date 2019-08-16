<?php

function getServerInfo() {
  // $currentPath = '';
  // if (isset($_SERVER['REDIRECT_URL'])) {
  //   $currentPath = $_SERVER['REDIRECT_URL'];
  // }
  // print_r($_SERVER);

  $appDir = explode('/', $_SERVER['PHP_SELF']);

  $appDir[count($appDir) -1] = '';
  $appDir = implode('/', $appDir);

  $config = [
    'server' => $_SERVER['HTTP_HOST'],
    'visitorIP' => $_SERVER['REMOTE_ADDR'],
    'serverDir' => $_SERVER['CONTEXT_DOCUMENT_ROOT'] . '/',
    'path' => $_SERVER['CONTEXT_DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI'],
    'appURL' => $_SERVER['PHP_SELF'],
    'appDir' => $_SERVER['CONTEXT_DOCUMENT_ROOT'] . $appDir,
    'appDirURL' => 'http://' . $_SERVER['HTTP_HOST'] . $appDir,
    'rootURL' => 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'],
  ];

  if (isset($_GET['location'])) {
    $config['path'] = urldecode($_GET['location']);
    if (substr($config['path'], -1) !== '/') {
      $config['path'] = $config['path'] . '/';
    }
    $config['path'] = $config['path'];
  }

  if (isset($_GET['root'])) {
    $config['path'] = $config['serverDir'];
  }

  return $config;
}
