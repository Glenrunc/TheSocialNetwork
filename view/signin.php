<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
</head>
<body>
<div class="login-box">
        <h2>Login</h2>
        <form method="POST" action="signin.php">
            <div class="user-box">
                <input type="text" name="email" required="">
                <label>E-mail</label>
            </div>
            <div class="user-box">
                <input type="password" name="password" required="">
                <label>Password</label>
            </div>
            <input type="submit" id="join-btn" name="join" alt="Join" value="Join">

        </form>
</div>
<?php
    include 'db_connect.php';
    global $db;

    if (!empty($_POST)) {

        if (!empty($_POST["password"]) && !empty($_POST["email"])) {
            $pass = $_POST["password"];
            $email = $_POST["email"];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo ("l'adress n'est pas bonne ");
            }


            $query = $db->prepare("SELECT * FROM logins WHERE email = ?");
            $query->execute([$email]);
            $user = $query->fetch();
            if (!$user) {
                echo "test";
                echo ("user or password incorrect");
            } else {

                if (!password_verify($pass, $user["password"])) {
                    echo "hey";
                    echo ("user or password incorrect");
                } else {

                    // les verfications sont passées 
                    // on connecte l'utilisateur
                    // demarrage d'une session php


                    session_start();
                    //stockage des données de l'utilisateur

                    $_SESSION["logins"] = ["email" => $user["email"], "username" => $user["username"], "idlogins" => $user['idlogins'],"adminstate" => $user['adminstate']];

                    // on redirige vers une page profil
                    header("Location: index.php");
                }
            }
        } else {
            echo ("le formulaire n'est pas complet");
        }
    }

    ?>
</body>
</html>