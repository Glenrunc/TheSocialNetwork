<?php
require("../model/database.php");
session_start();

if(isset($_POST["message"])&& isset($_POST["id_post"])){
    $id_post = $_POST["id_post"];
    $message = $_POST["message"];
    
    $sql = "INSERT INTO comment(id_post,id_user,content) VALUES (?,?,?)";
    $query = $db->prepare($sql);
    $query->execute([$id_post,$_SESSION["id_user"],$message]);
    $lastInsertId = $db->lastInsertId();

    if($_FILES["image"]["size"] != 0){
        $path ="../image/comment_photo/";
        $extention = pathinfo($_FILES["image"]["name"],PATHINFO_EXTENSION);
        move_uploaded_file($_FILES["image"]["tmp_name"],$path.$lastInsertId.".".$extention);

        $query = $db->prepare("UPDATE comment SET image = ? WHERE id = ?");
        $query->execute([$lastInsertId.".".$extention,$lastInsertId]);
    }

    header("Location: ../view/post.php?id_post=".$id_post);
}else{
    echo "error";
}
?>