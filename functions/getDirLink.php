<?php

function getDirLink($path, $config) {
  $link = false;
  if (
    substr($path, 0, strlen($config['serverDir'])) ===
      $config['serverDir']
  ) {
    // $results['apache'] = true;
    $link = 'http://' . $config['server'] . '/' .
      str_replace($config['serverDir'], '', $path);
  }

  return $link;
}
