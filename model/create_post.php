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
    require("../controller/function.php");
    global $db;


        require("../view/form_create_post.html");
        if (!empty($_POST)) {
            if (!empty($_POST["content"])) {
                require("../model/post_info.php");
                
                $content = "";
                
                $content = SecurizeString_ForSQL($_POST["content"]);
                $id_user = $_SESSION["id_user"];
                $date = date("Y-m-d H:i:s");
                $post = new Post($content, $id_user, $date);
                $query = $db->prepare("INSERT INTO post ( id_user,time,content) VALUES (?,?,?)");
                $query->execute([$id_user,$date,$content]);
                echo "<div class=success-box>Post created</div>";
            } else {
                echo "<div class=error-box>Fill all the fields</div>";
            }
        }
   
    ?>
</body>
