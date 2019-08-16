<?php

if (isset($_GET['openFinder'])) {
  $path = urldecode($_GET['openFinder']);
  if (is_dir($path)) { shell_exec('open -R ' . $path); };
  echo $path;
  exit;
}

// get all functions from functions dir:
foreach (glob('functions/*') as $filename) { require_once $filename; }

// go from 'localhost' to IP address:
redirectFromLocalhost();
