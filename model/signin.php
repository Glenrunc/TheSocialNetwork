<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <title>Signin</title>
</head>

<body>
    <!-- <?php session_start();?>; -->
    <?php
    require("../controller/function.php");
    global $db;

    if (isset($_SESSION["id_user"])) {
        echo "<p>Unauthorized</p>";
    } else {
        require("../view/form_signin.html");
        if (!empty($_POST)) {

            if (!empty($_POST["password"]) && !empty($_POST["email"])) {
                $password = SecurizeString_ForSQL($_POST["password"]);
                $email = SecurizeString_ForSQL($_POST["email"]);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo "<script> alert('Type a valid email')</script>";
                }


                $query = $db->prepare("SELECT * FROM user WHERE email = ?");
                $query->execute([$email]);
                $user = $query->fetch();
                if (!$user) {
                    echo "<script>alert('email doesnt exist')</script>";
                } else {
                    if (!password_verify($password, $user["password"])) {
                        echo "<script>alert('password doesnt match')</script>";
                    } else {

                        $_SESSION["id_user"] = $user["id"];
                        $_SESSION["pseudo"] = $user["pseudo"];
                        header("Location: ../view/user.php");
                    }
                }
            } else {
                echo "<script>Fill all the fields</script>";
            }
        }
    }
    ?>
</body>

</html>