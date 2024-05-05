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
    echo "<script src='../script/add_blur.js'></script>";
    echo "<script src='../script/add_delete_admin.js'></script>";
    echo "<script src='../script/add_blur_admin.js'></script>";

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
                    if ($data) {
                        require("../view/form_unfollow.php");
                    } else {
                        require("../view/form_follow.php");
                    }
                    echo "</div>";
                    echo '<div id="postbox">';
                } else {

                    $sql = "SELECT admin FROM user WHERE id = ?";
                    $qry = $db->prepare($sql);
                    $qry->execute([$_SESSION["id_user"]]);
                    $data = $qry->fetch();
                    echo '<div class="link">';
                    if ($data["admin"] == 1) {
                        ?>
                        <div class="dropdown">
                        <svg class=" dropdown-toggle"  data-bs-toggle="dropdown" aria-expanded="false" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#0D6EFD" class="bi bi-gear-fill" viewBox="0 0 16 16">
                        <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                        </svg>
                        
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="../model/undelete_page.php">Post deleted</a></li>
                          <li><a class="dropdown-item" href="../model/unblur_page.php">Post Blured</a></li>
                          <li><a class="dropdown-item" href="../model/user_gestion.php">User Banned</a></li>
                        </ul>
                        </div>
                        <?php
                    }
                    echo '<div><a href="../model/user_gestion.php?id=' . $_SESSION["id_user"] . '">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-gear" viewBox="0 0 16 16">
                    <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m.256 7a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1zm3.63-4.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382zM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0"/>
                    </svg>
                    </a></div>';
                    require("../view/follow_modal.php");
                    echo '</div>';
                    echo '<div id="postbox">';
                ?>  
                   <div id="creation_post">
                        <p id="create">Creation post</p>
                        <?php require("../view/form_create_post.html"); ?>
                    </div>
                <?php
                }
            } else {
                echo "</div>";
                echo '<div id="postbox">';
            }
            //Afficher les posts de l'utilisateur


            $query = $db->prepare("SELECT * FROM post WHERE id_user=? ORDER BY time DESC");
            $query->execute([$_GET["id"]]);
            $data = $query->fetchAll();

            foreach ($data as $post) {
                if ($post['retirer'] != 1) {
                    $post_obj = new Post($post["id"], $post["content"], $post["id_user"], $post["time"], $post["flou"], $post["retirer"], $post["image"]);
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