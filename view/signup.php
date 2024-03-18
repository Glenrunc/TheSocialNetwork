<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css" />
    <title><Signup</title>
</head>

<body>
    <div class="log-box">
        <h1>Signup</h1>
        <form method="POST" action="signup.php">
            <div class="user-box">
                <input type="text" name="pseudo" required="" placeholder="Pseudo">
            </div>
            <div class="user-box">
                <input type="text" name="first_name" required="" placeholder="First Name">
            </div>
            <div class="user-box">
                <input type="text" name="last_name" required="" placeholder="Last Name">
            </div>
            <div class="user-box">
                <input type="text" name="email" required="" placeholder="Email">
            </div>
            <div class="user-box">
                <input type="date" name="birthday" id="birthday" placeholder="Birthday"> 
            </div>
            <div class="user-box">
                <input type="password" name="password" required="" placeholder="Password">
            </div>
            <div class="user-box">
                <input type="password" name="passwordRepeat" required="" placeholder="Repeat Password">
            </div>
            <input type="submit" id="join-btn" name="join" alt="Join" value="Join">
        </form>
    </div>
    <div id = link-signin><a href="signin.php">Have an account ?</a></div>
    <?php

    require("database.php");
    global $db;

    if (!empty($_POST)) {

        if (!empty($_POST["first_name"]) && !empty($_POST["last_name"]) && !empty($_POST["pseudo"]) && !empty($_POST["email"]) && !empty($_POST["birthday"]) && !empty($_POST["password"]) && !empty($_POST["passwordRepeat"])) {

            $bool = True;
            $bool2 = True;
            $bool3 = True;
            $first_name = $email = $last_name = $birthday = "";
            $first_name = $_POST["first_name"];
            $pseudo = strip_tags($_POST["pseudo"]);
            $last_name = $_POST["last_name"];
            $email = $_POST["email"];
            $birthday = $_POST["birthday"];

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

                echo "<div class=error-box>Type a correct email</div>";
                $bool = False;
            } else {

                $query = $db->prepare("SELECT * FROM user WHERE email=?");
                $query->execute([$email]);
                $bool2 = $query->fetch();

                if ($bool2) {
                    $bool2 = False;
                    echo "<div class=error-box>email already exists</div>";
                } else {
                    $bool2 = True;
                }
            }

            $query = $db->prepare("SELECT * FROM user WHERE pseudo=?");
            $query->execute([$pseudo]);
            $bool3 = $query->fetch();

            if ($bool3) {
                $bool3 = False;
                echo "<div class=error-box>Pseudo already exists</div>";
            } else {
                $bool3 = True;
            }

            if ($_POST["password"] != $_POST["passwordRepeat"]) {
                echo "<div class=error-box>Password doesn't match</div>";
                $bool = False;
            }else{
                $pass = password_hash($_POST["password"], PASSWORD_ARGON2ID);
            }
            
            if (intval(date("Y")) - intval(substr($birthday, 0, 4)) <= 13) {
                echo "<div class=error-box>you must be 13 years old</div>";
                $bool = False;
            }

            if ($bool && $bool2 && $bool3) {
                
                // we insert the user in the database
                // we hash the password
                // we store the user in the session
                // we redirect to the profile page
                
                $sql = "INSERT INTO user(first_name,last_name,birthday,email,password,pseudo) VALUES (?,?,?,?,?,?)";
                $query = $db->prepare($sql);
                $query->execute(array($first_name, $last_name, $birthday, $email,$pass,$pseudo));

                $query = $db->prepare("SELECT * FROM user WHERE email = ?");
                $query->execute([$email]);
                $user = $query->fetch();

                session_start();

                $_SESSION["login"] = ["email" => $user["email"], "pseudo" => $user["pseudo"]];

                header("Location: index.php");
            }
        } else {
            die("You must fill all the fields");
        }
    }
    ?>
</body>

</html>