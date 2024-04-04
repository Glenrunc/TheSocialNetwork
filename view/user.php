<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/user_page.css" rel="stylesheet">
    <title>TZU</title>

</head>

<body>


    <?php
    require("../controller/function.php");
    require("../model/database.php");
    require("../model/user_info.php");
    session_start();
    global $db;

    if(isset($_GET["id"])){
        $sql = "SELECT * FROM user WHERE id = ?";
        $query = $db->prepare($sql);
        $query->execute([$_GET["id"]]);
        $data = $query->fetch();
        if($data){
            $user = new User($data["id"],$data["first_name"],$data["last_name"],$data["age"],$data["birthday"],$data["email"],$data["pseudo"],$data["admin"],$data["profil_picture"]);
            $user->displayUserPage();
            //afficher follower number
            //bouton follow
            //afficher post
            if(isset($_SESSION["id_user"])){
                if($_SESSION["id_user"] == $data["id"]){
                    echo'<div><a href="../model/user_gestion.php">Edit</a></div>';
                    //afficher création de post 
                }
            }
        }else{
            echo'<div><p>user not found</p></div>';
        }
        
    }else{
        echo'<div><p>unauthorized</p></div>';
    }

    ?>


<?php
    echo "ID provenant de GET : " . $_GET['id'] . "<br>";
    echo "ID de session utilisateur : " . $_SESSION['id_user'] . "<br>";

if(isset($_SESSION['id_user']) && isset($_GET['id']) && $_SESSION['id_user'] == $_GET['id']) {
    ?>

    <div id="title"><h1>Profil page</h1></div>
    <div id= "creation_post"><?php require("../model/create_post.php");?></div>
    <div id="display_post">
    <?php
    require("../model/post_info.php");
    $query = $db->prepare("SELECT * FROM post WHERE id_user=? ORDER BY time DESC");
    $query->execute([$_GET["id"]]);
    $data = $query->fetchAll();
    $list_post = array();
    foreach ($data as $post){
        $new_post = New Post($post["content"],$post["id_user"],$post["time"],$post["id"]);
        array_push($list_post,$new_post);
    }
    foreach ($list_post as $post){
        $post->displayPost();
    } 
    ?>
    </div>
    <?php
}
?>

<form method="post">
    <input type="submit" name="follow" value="Follow">
</form>
<?php

    if(isset($_SESSION['user_id'])) {
    $id_user = $_SESSION['user_id']; // ID de l'utilisateur actuellement connecté
    echo "ID de l'utilisateur actuellement connecté : " . $id_user . "<br>";
    if(isset($_GET['id'])) {
        $id_follow = $_GET['id']; // ID de l'utilisateur que l'on veut suivre
        echo "ID de l'utilisateur que l'on veut suivre : " . $id_follow . "<br>";
    }

    if(isset($_POST['follow'])) {

        $query = $db->prepare("INSERT INTO follow (id_user,id_follow) VALUES (?, ?)");
        $query->execute([$id_user, $id_follow]);

        echo "Vous suivez maintenant l'utilisateur.";
    }
}
?>



</body>

</html>