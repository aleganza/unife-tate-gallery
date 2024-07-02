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
  // render data
  require("src/php/components/render_artworks.php");

  $params = array(
    "artist_id" => isset($_POST['artist_id']) ? $_POST['artist_id'] : '',
    "medium" => isset($_POST['medium']) ? $_POST['medium'] : '',
    "year" => isset($_POST['year']) ? $_POST['year'] : '',
    "acquisition_year" => isset($_POST['acquisition_year']) ? $_POST['acquisition_year'] : ''
  );

  $artist_id = $params['artist_id'];
  $medium = $params['medium'];
  $year = $params['year'];
  $acquisition_year = $params['acquisition_year'];

  $artworks_query = "SELECT *
            FROM artwork
            WHERE (artist_id LIKE '%$artist_id%' AND medium LIKE '%$medium%' AND year LIKE '%$year%' AND acquisition_year LIKE '%$acquisition_year%')
            LIMIT 500";

  // filters
  $db = new mysqli($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASSWORD, $MYSQL_DB);

  // foreign key select
  $query = "SELECT DISTINCT at.name, at.id
          FROM artist AS at, artwork AS ak
          WHERE at.id=ak.artist_id
          ORDER BY at.name";
  $rs1 = $db->query($query);

  $attributes = [
    "medium",
    "year",
    "acquisition_year",
  ];
  ?>

  <div class="body-container">
    <div class="page-heading secondary">
      <h1 class="elegant">Search <span>Artworks</span></h1>
    </div>
    <form action="artworks" autocomplete="off" method="POST">
      <div class="group">
        <label for="artist_id">Artist name</label>
        <select name="artist_id">
          <option value="" <?php echo $params['artist_id'] == '' ? 'selected' : ''; ?>>Any</option>
          <?php
          while ($record = $rs1->fetch_assoc()) {
            $selected = $record["id"] == $params['artist_id'] ? 'selected' : '';
            echo '<option value="' . $record["id"] . '" ' . $selected . '>' . $record["name"] . '</option>';
          }
          ?>
        </select>
      </div>

      <?php
      foreach ($attributes as $attr) {
        $query = "SELECT DISTINCT $attr FROM artwork ORDER BY $attr";
        $rs = $db->query($query);

        echo '<div class="group">';
        echo '<label for="' . $attr . '">' . ucfirst(str_replace('_', ' ', $attr)) . '</label>';
        echo '<select name="' . $attr . '">';
        echo '<option value="" ' . ($params[$attr] == '' ? 'selected' : '') . '>Any</option>';
        while ($record = $rs->fetch_assoc()) {
          $selected = $record[$attr] == $params[$attr] ? 'selected' : '';
          echo '<option value="' . $record[$attr] . '" ' . $selected . '>' . $record[$attr] . '</option>';
        }
        echo '</select>';
        echo '</div>';
      }

      $db->close();
      ?>

      <!-- <button class="reset" type="reset">Reset</button> -->
      <button type="submit" class="">Search</button>
    </form>

    <?php
    render_artworks($artworks_query);
    ?>
  </div>
</body>

<?php
require("src/php/components/script.php");
?>

</html>
