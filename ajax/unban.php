<?php
require("../model/database.php");
global $db;

    if(isset($_POST["id_user"])){

        $sql = "SELECT COUNT(*)FROM ban WHERE id_user = ?";
        $query = $db->prepare($sql);
        $query->execute([$_POST["id_user"]]);
        $result = $query->fetch();

        if($result[0] != 0){
            $sql = "DELETE FROM ban WHERE id_user = ?";
            $query = $db->prepare($sql);
            $query->execute([$_POST["id_user"]]);   

            $sql = "INSERT INTO notification(id_user,id_post,content,viewed,retirer,id_like,warning,id_comment,id_follow,id_like_comment,ban) VALUES(?,NULL,?,0,0,NULL,1,NULL,NULL,NULL,0)";
            $query = $db->prepare($sql);
            $query->execute([$_POST["id_user"],"You have been unbanned but all your posts have been removed"]);

        }

        echo "success";
    }
?>