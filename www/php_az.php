<?php 
require "php_connection.php"; 
$result = $conn->query("SELECT movieID, title, movieImg, trailer FROM Movie ORDER BY title");

$sections = [];
while ($movie = $result->fetch_assoc()) {
    $first = strtoupper(substr($movie['title'], 0, 1));
    $key = ctype_digit($first) ? '#' : $first;
    $sections[$key][] = $movie;
}

require "php_navbar.php"
?>

    
        <div class="genereaz-nav">
          <?php foreach (array_keys($sections) as $key): ?>
                <a href="#section-<?= $key === '#' ? 'numeric' : strtolower($key) ?>">
                    <?php
                        if ($key === '#') {
                            echo 'Numeric';
                        } 
                        else {
                            echo $key;
                        }
                    ?>
                </a>
            <?php endforeach; ?>
        </div>

    
  
  <div id="movies" class="movie-grid">
    
    <div class="all-movies-heading">
      <h1>Movies A-Z</h1>
    </div>

    <?php foreach ($sections as $key => $movies): ?>

    <div class="all-movies-heading">
      <p id="section-<?= $key === '#' ? 'numeric' : strtolower($key) ?>">
        <?php
            if ($key === '#') {
                echo 'Numeric';
            } 
            else {
                echo $key;
            }
        ?>
      </p>
    </div>

    <?php foreach ($movies as $movie): ?>
      <div class="glow-box single-movie">
        <div>
          <img src="<?= htmlspecialchars($movie['movieImg']) ?>"
               alt="<?= htmlspecialchars($movie['title']) ?>"
               style="width:230px; height:345px">
        </div>
        <div class="movie-details">
          <h3><?= htmlspecialchars($movie['title']) ?></h3>
          <a href="php_watchtrailer.php?id=<?= (int)$movie['movieID'] ?>">
            <button>Watch Trailer</button>
          </a>
        </div>
      </div>
    <?php endforeach; ?>

  <?php endforeach; ?>
</div>

<?php require "php_footer.php"; ?>