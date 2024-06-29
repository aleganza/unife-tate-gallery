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

  <?php
  $db = new mysqli($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASSWORD, $MYSQL_DB);

  // foreign key select
  $sql = "SELECT DISTINCT at.name
            FROM artist AS at, artwork AS ak
            WHERE at.id=ak.artist_id
            ORDER BY at.name";
  $rs1 = $db->query($sql);

  $attributes = [
    "year",
    "acquisition_year",
  ];
  ?>

  <div class="body-container vertical">
    <div class="page-heading secondary">
      <h1 class="elegant">Correlations</h1>
    </div>
    <form action="artworks.php" autocomplete="off" method="POST">
      <div class="group">
        <label for="artist_name">Artist name</label>
        <select name="artist_name" id="artist_name">
          <option value="" disabled selected>Select artist name</option>
          <?php
          while ($record = $rs1->fetch_assoc()) {
            echo '<option value="' . $record["name"] . '">' . $record["name"] . '</option>';
          }
          ?>
        </select>
      </div>
      
      <button type="submit" class="">Search</button>
    </form>
  </div>
</body>

<?php
require("src/php/components/script.php");
?>

</html>