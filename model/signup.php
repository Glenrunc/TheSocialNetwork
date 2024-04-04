<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link href="../css/signup.css" rel="stylesheet">
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
                    echo' <script> alert("Type a correct email")</script>';
                    $bool = False;
                } else {

                    $query = $db->prepare("SELECT * FROM user WHERE email=?");
                    $query->execute([$email]);
                    $bool2 = $query->fetch();

                    if ($bool2) {
                        $bool2 = False;
                        echo' <script> alert("email already exists")</script>';

                    } else {
                        $bool2 = True;
                    }
                }

                $query = $db->prepare("SELECT * FROM user WHERE pseudo=?");
                $query->execute([$pseudo]);
                $bool3 = $query->fetch();

                if ($bool3) {
                    $bool3 = False;
                    echo' <script> alert("Pseudo already exists")</script>';
                    
                } else {
                    $bool3 = True;
                }

                if ($_POST["password"] != $_POST["passwordRepeat"]) {
                  
                    $bool = False;
                } else {
                    $pass = password_hash(SecurizeString_ForSQL($_POST["password"]), PASSWORD_ARGON2ID);
                }

                if ($age <= 13) {
                    echo' <script> alert("you must be 13 years old")</script>';
                    $bool = False;
                }
                if ($bool && $bool2 && $bool3) {
                    __sendDataUser($first_name,$last_name,$age,$birthday,$email,$pass,$pseudo,$db);
                    $_SESSION["id_user"] = $db->lastInsertId();

                    $query = $db->prepare("SELECT * FROM user WHERE id = ?");
                    $query->execute([$_SESSION["id_user"]]);
                    $user = $query->fetch();

                    $_SESSION["pseudo"] = $user["pseudo"];
                    $_SESSION["email"] = $user["email"];

                    if($_FILES["profile_picture"]["size"] != 0 ){
                        
                        $sql = "UPDATE user SET profil_picture = ? WHERE email=?";
                        $qry = $db->prepare($sql);
                        $qry->execute([file_get_contents($_FILES["profile_picture"]["tmp_name"]), $email]);
                        $_SESSION['profile_picture'] = file_get_contents($_FILES["profile_picture"]["tmp_name"]);
                    }
                    header("Location: ../view/user.php?id=".$_SESSION["id_user"]);
                }
            } else {
                die("You must fill all the fields");
            }
        }
    }
    ?>
</body>

</html>