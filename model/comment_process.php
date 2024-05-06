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
    $sql = "SELECT id_user FROM post WHERE id = ?";
    $query = $db->prepare($sql);
    $query->execute([$id_post]);
    $data = $query->fetch();

    if($_SESSION["id_user"] != $data["id_user"]){
        $sql = "INSERT INTO notification(id_user,id_post,content,viewed,retirer,warning,id_comment) VALUES (?,?,?,0,0,0,?)";
        $query = $db->prepare($sql);
        $query->execute([$data["id_user"],$id_post,"add a comment on your",$lastInsertId]);
    }

    header("Location: ../view/post.php?id_post=".$id_post);
}else{
    echo "error";
}
?>