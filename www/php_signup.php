<?php 
require "php_connection.php"; 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = trim($_POST['name']);
    $lastName  = trim($_POST['lname']);
    $email     = trim($_POST['email']);
    $address   = trim($_POST['add']);
    $phone     = trim($_POST['num']);
    $password  = $_POST['password'];
    $confirm   = $_POST['cpassword'];

    if ($lastName === "" || $email === "" || $password === "") {
        $error = "Please fill out all required fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } elseif (strlen($email) > 50) {
        $error = "Email must be 50 characters or fewer.";
    } elseif (strlen($password) < 1) {
        $error = "Password must be at least 1 character.";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match.";
    } else {
        // Is the email already used?
        $stmt = $conn->prepare("SELECT userID FROM User WHERE userEmail = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        if ($stmt->get_result()->fetch_assoc()) {
            $error = "An account with that email already exists.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare(
                "INSERT INTO User (firstName, lastName, userEmail, userPass, userAddress, userPhoneNum)
                 VALUES (?, ?, ?, ?, ?, ?)"
            );
            $stmt->bind_param("ssssss", $firstName, $lastName, $email, $hash, $address, $phone);
            $stmt->execute();

            $_SESSION['flash'] = "Account created! Please log in.";
            header("Location: php_login.php");
            exit;
        }
    }
}
require "php_navbar.php"
?>


    
    <div class="login-parent">
        <div class="login-box">
            <form method="post">
                <div class="SU-Heading">
                    <h1>Welcome to BlockBuster!</h1>
                    <h3>Fill out the following fields to sign up and start browsing:</h3>
                </div>
                    <?php if ($error): ?>
                    <p style="color:red"><?= htmlspecialchars($error) ?></p>
                    <?php endif; ?>

                    <label for="name">First Name:</label>
                    <input type="text" id="name" name="name" placeholder="First Name" maxlength="50"
                            value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required>
                    <br>
                    <label for="lname">Last Name:</label>
                    <input type="text" id="lname" name="lname" placeholder="Last Name" maxlength="50"
                            value="<?= htmlspecialchars($_POST['lname'] ?? '') ?>" required>
                    <br>
                    <label for="email">Email Address:</label>
                    <input type="email" id="email" name="email" placeholder="Email" maxlength="50"
                            value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                    <br>
                    <label for="add">Home Address:</label>
                    <input type="text" id="add" name="add" placeholder="Home Address" maxlength="150"
                            value="<?= htmlspecialchars($_POST['add'] ?? '') ?>" required>
                    <br>
                    <label for="num">Phone Number:</label>
                    <input type="text" id="num" name="num" placeholder="Phone Number" maxlength="30"
                            value="<?= htmlspecialchars($_POST['num'] ?? '') ?>" required>
                    <br>
                    <label for="password">Create a password:</label>
                    <input type="password" id="password" name="password" placeholder="Create Password" required>
                    <br>
                    <label for="cpassword">Confirm password:</label>
                    <input type="password" id="cpassword" name="cpassword" placeholder="Confirm Password" required>
                    <br>
                    <button type="submit" id="signupbutton">Sign-Up!</button>
                    <a href="php_login.php">Log In?</a>
            </form>
        </div>
        
    </div>


<?php require "php_footer.php"; ?>