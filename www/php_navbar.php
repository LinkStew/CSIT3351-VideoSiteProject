<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$sessionUserID = isset($_SESSION['userID']);
?>

<!DOCTYPE html>

<html>
<head>
    <title>Block Buster Video</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="blockbuster.css">
</head>


<body style="background-color: #0e3fa9;">

    <div style="background-color: #FFA903">
        <nav class="navbar">

            <div class="nav-center">

                <div class="nav-links">
                    <a href="php_home.php">Home</a>
                    <a href="php_about.php">About</a>
                </div>

                <img src="https://upload.wikimedia.org/wikipedia/commons/4/46/Blockbuster_logo.svg?utm_source=en.wikipedia.org&utm_campaign=index&utm_content=original"
                    alt="Blockbuster Logo">

                <div class="nav-links">
                    <a href="php_genre.php">Genre</a>
                    <a href="php_az.php">A-Z</a>
                </div>  

            </div>

            <div class="account-links">
                <?php if ($sessionUserID): ?>
                    <a href="php_dashboard.php"><?= htmlspecialchars($_SESSION['firstName']) ?></a>
                    <a href="php_logout.php">Logout</a>
                <?php else: ?>
                    <a href="php_login.php">Login</a>
                    <a href="php_signup.php">Sign Up</a>
                <?php endif; ?>
            </div>
        </nav>
    </div>