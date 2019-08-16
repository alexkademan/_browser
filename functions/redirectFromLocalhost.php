<?php

function redirectFromLocalhost() {
  if ($_SERVER['HTTP_HOST'] === 'localhost') {
    // gotta re-direct.
    $ip = shell_exec('ipconfig getifaddr en0');
    $ip = substr($ip, 0, -1); // remove last char (carriage return)
    $redirectURL = 'http://' . $ip . $_SERVER['REQUEST_URI'];

    header("HTTP/1.1 301 Moved Permanently");
    header("Location: " . $redirectURL);
    exit();
  };
}
