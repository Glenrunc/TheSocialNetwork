<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
</head>

<body>

    <?php
    require("database.php");
    require("../controller/function.php");
    global $db;
    session_start();
    if (isset($_SESSION["id_user"])) {
        echo "unauthorized";
    } else {
        require("../view/form_signup.html");

        if (!empty($_POST)) {

            if (!empty($_POST["first_name"]) && !empty($_POST["last_name"]) && !empty($_POST["pseudo"]) && !empty($_POST["email"]) && !empty($_POST["birthday"]) && !empty($_POST["password"]) && !empty($_POST["passwordRepeat"])) {

                $bool = True;
                $bool2 = True;
                $bool3 = True;
                $first_name = $email = $last_name = $birthday = "";
                $first_name = SecurizeString_ForSQL($_POST["first_name"]);
                $pseudo = SecurizeString_ForSQL(($_POST["pseudo"]));
                $last_name = SecurizeString_ForSQL($_POST["last_name"]);
                $email = SecurizeString_ForSQL($_POST["email"]);
                $birthday = SecurizeString_ForSQL($_POST["birthday"]);
                $age = intval(date("Y")) - intval(substr($birthday, 0, 4));

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
                } else {
                    $pass = password_hash($_POST["password"], PASSWORD_ARGON2ID);
                }

                if ($age <= 13) {
                    echo "<div class=error-box>you must be 13 years old</div>";
                    $bool = False;
                }
                // echo"$bool , $bool2, $bool3";
                if ($bool && $bool2 && $bool3) {
                    __sendDataUser($first_name,$last_name,$age,$birthday,$email,$pass,$pseudo,$db);
                    $_SESSION["id_user"] = $db->lastInsertId();

                    $query = $db->prepare("SELECT * FROM user WHERE id = ?");
                    $query->execute([$_SESSION["id_user"]]);
                    $user = $query->fetch();

                    $_SESSION["pseudo"] = $user["pseudo"];

                    if($_FILES["profile_picture"]["size"] != 0 ){
                        
                        echo"edzedz";
                        $sql = "UPDATE user SET profil_picture = ? WHERE email=?";
                        $qry = $db->prepare($sql);
                        $qry->execute([file_get_contents($_FILES["profile_picture"]["tmp_name"]), $email]);
                        $_SESSION['profile_picture'] = file_get_contents($_FILES["profile_picture"]["tmp_name"]);
                    }

                    // mail($email,"Signin on social network","Hi".$pseudo."welcome on board");
                    header("Location: ../view/user.php");
                }
            } else {
                die("You must fill all the fields");
            }
        }
    }
    ?>
</body>

</html>