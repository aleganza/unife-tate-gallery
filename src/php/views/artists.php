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
  require("src/php/components/render_artirst.php");

  $db = new mysqli($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASSWORD, $MYSQL_DB);

  $params = array(
    "name" => isset($_POST['name']) ? $_POST['name'] : '',
    "year_of_birth" => isset($_POST['year_of_birth']) ? $_POST['year_of_birth'] : '',
    "year_of_death" => isset($_POST['year_of_death']) ? $_POST['year_of_death'] : '',
    "city_of_birth" => isset($_POST['city_of_birth']) ? $_POST['city_of_birth'] : '',
    "state_of_birth" => isset($_POST['state_of_birth']) ? $_POST['state_of_birth'] : '',
    "city_of_death" => isset($_POST['city_of_death']) ? $_POST['city_of_death'] : '',
    "state_of_death" => isset($_POST['state_of_death']) ? $_POST['state_of_death'] : ''
  );

  $name = $params['name'];
  $year_of_birth = $params['year_of_birth'];
  $year_of_death = $params['year_of_death'];
  $city_of_birth = $params['city_of_birth'];
  $state_of_birth = $params['state_of_birth'];
  $city_of_death = $params['city_of_death'];
  $state_of_death = $params['state_of_death'];

  $artist_query = "SELECT *
                    FROM artist
                    WHERE (name LIKE '%$name%' 
                      AND year_of_birth LIKE '%$year_of_birth%'
                      AND year_of_death LIKE '%$year_of_death%'
                      AND city_of_birth LIKE '%$city_of_birth%' 
                      AND state_of_birth LIKE '%$state_of_birth%' 
                      AND city_of_death LIKE '%$city_of_death%' 
                      AND state_of_death LIKE '%$state_of_death%')";

  $query = "SELECT name
            FROM artist
            ORDER BY name";
  $rs1 = $db->query($query);

  $attributes = [
    "year_of_birth",
    "year_of_death",
    "city_of_birth",
    "state_of_birth",
    "city_of_death",
    "state_of_death",
  ];

  ?>
  <div class="body-container">
    <div class="page-heading secondary">
      <h1 class="elegant">Artists</h1>
    </div>
    <form action="artists" autocomplete="off" method="POST">
      <div class="group">
        <label for="name">Artist name</label>
        <select name="name">
          <option value="" <?php echo $params['name'] == '' ? 'selected' : ''; ?>>Any</option>
          <?php
          while ($record = $rs1->fetch_assoc()) {
            $selected = $record['name'] == $params['name'] ? 'selected' : '';
            echo '<option value="' . $record["name"] . '" ' . $selected . '>' . $record["name"] . '</option>';
          }
          ?>
        </select>
      </div>

      <?php
      foreach ($attributes as $attr) {
        $query = "SELECT DISTINCT $attr FROM artist ORDER BY $attr";
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
      <button type="submit" class="">Search</button>
    </form>
    <?php
    $name == '' && $year_of_birth == '' && $year_of_death == '' && $city_of_birth == '' && $state_of_birth == '' && $city_of_death == '' && $state_of_death == ''
      ? render_artirst()
      : render_artirst($artist_query);
    ?>
  </div>
</body>

</html>