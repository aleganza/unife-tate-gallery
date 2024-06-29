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
  <div class="body-wrapper">

    <?php
    require("src/php/utils/constants.php");

    $db = new mysqli($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASSWORD, $MYSQL_DB);
    $sql = "SELECT * FROM artwork LIMIT 500, 90";
    $rs = $db->query($sql);
    $record = $rs->fetch_assoc();

    $artwork = 1;

    for ($i = 1; $i <= 4; $i++) {
      echo '<div class="column">';

      if ($i == 1) {
        echo '
          <div class="page-heading">
            <h1 class="elegant">Unife<br>Tate <span>Gallery</span></h1>
            <p>
              Project for <strong>Basi di Dati</strong> course at the University of Ferrara by <i>Alessio Ganzarolli</i> and <i>Simone Acuti</i>.
              The purpose of this project is to develop a PHP website to visualize the <strong>Tate Collection</strong> dataset.
            </p>
          </div>
        ';
      }

      while ($record && $artwork % 12 != 0) {
        # skip rows with no image
        while($record["thumbnail_url"] == "") $record = $rs->fetch_assoc();

        echo '
          <div class="artwork-card">
            <div class="overlay"></div>
            <div class="info">
              <div class="left">' . $record["title"] . '</div>
              <div class="right">
                ' . $record["year"] . '
                <br>
                ' . $record["width"] . 'x' . $record["height"] . '
              </div>
            </div>
            <img src="' . $record["thumbnail_url"] . '" alt="">
          </div>';

        $record = $rs->fetch_assoc();
        $artwork++;
      }
      echo '</div>';

      $artwork = 1;
    }
    ?>
  </div>
</body>

<?php
require("src/php/components/script.php");
?>

</html>