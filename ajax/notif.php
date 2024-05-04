<?php
    require("../model/database.php");

    if(isset($_POST["id"])){

        $id = $_POST["id"];
        $sql= "UPDATE notification SET viewed = 1  WHERE id=?";
        $qry = $db->prepare($sql);
        $qry->execute([$id]);

        $sql = "UPDATE notification SET retirer = 1 WHERE id = ?";
        $qry = $db->prepare($sql);
        $qry->execute([$id]);

        echo "Success";
    }

    if(isset($_POST["id_notif_check"])){

        $id = $_POST["id_notif_check"];

        $sql = "UPDATE notification SET viewed = 1 WHERE id = ?";
        $qry = $db->prepare($sql);
        $qry->execute([$id]);

        echo "Success";
    }

    if(isset($_POST["id_notif_not_check"])){

        $id = $_POST["id_notif_not_check"];

        $sql = "UPDATE notification SET viewed = 0 WHERE id = ?";
        $qry = $db->prepare($sql);
        $qry->execute([$id]);

        echo "Success";
    }
?>
