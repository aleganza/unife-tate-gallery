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
  $db = new mysqli($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASSWORD, $MYSQL_DB);
  $params = array(
    "year1" => isset($_POST['year1']) ? $_POST['year1'] : '',
    "state_of_birth" => isset($_POST['state_of_birth']) ? $_POST['state_of_birth'] : '',
    "state_of_death" => isset($_POST["state_of_death"]) ? $_POST["state_of_death"] : '',
    "name" => isset($_POST["name"]) ? $_POST["name"] : '',
    "medium" => isset($_POST["medium"]) ? $_POST["medium"] : '',
    "year2" => isset($_POST["year2"]) ? $_POST["year2"] : '',
    "gender" => isset($_POST["gender"]) ? $_POST["gender"] : '',
  );

  $year1 = $params['year1'];                    // Number of artworks produced in a given year;
  $state_of_birth = $params['state_of_birth'];  // Number of artists born in a certain country;
  $state_of_death = $params['state_of_death'];  // Number of dead artists in a given country;
  $name = $params['name'];                      // Number of artworks per artist;
  $medium = $params['medium'];                  // Number of artists using a certain medium;
  $year2 = $params['year2'];                    // Number of artists who produced artworks in a certain year
  $gender = $params['gender'];                  // Number of artworks made by artists of a certain gender


// Queries of first statistic 
  $query1 = "SELECT DISTINCT year 
              FROM artwork ORDER BY year";
  $query2 = "SELECT COUNT(year) AS cnt
              FROM artwork
              WHERE year='$year1'";

// Queries of second statistic 
  $query3 = "SELECT DISTINCT state_of_birth 
              FROM artist
              ORDER BY state_of_birth";
  $query4 = "SELECT DISTINCT state_of_death
              FROM artist
              ORDER BY state_of_death";
  $query5 = "SELECT COUNT(state_of_birth) AS state_of_birth
              FROM artist 
              WHERE state_of_birth = '$state_of_birth'";
  $query6 = "SELECT COUNT(state_of_death) AS state_of_death
              FROM artist 
              WHERE state_of_death = '$state_of_death'";

// Queries of third statistic 
  $query7 = "SELECT name
              FROM artist
              ORDER BY name";
  $query8 = "SELECT name, COUNT(*) AS artworks 
              FROM artist, artwork 
              WHERE artist.id=artwork.artist_id
              AND artist.name='$name'";

// Queries of fourth statistic 
  $query9 = "SELECT DISTINCT medium 
              FROM artwork
              ORDER BY medium";
  $query10 = "SELECT COUNT(DISTINCT artist.id) AS artists
                FROM artwork, artist
                WHERE artwork.artist_id=artist.id
                AND artwork.medium='$medium'";

// Queries of fifth statistic
  $query11 = "SELECT DISTINCT year
              FROM artwork
              ORDER BY year";
  $query12 = "SELECT DISTINCT count(DISTINCT artist.id) AS artists 
                FROM artist, artwork 
                WHERE artist.id = artwork.artist_id 
                AND artwork.year='$year2'";

// Queries of sixth statistic 
  $query13 = "SELECT DISTINCT gender
              FROM artist";
  $query14 = "SELECT COUNT(*) AS cnt
                FROM artwork, artist
                WHERE artist.id=artwork.artist_id
                AND artist.gender='$gender'";

  $rs1 = $db->query($query1); // First statistic, select options;
  $rs2 = $db->query($query2); // First statistic, table;
  $rs3 = $db->query($query3); // Second statistic, first select options;
  $rs4 = $db->query($query4); // Second statistic, second select options;
  $rs5 = $db->query($query5); // Second statistic, first table;
  $rs6 = $db->query($query6); // Second statistic, second table;
  $rs7 = $db->query($query7); // Third statistic, select options;
  $rs8 = $db->query($query8); // Third statistic, table;
  $rs9 = $db->query($query9); // Fourth statistic, select options;
  $rs10 = $db->query($query10); // Fourth statistic, table;
  $rs11 = $db->query($query11); // Fifth statistic, select options;
  $rs12 = $db->query($query12); // Fifth statistic, table;
  $rs13 = $db->query($query13); // Sixth statistic, select options;
  $rs14 = $db->query($query14); // Sixth statistic, table;
  $record1 = $rs2->fetch_assoc(); // First statistic table row, number of artworks produced in a given year; 
  $record2 = $rs5->fetch_assoc(); // Second statistic table row, number of artists born in a certain country;
  $record3 = $rs6->fetch_assoc(); // Second statistic table row, number of dead artists in a certain country;
  $record4 = $rs8->fetch_assoc(); // Third statistic table row, number of artworks per artist;
  $record5 = $rs10->fetch_assoc(); // Fourth statistic table row, number of artists using a certain medium;
  $record6 = $rs12->fetch_assoc(); // Fifth statistic table row, number of artists who produced artworks in a certain year;
  $record7 = $rs14->fetch_assoc(); // Sixth statistic table row, number of artworks made by artists of a certain gender;
  ?>

  <div class="body-container" id="statistics">
    <div class="page-heading secondary">
      <h1 class="elegant">Statistics</h1>
    </div>
    <div class="statistic-container">
      <div class="statistic">
        <form action="statistics" autocomplete="off" method="POST">
          <div class="group">
            <label for="year1">Year of artwork</label>
            <select name="year1">
              <option value="" <?php echo $params['year1'] == '' ? 'selected' : ''; ?>>Any</option>
              <?php
              while ($record = $rs1->fetch_assoc()) {
                $selected = $record['year'] == $params['year1'] ? 'selected' : '';
                echo '<option value="' . $record["year"] . '" ' . $selected . '>' . $record["year"] . '</option>';
              }
              ?>
            </select>
          </div>
          <button type="submit" class="">Search</button>
        </form>
        <?php
          echo '<div class="artworks-table">
              <table>
                <thead>
                  <tr>
                  <th>Number of artworks made in ' . $year1 . '</th>
                </thead>
                <tbody>
                  <tr>
                    <td>' . $record1["cnt"] . '</td>
                  </tr>
                </tbody>
              </table>
            </div>';
        ?>
      </div>
      <div class="statistic">
        <form action="statistics" autocomplete="off" method="POST">
          <div class="group">
            <label for="state_of_birth">Nation of birth</label>
            <select name="state_of_birth">
              <option value="" <?php echo $params['state_of_birth'] == '' ? 'selected' : ''; ?>>Any</option>
              <?php
              while ($record = $rs3->fetch_assoc()) {
                $selected = $record['state_of_birth'] == $params['state_of_birth'] ? 'selected' : '';
                echo '<option value="' . $record["state_of_birth"] . '" ' . $selected . '>' . $record["state_of_birth"] . '</option>';
              }
              ?>
            </select>
            <label for="state_of_death">Nation of death</label>
            <select name="state_of_death">
              <option value="" <?php echo $params['state_of_death'] == '' ? 'selected' : ''; ?>>Any</option>
              <?php
              while ($record = $rs4->fetch_assoc()) {
                $selected = $record['state_of_death'] == $params['state_of_death'] ? 'selected' : '';
                echo '<option value="' . $record["state_of_death"] . '" ' . $selected . '>' . $record["state_of_death"] . '</option>';
              }
              ?>
            </select>
          </div>
          <button type="submit" class="">Search</button>
        </form>
        <?php
            echo '<div class="artworks-table">
                <table>
                  <thead>
                    <tr>
                    <th>Artists born in ' . $state_of_birth . '</th>
                  </thead>
                  <tbody>
                    <tr>
                      <td>' . $record2["state_of_birth"] . '</td>
                    </tr>
                  </tbody>
                </table>
              </div>';
        ?>
        <?php
            echo '<div class="artworks-table">
                <table>
                  <thead>
                    <tr>
                    <th>Artists death in ' . $state_of_death . '</th>
                  </thead>
                  <tbody>
                    <tr>
                      <td>' . $record3["state_of_death"] . '</td>
                    </tr>
                  </tbody>
                </table>
              </div>';
          ?>
      </div>
      <div class="statistic">
        <form action="statistics" autocomplete="off" method="POST">
          <div class="group">
            <label for="name">Name of artist</label>
            <select name="name">
              <option value="" <?php echo $params['name'] == '' ? 'selected' : ''; ?>>Any</option>
              <?php
              while ($record = $rs7->fetch_assoc()) {
                $selected = $record['name'] == $params['name'] ? 'selected' : '';
                echo '<option value="' . $record["name"] . '" ' . $selected . '>' . $record["name"] . '</option>';
              }
              ?>
            </select>
          </div>
          <button type="submit" class="">Search</button>
        </form>
        <?php
          echo '<div class="artworks-table">
              <table>
                <thead>
                  <tr>
                  <th>Number of artworks made by ' . $name . '</th>
                </thead>
                <tbody>
                  <tr>
                    <td>' . $record4["artworks"] . '</td>
                  </tr>
                </tbody>
              </table>
            </div>';
        ?>
      </div>
    </div>
    <!-- SECOND ROW OF STATISTICS -->
    <div class="statistic-container">
      <div class="statistic">
        <form action="statistics" autocomplete="off" method="POST">
          <div class="group">
            <label for="medium">Medium</label>
            <select name="medium">
              <option value="" <?php echo $params['medium'] == '' ? 'selected' : ''; ?>>Any</option>
              <?php
              while ($record = $rs9->fetch_assoc()) {
                $selected = $record['medium'] == $params['medium'] ? 'selected' : '';
                echo '<option value="' . $record["medium"] . '" ' . $selected . '>' . $record["medium"] . '</option>';
              }
              ?>
            </select>
          </div>
          <button type="submit" class="">Search</button>
        </form>
        <?php
          echo '<div class="artworks-table">
              <table>
                <thead>
                  <tr>
                  <th>Number of artists using ' . $medium . '</th>
                </thead>
                <tbody>
                  <tr>
                    <td>' . $record5["artists"] . '</td>
                  </tr>
                </tbody>
              </table>
            </div>';
        ?>
      </div>
      <div class="statistic">
        <form action="statistics" autocomplete="off" method="POST">
          <div class="group">
            <label for="year2">Year</label>
            <select name="year2">
              <option value="" <?php echo $params['year2'] == '' ? 'selected' : ''; ?>>Any</option>
              <?php
              while ($record = $rs11->fetch_assoc()) {
                $selected = $record['year'] == $params['year2'] ? 'selected' : '';
                echo '<option value="' . $record["year"] . '" ' . $selected . '>' . $record["year"] . '</option>';
              }
              ?>
            </select>
          </div>
          <button type="submit" class="">Search</button>
        </form>
        <?php
            echo '<div class="artworks-table">
                <table>
                  <thead>
                    <tr>
                    <th>Number of artists who painted in ' . $year2 . '</th>
                  </thead>
                  <tbody>
                    <tr>
                      <td>' . $record6["artists"] . '</td>
                    </tr>
                  </tbody>
                </table>
              </div>';
        ?>
      </div>
      <div class="statistic">
        <form action="statistics" autocomplete="off" method="POST">
          <div class="group">
            <label for="gender">Gender</label>
            <select name="gender">
              <option value="" <?php echo $params['gender'] == '' ? 'selected' : ''; ?>>Any</option>
              <?php
              while ($record = $rs13->fetch_assoc()) {
                $selected = $record['gender'] == $params['gender'] ? 'selected' : '';
                echo '<option value="' . $record["gender"] . '" ' . $selected . '>' . $record["gender"] . '</option>';
              }
              ?>
            </select>
          </div>
          <button type="submit" class="">Search</button>
        </form>
        <?php
          echo '<div class="artworks-table">
              <table>
                <thead>
                  <tr>
                  <th>Number of artworks made by ' . $gender . '</th>
                </thead>
                <tbody>
                  <tr>
                    <td>' . $record7["cnt"] . '</td>
                  </tr>
                </tbody>
              </table>
            </div>';
        ?>
      </div>
    </div>
  </div>
</body>

</html>