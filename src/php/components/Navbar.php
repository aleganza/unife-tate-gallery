<header>
  <nav>
    <p>LOGO</p>
  </nav>
  <nav>
    <?php
    $current_page = basename($_SERVER['PHP_SELF']);
    ?>
    <a href="index.php" class="<?= ($current_page == 'index.php') ? 'active' : '' ?>">Home</a>
    <a href="artisti.php" class="<?= ($current_page == 'artisti.php') ? 'active' : '' ?>">Artisti</a>
    <a href="correlazioni.php" class="<?= ($current_page == 'correlazioni.php') ? 'active' : '' ?>">Correlazioni</a>
    <a href="opere.php" class="<?= ($current_page == 'opere.php') ? 'active' : '' ?>">Opere</a>
    <a href="statistiche.php" class="<?= ($current_page == 'statistiche.php') ? 'active' : '' ?>">Statistiche</a>
  </nav>
</header>
<hr />