<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="../css/user_page.css" rel="stylesheet">
    <link href="../css/style_popup.css" rel="stylesheet">


    <title>TZU</title>

</head>

<body>


    <?php
    require("../model/user_info.php");
    require("../model/database.php");
    session_start();
    require("../view/navbar.php");
    require("../view/popup_signin.php");
    global $db;

    ?>
    <?php

    if (isset($_GET["id"])) {
        $sql = "SELECT * FROM user WHERE id = ?";
        $query = $db->prepare($sql);
        $query->execute([$_GET["id"]]);
        $data = $query->fetch();
        if ($data) {
            $user = new User($data["id"], $data["first_name"], $data["last_name"], $data["age"], $data["birthday"], $data["email"], $data["pseudo"], $data["admin"], $data["profile_picture"]);
            $user->displayUserPage();
            //afficher follower number
            //bouton follow
            //afficher post
            if (isset($_SESSION["id_user"])) {
                if ($_SESSION["id_user"] == $data["id"]) {
                    echo '<div><a href="../model/user_gestion.php?id='.$_SESSION["id_user"].'">Edit</a></div>';
                    //afficher création de post 
                }
            }
        } else {
            echo '<div><p>user not found</p></div>';
        }
    } else {
        echo '<div><p>unauthorized</p></div>';
    }

    ?>


    <?php

    // echo "ID provenant de GET : " . $_GET['id'] . "<br>";
    // echo "ID de session utilisateur : " . $_SESSION['id_user'] . "<br>";

    if (isset($_SESSION['id_user']) && isset($_GET['id'])) {
        if ($_SESSION['id_user'] == $_GET['id']) {
    ?>

            <div id="creation_post"><?php require("../model/create_post.php"); ?></div>
            <div id="display_post">

                <?php
            } ?>
            </div>
        <?php
    }
        ?>

       <!-- follow gestion code -->
        <?php

        // echo "ID de l'utilisateur actuellement connecté : ".$_SESSION['id_user']. "<br>";
        if (isset($_SESSION['id_user'])) {
            $id_user = $_SESSION['id_user']; // ID de l'utilisateur actuellement connecté
            // echo "ID de l'utilisateur actuellement connecté : " . $id_user . "<br>";
            if (isset($_GET['id'])) {
                $id_follow = $_GET['id']; // ID de l'utilisateur que l'on veut suivre
                // echo "ID de l'utilisateur que l'on veut suivre : " . $id_follow . "<br>";
            }
 
            if ($id_follow == $id_user) {
                $query = $db->prepare("SELECT * FROM post WHERE id_user=? ORDER BY time DESC");
                $query->execute([$_GET["id"]]);
                $data = $query->fetchAll();
                _displayPost($data);
            }
            // ON VISITE LA PAGE D'UN AUTRE UTILISATEUR
            else { 
                $query_check_follow = $db->prepare("SELECT * FROM follow WHERE id_user = ? AND id_follow = ?");
                $query_check_follow->execute([$id_user, $id_follow]);
                $data = $query_check_follow->fetch();
                // ON CHECK SI ON LE FOLLOW OU PAS SI OUI ON AFFICHE SES POSTS
                if ($data) {          
                    $query = $db->prepare("SELECT * FROM post WHERE id_user=? ORDER BY time DESC");
                    $query->execute([$_GET["id"]]);
                    $data = $query->fetchAll();
                    _displayPost($data);
                    ?>
                    <form method="post">
                        <input type="submit" name="unfollow" value="Unfollow">
                    </form>
                    <?php
            }
            // SINON ON AFFICHE UN BOUTON POUR LE FOLLOW
            else {
                
                ?>
                <form method="post">
                    <input type="submit" name="follow" value="Follow">
                </form>
                <p> ne suivez pas encore cet utilisateur. Suivez-le pour voir ses publications.</p>
                <?php
                
            }  ?>
            <?php
           
   
            if (isset($_POST['follow'])) {
                // Vérifier si le suivi n'est pas déjà actif
                $query_check_follow = $db->prepare("SELECT COUNT(*) FROM follow WHERE id_user = ? AND id_follow = ?");
                $query_check_follow->execute([$id_user, $id_follow]);
                $count_follow = $query_check_follow->fetchColumn();

                if ($count_follow > 0) {
                    // L'utilisateur suit déjà l'autre utilisateur
                    echo "Vous suivez déjà cet utilisateur.";
                
                

            
                } else {
                    // Le suivi n'est pas déjà actif, donc on l'insère
                    $query_insert_follow = $db->prepare("INSERT INTO follow (id_user, id_follow) VALUES (?, ?)");
                    $query_insert_follow->execute([$id_user, $id_follow]);

                    header("Location: {$_SERVER['REQUEST_URI']}");
                    exit();
                }
            }
            if (isset($_POST['unfollow'])) {
                // Vérifier si le suivi est actif
                $query_check_follow = $db->prepare("SELECT COUNT(*) FROM follow WHERE id_user = ? AND id_follow = ?");
                $query_check_follow->execute([$id_user, $id_follow]);
                $count_follow = $query_check_follow->fetchColumn();

                if ($count_follow > 0) {
                    // L'utilisateur suit déjà l'autre utilisateur
                    $query_delete_follow = $db->prepare("DELETE FROM follow WHERE id_user = ? AND id_follow = ?");
                    $query_delete_follow->execute([$id_user, $id_follow]);

                    header("Location: {$_SERVER['REQUEST_URI']}");
                    exit();

                } 
            }
        }
        ?>
        <?php     
}
        ?>

</body>

</html>