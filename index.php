<?php
header("Access-Control-Allow-Origin: *");

require_once 'getJSON.php';

$config = getServerInfo();

// print_r(json_encode(searchPath($config)));

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="<?php echo $config['appDirURL'] ?>app/build/favicon.ico" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css?family=Anton|Roboto+Condensed:300&display=swap" rel="stylesheet">    
    <?php
    foreach (glob($config['appDir'] . 'app/build/static/css/*') as $filename) {
      // echo $filename;
      // echo pathinfo($filename, PATHINFO_EXTENSION);
      // echo "\n";
      // echo "</br>";
      // echo "\n";

      if (is_file($filename) && pathinfo($filename, PATHINFO_EXTENSION) === 'css') {
        $filename = explode('/', $filename);
        $filename = $filename[count($filename) - 1];
        $filename = $config['appDirURL'] . 'app/build/static/css/' . $filename;
        echo '<link rel="stylesheet" href="' . $filename . '" />';
      }
    }
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <link rel="manifest" href="<?php echo $config['appDirURL'] ?>app/build/manifest.json" />
    <title>React App</title>
  </head>
  <body>

<div id="root"></div>
<?php
echo '<script>';
echo 'var phpDir = ' . json_encode(searchPath($config));
echo '</script>';
foreach (glob($config['appDir'] . 'app/build/static/js/*') as $filename) {
  if (is_file($filename) && pathinfo($filename, PATHINFO_EXTENSION) === 'js') {
    $filename = explode('/', $filename);
    $filename = $filename[count($filename) - 1];

    // if (substr ($filename, 0, 12) === 'runtime~main') {
      $filename = $config['appDirURL'] . 'app/build/static/js/' . $filename;
      echo '<script src="' . $filename .'"></script>';
    // }
  }
}
?></body>
</html>
