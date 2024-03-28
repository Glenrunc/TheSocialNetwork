
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/user.css" rel="stylesheet">
</head>

<body>
    <div id="title"><h1>Profil page</h1></div>
    <div id= "creation_post"><?php require("../model/create_post.php");?></div>
    <?php
    require("../model/user_info.php");
    require("../model/database.php");
    session_start();
    global $db;
    ?>
    
    <div id="post-container">
        <?php
        require("../model/post_info.php");
        $sql = "SELECT id_user,time,content FROM post WHERE id_user=?";
        $qry = $db->prepare($sql);
        $qry->execute([$user->getIdUser()]);
        $data = $qry->fetchAll();
        foreach ($data as $post) {
            $post = new Post($post["content"], $post["id_user"], $post["time"]);
            $post->displayPost();
        }
        ?>
    </div>
<?php 
echo"<a href=index.php>kerfervfer</a>"
?>
<a href="../model/create_post.php">Create a post</a>

</body>


