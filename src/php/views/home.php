<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  require("src/php/components/head.php");
  ?>
</head>

<body>
  <?php
  require("src/php/components/navbar.php");
  ?>
  <div class="body-container">
    <?php
    require("src/php/components/render_artworks.php");
    $randomOffset = rand(0, 10000);

    render_artworks("SELECT * FROM artwork LIMIT $randomOffset, 50", true);
    ?>
  </div>
</body>

<?php
require("src/php/components/script.php");
?>

</html>