<?php
require("../model/database.php");
global $db;
if(isset($_POST["id_user"]) && isset($_POST["reason"])){

    $id_user = $_POST["id_user"];
    $reason = $_POST["reason"];
    $sql = "INSERT INTO notification(id_user,content,viewed,retirer,id_like,warning,id_comment,id_follow,id_like_comment) VALUES(?,?,0,0,NULL,1,NULL,NULL,NULL)";
    $query = $db->prepare($sql);
    $query->execute([$id_user,$reason]);
    echo "Success";
}
?>