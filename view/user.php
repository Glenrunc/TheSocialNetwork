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
    echo "<script src='../script/add_like.js'></script>";
    echo "<script src='../script/add_dislike.js'></script>";
    echo "<script src='../script/add_admin.js'></script>";
    echo "<script src='../script/add_blur.js'></script>";

    global $db;

    ?>
    <div id="wrap">
    <div id="searchresult"></div>
    </div>
    <?php

    if (isset($_GET["id"])) {
        //On regarde si l'utilisateur existe
        $sql = "SELECT * FROM user WHERE id = ?";
        $query = $db->prepare($sql);
        $query->execute([$_GET["id"]]);
        $data = $query->fetch();

        if ($data) {
            $user = new User($data["id"], $data["first_name"], $data["last_name"], $data["age"], $data["birthday"], $data["email"], $data["pseudo"], $data["admin"], $data["profile_picture"]);
            $user->displayUserPage();
            if (isset($_SESSION["id_user"])) {
                //Si l'utilisateur est connecté et que c'est son profil
                if ($_SESSION["id_user"] != $_GET["id"]) {
                    //Si l'utilisateur est connecté et que ce n'est pas son profil
                    //bouton follow
                    require("../model/follow.php");
                    $query_check_follow = $db->prepare("SELECT * FROM follow WHERE id_user = ? AND id_follow = ?");
                    $query_check_follow->execute([$_SESSION["id_user"], $_GET["id"]]);
                    $data = $query_check_follow->fetch();
                    if($data){
                        require("../view/form_unfollow.php");
                    }else{
                        require("../view/form_follow.php");
                    }
                    echo'<div id="postbox">';
                            
                }else{
                  
                    $sql = "SELECT admin FROM user WHERE id = ?";
                    $qry = $db->prepare($sql);
                    $qry->execute([$_SESSION["id_user"]]);
                    $data = $qry->fetch();
                    if ($data["admin"] == 1) {
                        echo '<div><a href="../model/undelete_page.php">Post deleted</a></div>';
                        echo '<div><a href="../model/unblur_page.php">Post Blured</a></div>';
                        echo '<div><a href="../model/user_gestion.php">User Banned</a></div>';
                    }
                    echo '<div><a href="../model/user_gestion.php?id=' . $_SESSION["id_user"] . '">Edit</a></div>';
                    echo'<div id="postbox">';
                    ?><div id="creation_post">
                        <p id = "create">Creation post</p>
                        <?php require("../view/form_create_post.html"); ?>
                    </div>
                    <?php 
                }
            }else{
                echo'<div id="postbox">';

            }              
            //Afficher les posts de l'utilisateur
            
  
            $query = $db->prepare("SELECT * FROM post WHERE id_user=? ORDER BY time DESC");
            $query->execute([$_GET["id"]]);
            $data = $query->fetchAll();
            
            foreach($data as $post) {
                if($post['retirer'] != 1){
                    $post_obj = new Post($post["id"],$post["content"], $post["id_user"], $post["time"],$post["flou"],$post["retirer"],$post["image"]);
                    $post_obj->displayPost();
                }
                ?>

            <?php
            }
            
            echo "</div>";
        } else {
            header("Location: ../view/user.php?id=" . $_SESSION['id_user']);
        }
    } else {

        header("Location: ../view/user.php?id=" . $_SESSION['id_user']);
    }

    ?>


    

</body>

</html>