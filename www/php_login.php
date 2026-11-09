<?php 
require "php_connection.php"; 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT userID, firstName, lastName, userPass, adminID FROM User WHERE userEmail = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if ($user && password_verify($password, $user['userPass'])) {
        session_regenerate_id(true);
        $_SESSION['userID']    = $user['userID'];
        $_SESSION['firstName'] = $user['firstName'];
        $_SESSION['lastName']  = $user['lastName'];
        $_SESSION['email']     = $email;

        header("Location: php_home.php");
        exit;
    }

    $error = "Incorrect email or password.";
}

require "php_navbar.php"
?>


    
    <div class="login-parent">
        <div class="login-box">
            <form method="post">
            
            <?php if (isset($_SESSION['flash'])): ?>
            <p style="color:black"><?= htmlspecialchars($_SESSION['flash']) ?></p>
            <?php unset($_SESSION['flash']); ?>
            <?php endif; ?>

            <?php if ($error): ?>
                <p style="color:red"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your Email"
                    value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your Password" required>

            <button type="submit" id="logbutton">Submit</button>
            <a href="php_signup.php">Create Account?</a>

            </form>

        </div>
        
    </div>



<?php require "php_footer.php"; ?>