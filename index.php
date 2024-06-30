<?php
require("src/php/utils/constants.php");

$request = parse_url($_SERVER['REQUEST_URI'])['path'];

function abort() {
  http_response_code(404);
  require("src/php/views/404.php");
  die();
}

$routes = [
  "/$PROJECT_NAME/" => "src/php/views/home.php",
  "/$PROJECT_NAME/artists" => "src/php/views/artists.php",
  "/$PROJECT_NAME/correlations" => "src/php/views/correlations.php",
  "/$PROJECT_NAME/artworks" => "src/php/views/artworks.php",
  "/$PROJECT_NAME/statistics" => "src/php/views/statistics.php",
];

if(array_key_exists($request, $routes)) {
  require($routes[$request]);
}
else {
  abort();
}

?>