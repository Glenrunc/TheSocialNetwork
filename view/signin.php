<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signin</title>
</head>
<body>
<div class="login-box">
        <h2>Signin</h2>
        <form method="POST" action="signin.php">
            <div class="user-box">
                <input type="text" name="email" required="" placeholder="Email">
            </div>
            <div class="user-box">
                <input type="password" name="password" required="" placeholder="Password">
            </div>
            <input type="submit" id="join-btn" name="join" alt="Join" value="Join">
        </form>
</div>
<div id = link-login><a href="signup.php">Not register?</a></div>

<?php
    require("database.php");
    global $db;

    if (!empty($_POST)) {

        if (!empty($_POST["password"]) && !empty($_POST["email"])) {
            $password = $_POST["password"];
            $email = $_POST["email"];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<div class=box-error>Type a valid email</div>";
            }


            $query = $db->prepare("SELECT * FROM user WHERE email = ?");
            $query->execute([$email]);
            $user = $query->fetch();
            if (!$user) {
                echo "<div class=box-error>email doesn't exist</div>";
            } else {
                if (!password_verify($password, $user["password"])) {
                    echo "<div class=box-error>password doesn't match</div>";
                } else {

                    session_start();

                    $_SESSION["signin"] = ["email" => $user["email"], "pseudo" => $user["pseudo"]];

                    header("Location: index.php");
                }
            }
        } else {
            echo"<div class=box-error>Fill all the fields</div>";
        }
    }

    ?>
</body>
</html>