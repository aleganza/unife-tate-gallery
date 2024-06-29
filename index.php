<?php
require("src/php/utils/constants.php");

$request = $_SERVER['REQUEST_URI'];

switch($request) {
  case "/$PROJECT_NAME/":
    require('src/php/views/home.php');
    break;
  case "/$PROJECT_NAME/artists":
    require('src/php/views/artists.php');
    break;
  case "/$PROJECT_NAME/correlations":
    require('src/php/views/correlations.php');
    break;
  case "/$PROJECT_NAME/artworks":
    require('src/php/views/artworks.php');
    break;
  case "/$PROJECT_NAME/statistics":
    require('src/php/views/statistics.php');
    break;
}

?>