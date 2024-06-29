<?php

$request = $_SERVER['REQUEST_URI'];

switch($request) {
  case "/unife-tate-gallery/":
    require('src/php/views/home.php');
    break;
  case "/unife-tate-gallery/artisti":
    require('src/php/views/artisti.php');
    break;
  case "/unife-tate-gallery/correlazioni":
    require('src/php/views/correlazioni.php');
    break;
  case "/unife-tate-gallery/opere":
    require('src/php/views/opere.php');
    break;
  case "/unife-tate-gallery/statistiche":
    require('src/php/views/statistiche.php');
    break;
  default:
    require('src/php/views/404.php');
    break;
}

?>