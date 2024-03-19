<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <title>Signin</title>
</head>

<body>
    <?php
    require("database.php");
    require("../controller/function.php");
    global $db;

    require("../view/form_signin.php");
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
                    $_SESSION["id_user"] = $user["id"];
                    header("Location: ../view/index.php");
                }
            }
        } else {
            echo "<div class=box-error>Fill all the fields</div>";
        }
    }

    ?>
</body>

</html>