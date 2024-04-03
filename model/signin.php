<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/signin.css" rel="stylesheet">

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
                        $_SESSION["email"] = $user["email"];
                        $_SESSION["pseudo"] = $user["pseudo"];
                        $_SESSION["profile_picture"]= $user["profil_picture"];
                        header("Location: ../view/user.php?id=".$_SESSION["id_user"]);
                    }
                }
            } else {
                echo "<script>Fill all the fields</script>";
            }
        }
    }
    ?>
<script>
    // Récupère tous les éléments d'entrée avec la classe "input"
    var inputs = document.querySelectorAll('.input');

    // Ajoute un écouteur d'événement pour chaque élément d'entrée
    inputs.forEach(function(input) {
        // Lorsque l'utilisateur clique sur l'élément d'entrée
        input.addEventListener('focus', function() {
            // Efface le placeholder
            this.setAttribute('placeholder', '');
        });

        // Lorsque l'utilisateur quitte l'élément d'entrée
        input.addEventListener('blur', function() {
            // Restaure le placeholder s'il n'y a pas de valeur dans le champ
            if (!this.value.trim()) {
                this.setAttribute('placeholder', this.getAttribute('data-placeholder'));
            }
        });

        // Enregistre le placeholder d'origine dans un attribut de données
        input.setAttribute('data-placeholder', input.getAttribute('placeholder'));
    });
</script>    
</body>

</html>