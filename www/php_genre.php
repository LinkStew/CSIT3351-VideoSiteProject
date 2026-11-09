<?php 
require "php_connection.php"; 
$result = $conn->query("SELECT movieID, title, movieImg, trailer, genre FROM Movie ORDER BY title");

$sections = [];
while ($movie = $result->fetch_assoc()) {
    $genre = trim($movie['genre'] ?? '') !== '' ? trim($movie['genre']) : 'Other';
    $sections[$genre][] = $movie;
}

function genreId($name) {
    return 'genre-' . preg_replace('/[^a-z0-9]/', '', strtolower($name));
}

require "php_navbar.php"
?>

    
        <div class="genereaz-nav">
            <?php foreach (array_keys($sections) as $genre): ?>
                <a href="#<?= genreId($genre) ?>"><?= htmlspecialchars($genre) ?></a>
            <?php endforeach; ?>
        </div>

    
  
  <div id="movies" class="movie-grid">
    
    <?php foreach ($sections as $genre => $movies): ?>

    <div class="all-movies-heading">
      <p id="<?= genreId($genre) ?>"><?= htmlspecialchars($genre) ?></p>
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