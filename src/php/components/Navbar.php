<?php
$current_page = $_SERVER['REQUEST_URI'];
?>
<header>
  <div class="container">
    <nav>
      <div class="brand">
        <img src="/unife-tate-gallery/public/logo.png" alt="va minga">
      </div>
      <div class="nav-items">
        <a href="/unife-tate-gallery/" class="<?= ($current_page == '/unife-tate-gallery/') ? 'active' : '' ?>">Home</a>
        <a href="/unife-tate-gallery/artisti" class="<?= ($current_page == '/unife-tate-gallery/artisti') ? 'active' : '' ?>">Artisti</a>
        <a href="/unife-tate-gallery/correlazioni" class="<?= ($current_page == '/unife-tate-gallery/correlazioni') ? 'active' : '' ?>">Correlazioni</a>
        <a href="/unife-tate-gallery/opere" class="<?= ($current_page == '/unife-tate-gallery/opere') ? 'active' : '' ?>">Opere</a>
        <a href="/unife-tate-gallery/statistiche" class="<?= ($current_page == '/unife-tate-gallery/statistiche') ? 'active' : '' ?>">Statistiche</a>
      </div>
    </nav>
  </div>
</header>
<hr />