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
        <a href="/unife-tate-gallery/artists" class="<?= ($current_page == '/unife-tate-gallery/artists') ? 'active' : '' ?>">artists</a>
        <a href="/unife-tate-gallery/correlations" class="<?= ($current_page == '/unife-tate-gallery/correlations') ? 'active' : '' ?>">correlations</a>
        <a href="/unife-tate-gallery/artworks" class="<?= ($current_page == '/unife-tate-gallery/artworks') ? 'active' : '' ?>">artworks</a>
        <a href="/unife-tate-gallery/statistics" class="<?= ($current_page == '/unife-tate-gallery/statistics') ? 'active' : '' ?>">statistics</a>
      </div>
    </nav>
  </div>
  <hr />
</header>