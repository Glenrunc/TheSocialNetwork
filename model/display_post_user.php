<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>create Post</title>
 
    </head>
<body>
<?php
    require("database.php");
    require("post_info.php");
    global $db;
  
    $query = $db->prepare("SELECT * FROM post WHERE id_user=? ORDER BY time DESC");
    $query->execute([$_GET["id"]]);
    $data = $query->fetchAll();
    foreach ($data as $post){
        $new_post = New Post($post["id"],$post["content"],$post["id_user"],$post["time"],$_GET["id"]);
        $new_post->displayPost();
    }
    
    ?>
</body>
 