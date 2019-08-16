<?php

function getFullPathObj($fullPathArray, $config) {
  $path = '/';
  $fullPathObj = [
    0 => getFullPathObjArray('', $path, $config),
  ];
  foreach ($fullPathArray as $dir) {
    $path = $path . $dir . '/';
    $pathArray = getFullPathObjArray($dir, $path, $config);
    $fullPathObj[count($fullPathObj)] = $pathArray;
  }

  return $fullPathObj;
}
