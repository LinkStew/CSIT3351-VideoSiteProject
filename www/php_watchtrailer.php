<?php
require "php_connection.php";

$id = (int)($_GET['id'] ?? 0);

$stmt = $conn->prepare("SELECT movieID, title, movieImg, summary, releaseYear, director, movieCast, contentRating, language, trailer FROM Movie WHERE movieID = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$movie = $stmt->get_result()->fetch_assoc();

if (!$movie) {
    http_response_code(404);
    die("404 Movie ID is invalid, or has been removed, changed or become unavailable.");
}

require "php_navbar.php";

$rentMessage = ""; // temp message

?>

    <div class="trailer">
        <h1 ><?= htmlspecialchars($movie['title']) ?></h1>
        <p>Rated <?= htmlspecialchars($movie['contentRating']) ?> | <?= htmlspecialchars($movie['language']) ?></p>
        <?php if (!empty($movie['trailer'])): ?> <!-- CHECKS IF 'trailer' exists in database -->
        <video controls>
            <source src="<?= htmlspecialchars($movie['trailer']) ?>" type="video/mp4">
            Your browser does not support HTML video.
        </video>
        <?php else: ?>
            <p>No trailer available.</p>
        <?php endif; ?>   
    </div>

    <br><br><br>

    <div class="summary">
        <p class="summaryHeader"><Strong>Synopsis</Strong></P>
        <p class="summaryBody"> 
            <?= htmlspecialchars($movie['summary']) ?>
        </p>
        <hr>
        <p class="summaryHeader"><strong>Director</strong></p>
        <p class="summaryBody"> <?= htmlspecialchars($movie['director']) ?> </p>
        <hr>
        <p class="summaryHeader"><strong>Cast</strong></p>
        <p class="summaryBody"> <?= htmlspecialchars($movie['movieCast']) ?> </p>    
        <hr>
        <a href="php_form.php?id=<?= (int)$movie['movieID'] ?>">
            <button id="rentBtn">Rent Movie</button>
        </a>

    </div>

    <br><br><br>
    <br><br><br>
    <br><br><br>



<?php require "php_footer.php"; ?>