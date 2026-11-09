<?php 
require "php_connection.php"; 
$result = $conn->query("SELECT movieID, title, movieImg, trailer FROM Movie ORDER BY title");
require "php_navbar.php"
?>
    
  <!-- Start of movies grid -->
  <div id="movies" class="movie-grid">
    
    <div class="all-movies-heading">
      <h1> All Movies</h1>
      <p>Page 1</p>
    </div>

    <!-- --ORIGINAL HTML BOX TEMPLATE--
    <div class="glow-box single-movie">
      <div>
        <img src="[[MOVIE IMAGE]]"
        alt="[[MOVIE TITLE]]"
        style="width:230px; height:345px">
      </div>
      <div class="movie-details">
        <h3>[[MOVIE TITLE]]</h3>
        <button id="moviebutton">Watch Trailer</button>
      </div>
    </div>
    -->

    <?php while ($movie = $result->fetch_assoc()): ?>
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
  <?php endwhile; ?>


</div>

<?php require "php_footer.php"; ?>
