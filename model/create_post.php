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
    
    global $db;
    if (isset($_SESSION["id_user"])) {
        require("../view/form_create_post.html");
        if (!empty($_POST)) {
            if (!empty($_POST["content"])) {
            
                $content = "";
                
                $content = $_POST["content"];
                $id_user = $_SESSION["id_user"];
                $date = date("Y-m-d H:i:s");
                $query = $db->prepare("INSERT INTO post ( id_user,time,content) VALUES (?,?,?)");
                $query->execute([$id_user,$date,$content]);
                echo "<div class=success-box>Post created</div>";
            } else {
                echo "<div class=error-box>Fill all the fields</div>";
            }
        }
    } 
    ?>
</body>
