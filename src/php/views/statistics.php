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
    "year" => isset($_POST['year']) ? $_POST['year'] : '',
    "state_of_birth" => isset($_POST['state_of_birth']) ? $_POST['state_of_birth'] : '',
    "state_of_death" => isset($_POST["state_of_death"]) ? $_POST["state_of_death"] : '',
    "name" => isset($_POST["name"]) ? $_POST["name"] : '',
  );

  $year = $params['year'];
  $state_of_birth = $params['state_of_birth'];
  $state_of_death = $params['state_of_death'];
  $name = $params['name'];

  $query1 = "SELECT DISTINCT year 
              FROM artwork ORDER BY year";
  $query2 = "SELECT COUNT(year) as cnt
              FROM artwork
              WHERE year='$year'";
  $query3 = "SELECT DISTINCT state_of_birth 
              FROM artist";
  $query4 = "SELECT DISTINCT state_of_death
              FROM artist";
  $query5 = "SELECT COUNT(state_of_birth) AS state_of_birth
              FROM artist 
              WHERE state_of_birth = '$state_of_birth'";
  $query6 = "SELECT COUNT(state_of_death) AS state_of_death
              FROM artist 
              WHERE state_of_death = '$state_of_death'";
  $query7 = "SELECT name
              FROM artist";
  $query8 = "SELECT name, COUNT(*) as artworks 
              FROM artist, artwork 
              WHERE artist.id=artwork.artist_id
              AND artist.name='$name'";

  $rs1 = $db->query($query1);
  $rs2 = $db->query($query2);
  $rs3 = $db->query($query3);
  $rs4 = $db->query($query4);
  $rs5 = $db->query($query5);
  $rs6 = $db->query($query6);
  $rs7 = $db->query($query7);
  $rs8 = $db->query($query8);
  $record1 = $rs2->fetch_assoc();
  $record2 = $rs5->fetch_assoc();
  $record3 = $rs6->fetch_assoc();
  $record4 = $rs8->fetch_assoc();
  ?>

  <div class="body-container">
    <div class="page-heading secondary">
      <h1 class="elegant">Statistics</h1>
    </div>
    <div class="statistic-container">
      <div class="statistic">
        <form action="statistics" autocomplete="off" method="POST">
          <div class="group">
            <label for="year">Year of artwork</label>
            <select name="year">
              <option value="" <?php echo $params['year'] == '' ? 'selected' : ''; ?>>Any</option>
              <?php
              while ($record = $rs1->fetch_assoc()) {
                $selected = $record['year'] == $params['year'] ? 'selected' : '';
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
                  <th>Number of artworks made in ' . $year . '</th>
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
  </div>
</body>

</html>