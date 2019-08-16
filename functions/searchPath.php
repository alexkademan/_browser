<?php

function searchPath($config, $folderContents = true) {

  $fullPath = $config['path'];
  $fullPathArray = explode('/', $fullPath);
  foreach ($fullPathArray as $key => $dir) {
    if ($dir === '') { unset($fullPathArray[$key]); }
  }
  $fullPathObj = getFullPathObj($fullPathArray, $config);
  $mtime = filemtime($fullPath);
  $ctime = filectime($fullPath);

  if (count($fullPathArray) === 0) {
    $name = '/';
  } else {
    $name = $fullPathArray[count($fullPathArray)];
  }

  $results = [
    'config' => $config,
    'fullPath' => $fullPath,
    'fullPathArray' => $fullPathArray,
    'fullPathObj' => $fullPathObj,
    'name' => $name,
    'mtime' => $mtime,
    'ctime' => $mtime,
    'dateArray' => [
      'week' => date('D', $mtime),
      'month' => date('n', $mtime),
      'monthR' => date('M', $mtime),
      'day' => date('j', $mtime),
      'year' => date('Y', $mtime),
      'time' => date('g:i a', $mtime),
      'unix' => date('U', $mtime),
    ],
    'link' => $fullPathObj[count($fullPathArray)]['link'],
    'linkPost' => $fullPathObj[count($fullPathArray)]['linkPost'],
    'type' => file_exists($fullPath) ? filetype($fullPath) : false,
    'ext' => false,
    'size' => -1,
    'contents' => [],
    'contentsCount' => 0,
  ];

  if ($results['type'] === 'file') {
    $bytes = filesize($fullPath);
    $results['ext'] = pathinfo($fullPath, PATHINFO_EXTENSION);
    $results['size'] = $bytes;
    $results['sizeR'] = sizeReadable($bytes);

    if (substr($results['link'], -1) === '/') {
      $results['link'] = substr($results['link'], 0, -1);
    }
  }

  // $results['link'] = getDirLink($fullPath, $config);

  if (is_dir($fullPath)) {
    @$contents = scandir($fullPath);
    // $results['contents'] = [];
    if (is_array($contents)) {
      foreach ($contents as $item) {
        if (
          strpos($item, '.') !== 0 &&
          $item !== 'Thumbs.db'
        ) {
          if ($folderContents) {
            $thisConfig = $config;
            $thisConfig['path'] = $config['path'] . $item;
            $thisItem = searchPath($thisConfig, false);
          } else {
            $thisItem = ['fullPath' => $fullPath . $item];
          }
          array_push($results['contents'], $thisItem);
        }
      }
      $results['contentsCount'] = count ($results['contents']);
    } else {
      $results['contents'] = 'locked';
    }
  }

  return $results;
}
