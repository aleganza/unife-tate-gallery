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
      <h1 class="elegant">Search <span>artworks</span></h1>
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

      <?php
      foreach ($attributes as $attr) {
        $sql = "SELECT DISTINCT $attr FROM artwork ORDER BY $attr";
        $rs = $db->query($sql);

        echo '<div class="group">';
        echo '<label for="' . $attr . '">' . ucfirst(str_replace('_', ' ', $attr)) . '</label>';
        echo '<select name="' . $attr . '" id="' . $attr . '">';
        echo '<option value="" disabled selected>Select ' . ucfirst(str_replace('_', ' ', $attr)) . '</option>';
        while ($record = $rs->fetch_assoc()) {
          echo '<option value="' . $record[$attr] . '">' . $record[$attr] . '</option>';
        }
        echo '</select>';
        echo '</div>';
      }

      $db->close();
      ?>

      <button type="submit" class="">Search</button>
    </form>
  </div>
</body>

<?php
require("src/php/components/script.php");
?>

</html>