<?php
header("Access-Control-Allow-Origin: *");

require_once 'getJSON.php';
// $results = searchPath($config);
// print_r($results);
print_r(json_encode(searchPath($config)));


// echo '<h1>' . $results['name'] . '</h1>';
// echo '<h2>';
// if ($config['server'] === $config['visitorIP']) {
//   echo '<a href="' . $config['rootURL'] . '?openFinder=' . urlencode($results['fullPath']) . '">';
// }
// echo $results['fullPath'];
// if ($config['server'] === $config['visitorIP']) { echo '</a>'; }
// echo '</h2>';
//
// if (isset($results['contents'])) {
//   foreach ($results['contents'] as $result) {
//     echo '<a href="';
//     echo $result['link'] ? $result['link'] : $result['linkPost'];
//     echo '">';
//     echo $result['name'];
//     echo '</a>';
//     echo '<br />';
//   }
// }
