<?php
$current_page = $_SERVER['REQUEST_URI'];
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid navbar-custom">
    <a class="navbar-brand" href="/unife-tate-gallery/">Unife Tate Gallery</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == '/unife-tate-gallery/') ? 'active' : '' ?>" aria-current="page" href="/unife-tate-gallery/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == '/unife-tate-gallery/artisti') ? 'active' : '' ?>" aria-current="page" href="/unife-tate-gallery/artisti">Artisti</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == '/unife-tate-gallery/correlazioni') ? 'active' : '' ?>" aria-current="page" href="/unife-tate-gallery/correlazioni">Correlazioni</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == '/unife-tate-gallery/opere') ? 'active' : '' ?>" aria-current="page" href="/unife-tate-gallery/opere">Opere</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($current_page == '/unife-tate-gallery/statistiche') ? 'active' : '' ?>" aria-current="page" href="/unife-tate-gallery/statistiche">Statistiche</a>
        </li>
      </ul>
    </div>
  </div>
</nav>