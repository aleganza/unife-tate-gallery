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
  // filters
  $db = new mysqli($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASSWORD, $MYSQL_DB);

  // foreign key select
  $query = "SELECT DISTINCT at.name, at.id
          FROM artist AS at, artwork AS ak
          WHERE at.id=ak.artist_id
          ORDER BY at.name";
  $rs1 = $db->query($query);
  ?>

  <div class="body-container">
    <div class="page-heading secondary">
      <h1 class="elegant">Correlations</h1>
    </div>
    <form action="correlations" autocomplete="off" method="POST">
      <div class="group">
        <label for="artist_id">Artist name</label>
        <select name="artist_id">
          <option value="" disabled selected>No artist selected</option>
          <?php
          while ($record = $rs1->fetch_assoc()) {
            echo '<option value="' . $record["id"] . '">' . $record["name"] . '</option>';
          }
          ?>
        </select>
      </div>

      <!-- <button class="reset" type="reset">Reset</button> -->
      <button type="submit" class="">Search</button>
    </form>

    <?php
    if (isset($_POST['artist_id'])) {
      $artist_id = $_POST['artist_id'];
      $artworks_query = "SELECT ak.*, at.name
                          FROM artist AS at, artwork AS ak
                          WHERE ak.artist_id=$artist_id AND at.id=ak.artist_id
                          LIMIT 500";

      $result = $db->query($artworks_query);

      if ($result->num_rows > 0) {
        echo '<div class="artworks-table">
            <table>
              <tr>
                <th>ID</th>
                <th>Picture</th>
                <th>Title</th>
                <th>Artist</th>
                <th>Year</th>
                <th>Acquisition Year</th>
                <th>Medium</th>
                <th>Dimensions</th>
              </tr>';

        while ($row = $result->fetch_assoc()) {
          echo '<tr>';
          echo '<td>' . $row['id'] . '</td>';
          echo '<td><img src="' . $row['thumbnail_url'] . '" alt="no picture" class="thumbnail"></td>';
          echo '<td>' . $row['title'] . '</td>';
          echo '<td>' . $row['name'] . '</td>';
          echo '<td>' . $row['year'] . '</td>';
          echo '<td>' . $row['acquisition_year'] . '</td>';
          echo '<td>' . $row['medium'] . '</td>';
          echo '<td>' . $row['width'] . ' x ' . $row['height'] . '' . $row['units'] . '</td>';
          echo '</tr>';
        }

        echo '</table>';
        echo '</div>';
      } else {
        echo '<p>No artworks found.</p>';
      }
    }
    ?>

  </div>
</body>

<?php
require("src/php/components/script.php");
?>

</html>