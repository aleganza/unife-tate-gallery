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
    <div class="column" id="col1">
      <!-- Colonna 1 -->
    </div>
    <div class="column" id="col2">
      <!-- Colonna 2 -->
    </div>
    <div class="column" id="col3">
      <!-- Colonna 3 -->
    </div>

    <?php
    $db = new mysqli("localhost", "root", "", "unife_tate_gallery");
    $sql = "SELECT thumbnail_url FROM artwork LIMIT 50";
    $rs = $db->query($sql);
    $record = $rs->fetch_assoc();

    $colCounter = 1;

    while ($record) {
      $imgPath = $record['thumbnail_url'];
      
      echo "<script>
        var col = document.getElementById('col$colCounter');
        var div = document.createElement('div');
        div.className = 'artwork-card';
        div.innerHTML = '<div class=\"overlay\"></div><img src=\"$imgPath\" alt=\"Artwork Image\">';
        col.appendChild(div);
      </script>";

      $colCounter++;
      if ($colCounter > 3) {
        $colCounter = 1;
      }
      
      $record = $rs->fetch_assoc();
    }
    ?>
  </div>
</body>

<?php
require("src/php/components/script.php");
?>

</html>
