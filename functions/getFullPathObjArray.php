<?php

function getFullPathObjArray($dir, $path, $config) {
  $array = [
    'name' => $dir,
    'path' => $path,
    'link' => getDirLink($path, $config),
    'linkPost' => $config['rootURL'] . '?location=' . $path,
  ];
  return $array;
}
