<?php
require("src/php/utils/constants.php");

$request = $_SERVER['REQUEST_URI'];

switch($request) {
  case "/$PROJECT_NAME/":
    require('src/php/views/home.php');
    break;
  case "/$PROJECT_NAME/artisti":
    require('src/php/views/artisti.php');
    break;
  case "/$PROJECT_NAME/correlazioni":
    require('src/php/views/correlazioni.php');
    break;
  case "/$PROJECT_NAME/opere":
    require('src/php/views/opere.php');
    break;
  case "/$PROJECT_NAME/statistiche":
    require('src/php/views/statistiche.php');
    break;
}

?>