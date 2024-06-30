<?php
function render_artworks($query, $render_page_heading = false)
{
  require("src/php/utils/constants.php");

  echo '<div class="artworks">';

  $db = new mysqli($MYSQL_HOST, $MYSQL_USER, $MYSQL_PASSWORD, $MYSQL_DB);
  $rs = $db->query($query);
  $record = $rs->fetch_assoc();

  // preparing records to be rendered 1 per column
  $columns = [[], [], [], []];
  $artwork = 0;

  while ($record) {
    // skip rows with no image
    while ($record && $record["thumbnail_url"] == "") $record = $rs->fetch_assoc();

    if ($record) {
      $columns[$artwork % 4][] = $record;
      $artwork++;
      $record = $rs->fetch_assoc();
    }
  }

  // render columns
  for ($i = 0; $i < 4; $i++) {
    echo '<div class="column">';

    if ($i == 0 && $render_page_heading) {
      echo '
        <div class="page-heading">
          <h1 class="elegant">Unife<br>Tate <span>Gallery</span></h1>
          <p>
            Project for <strong>Basi di Dati</strong> course at the University of Ferrara by <i>Alessio Ganzarolli</i> and <i>Simone Acuti</i>.
            The purpose of this project is to develop a PHP website to visualize the <strong>Tate Collection</strong> dataset.
          </p>
        </div>
      ';
    }

    // render artworks
    foreach ($columns[$i] as $record) {
      echo '
        <div class="artwork-card">
          <div class="overlay"></div>
          <div class="info">
            <div class="left">' . $record["title"] . '</div>
            <div class="right">
              ' . $record["year"] . '
              <br>
              ' . $record["width"] . 'x' . $record["height"] . '' . $record["units"] . '
            </div>
          </div>
          <img loading="lazy" src="' . $record["thumbnail_url"] . '" alt="">
        </div>';
    }
    echo '</div>';
  }
  echo '</div>';
}
