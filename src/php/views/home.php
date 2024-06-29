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
    <div class="column">
      <div class="page-heading">
        <h1 class="elegant">Unife<br>Tate <span>Gallery</span>.</h1>
        <p>
          Project for <strong>Basi di Dati</strong> course at the University of Ferrara by <i>Alessio Ganzarolli</i> and <i>Simone Acuti</i>.
          The purpose of this project is to develop a PHP website to visualize the <strong>Tate Collection</strong> dataset.
        </p>
      </div>

      <div class="artwork-card">
        <div class="overlay"></div>
        <img src="/unife-tate-gallery/public/p1.jpg" alt="">
      </div>
    </div>
    <div class="column">
    </div>
    <div class="column">
    </div>
  </div>
</body>

<?php
require("src/php/components/script.php");
?>

</html>