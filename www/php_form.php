<?php 
require "php_connection.php"; 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
date_default_timezone_set('America/Chicago');

// Must be logged in to rent
if (!isset($_SESSION['userID'])) {
    $_SESSION['flash'] = "Please log in to rent a movie.";
    header("Location: php_login.php");
    exit;
}
$id = (int)($_GET['id'] ?? 0);

$stmt = $conn->prepare("SELECT movieID, title, movieImg, summary, releaseYear, director, movieCast, contentRating, language, trailer FROM Movie WHERE movieID = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$movie = $stmt->get_result()->fetch_assoc();

if (!$movie) {
    http_response_code(404);
    die("404 Movie ID is invalid, or has been removed, changed or become unavailable.");
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $days = (int)($_POST['timeline'] ?? 0);

    if (!in_array($days, [3, 6, 9], true)) {
        $error = "Please choose a rental timeline.";
    } else {
        $userID     = (int)$_SESSION['userID'];
        $movieID    = (int)$movie['movieID'];
        $now        = date('Y-m-d H:i:s');
        $returnDate = date('Y-m-d H:i:s', strtotime("+$days days"));

        // Block renting a movie that's still on an active rental
        $stmt = $conn->prepare("SELECT returnDate FROM Rental WHERE userID = ? AND movieID = ? AND returnDate > ?");
        $stmt->bind_param("iis", $userID, $movieID, $now);
        $stmt->execute();
        $existing = $stmt->get_result()->fetch_assoc();

        if ($existing) {
            $error = "You already have this movie rented until "
                   . date('F j, Y g:i A', strtotime($existing['returnDate'])) . ".";
        } else {
            $stmt = $conn->prepare(
                "INSERT INTO Rental (userID, movieID, rentDate, returnDate)
                 VALUES (?, ?, ?, ?)
                 ON DUPLICATE KEY UPDATE rentDate = VALUES(rentDate), returnDate = VALUES(returnDate)"
            );
            $stmt->bind_param("iiss", $userID, $movieID, $now, $returnDate);
            $stmt->execute();

            $_SESSION['flash'] = "Rental successful: return date "
                               . date('F j, Y g:i A', strtotime($returnDate));
            header("Location: php_home.php");
            exit;
        }
    }
}

require "php_navbar.php"
?>
    
  
<div class="rentalBox">
<form method="post">

    <div class="rentalBoxHead">
        <h1>Rental Form</h1>
    </div>

    <?php if ($error): ?>
      <p style="color:black"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <div class="rentalRow">
        <h2>Movie Name:</h2>
        <p><?= htmlspecialchars($movie['title']) ?></p>
    </div>

    <div class="rentalSection">
        <h2>Rental Timeline:</h2>
    <div class="rentalOptions">
        <label><input type="radio" name="timeline" value="3"> 3 days</label>
        <label><input type="radio" name="timeline" value="6"> 6 days</label>
        <label><input type="radio" name="timeline" value="9"> 9 days</label>
    </div>
        <p>*Fee Notice: If movie is not returned by the end of specified timeline, a 1 dollar charge will be added each day.</p>
    </div>
    </div>

<div class="rentalSubmit">
    <button type="submit">Submit Rental</button>
</div>
</form>
</div>



<?php require "php_footer.php"; ?>