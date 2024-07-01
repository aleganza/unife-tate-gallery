<?php
function render_artirst($query = "SELECT * FROM artist") {
  require("src/php/utils/constants.php");

  $db = new mysqli($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASSWORD, $MYSQL_DB);
  $rs = $db->query($query);

  //echo $query;

  $attributes = [
    "id",
    "name",
    "gender",
    "year_of_birth",
    "year_of_death",
    "city_of_birth",
    "state_of_birth",
    "city_of_death",
    "state_of_death"
  ];

  echo '<div class="artworks-table">
      <table>
        <thead>
          <tr>';

  foreach($attributes as $attr) {
    echo '<th>' . ucfirst(str_replace('_', ' ', $attr)) . '</th>';
  }

  echo '</tr>
      </thead>
      <tbody>';

  while($record = $rs->fetch_assoc()) {
    echo '<tr>';
    foreach($attributes as $attr) {
      echo '<td>' . $record[$attr] . '</td>';
    }
    echo '</tr>';
  }

  echo '</tbody>
      </table>';

}
