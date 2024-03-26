<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/user_gestion.css" rel="stylesheet">

</head>

<body>
    <?php
    require("../model/user_info.php");
    require("../model/database.php");
    require("../controller/function.php");
    session_start();
    global $db;

    if (isset($_SESSION["id_user"])) {

        $id_user = $_SESSION["id_user"];
        $sql = "SELECT id,first_name,last_name,age,birthday,email,pseudo,admin,profil_picture FROM user WHERE id=?";
        $qry = $db->prepare($sql);
        $qry->execute([$id_user]);
        $data = $qry->fetch();
        $user = new User($data["id"], $data["first_name"], $data["last_name"], $data["age"], $data["birthday"], $data["email"], $data["pseudo"], $data["admin"], $data["profil_picture"]);

        $user->displayGestionPage();
    ?>
        <div id="button">
            <button class="submit" onclick="checkAndRedirect()">Update</button>
        </div>
        <div id="overlay"></div>
        <div id="rectangle">
            <?php require("../view/update_user_form.php") ?>

            <?php
            if (!empty($_POST)) {
                if (isset($_POST["email"])) {
                    $new_email = SecurizeString_ForSQL($_POST["email"]);
                    $sql = "SELECT id FROM user WHERE email = ?";
                    $qry = $db->prepare($sql);
                    $qry->execute([$new_email]);
                    $data = $qry->fetch();

                    if ($data["id"] != $_SESSION["id_user"] && $data["id"] == false) {

                        $sql = "UPDATE user SET email=? WHERE id = ?";
                        $qry = $db->prepare($sql);
                        $qry->execute([$new_email, $_SESSION["id_user"]]);
                    }

                    if ($data["id"] != false && $data["id"] != $_SESSION["id_user"]) {
                        echo '<script>alert("This email is already taken by other user")</script>';
                    }
                }

                if (isset($_POST["pseudo"])) {
                    $new_pseudo = SecurizeString_ForSQL($_POST["pseudo"]);
                    $sql = "SELECT id FROM user WHERE pseudo = ?";
                    $qry = $db->prepare($sql);
                    $qry->execute([$new_pseudo]);
                    $data = $qry->fetch();

                    if ($data["id"] != $_SESSION["id_user"] && $data["id"] == false) {
                        $sql = "UPDATE user SET pseudo=? WHERE id = ?";
                        $qry = $db->prepare($sql);
                        $qry->execute([$new_pseudo, $_SESSION["id_user"]]);
                    }
                    if ($data["id"] != false && $data["id"] != $_SESSION["id_user"]) {
                        echo '<script>alert("This pseudo is already taken by other user")</script>';
                    }
                }

                if (isset($_POST["password"])) {

                    if (isset($_POST["passwordRepeat"]) && ($_POST["password"] == $_POST["passwordRepeat"])) {
                        $new_password = password_hash(SecurizeString_ForSQL($_POST["password"]), PASSWORD_ARGON2ID);
                        $sql = "UPDATE user SET password = ? WHERE id = ?";
                        $qry = $db->prepare($sql);
                        $qry->execute([$new_password, $_SESSION["id_user"]]);
                    }

                    if (!isset($_POST["passwordRepeat"])) {
                        echo '<script>alert("You must enter your password twice")</script>';
                    }
                    if ($_POST["password"] != $_POST["passwordRepeat"]) {
                        echo '<script>alert("Password not match")</script>';
                    }
                }

                if ($_FILES["profile_picture"]["size"] != 0) {

                    $sql = "UPDATE user SET profil_picture = ? WHERE id=?";
                    $qry = $db->prepare($sql);
                    $qry->execute([file_get_contents($_FILES["profile_picture"]["tmp_name"]), $_SESSION["id_user"]]);
                    $_SESSION['profile_picture'] = file_get_contents($_FILES["profile_picture"]["tmp_name"]);
                }
                echo '<script>window.location.href = "../model/user_gestion.php";</script>';
            }
            ?>

        </div>

        <div id="flou-body"></div>


    <?php

    } else {
        echo "unauthorized";
    }
    ?>
    <script src="../view/script.js"></script>


</body>