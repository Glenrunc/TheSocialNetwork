<?php
    require("../model/database.php");
    global $db;

    if(isset($_POST["number_of_day_ban"]) && isset($_POST["id_user_ban"])){
        $number_of_day_ban = $_POST["number_of_day_ban"];
        $id_user_ban = $_POST["id_user_ban"];

        if($number_of_day_ban > 0){
            $sql= "INSERT INTO ban(id_user, date_end) VALUES(?, DATE_ADD(NOW(), INTERVAL ? DAY))";
            $query = $db->prepare($sql);
            $query->execute([$id_user_ban,$number_of_day_ban]);

            $sql = "INSERT INTO notification(id_user, content,retirer, ban) VALUES(?,?,0,?)";
            $query = $db->prepare($sql);

            if($_POST["reason_ban"] == ""){
                $query->execute([$id_user_ban,"You have been banned for $number_of_day_ban days",1]);
            }else{
                $query->execute([$id_user_ban,"You have been banned for $number_of_day_ban days for the following reason : ".$_POST["reason_ban"],1]);
            }

            $sql = "SELECT id FROM post WHERE id_user = ?";
            $query = $db->prepare($sql);
            $query->execute([$id_user_ban]);
            $data = $query->fetchAll();

            foreach($data as $post){
                $sql = "UPDATE post SET retirer = 1 WHERE id = ?";
                $query = $db->prepare($sql);
                $query->execute([$post["id"]]);
            }

        }

        header("Location: ../view/user.php?id=$id_user_ban");

    }
?>