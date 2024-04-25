<?php
    require("../model/database.php");

    if(isset($_POST["id"]) && isset($_POST["action"]) && isset($_POST["reason"]) && isset($_POST["id_user"])){
       
        $action = $_POST["action"];
        $viewed = 0;
        if($action === "Sensitive Content / Blur the post"){
            $sql = "UPDATE post SET flou = 1 WHERE id = ?";
            $stmt = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($stmt, "i", $_POST["id"]);
            mysqli_stmt_execute($stmt);
            
            $sql = "INSERT INTO notification (id_user, id_post,content,viewed) VALUES (?, ?, ?,?)";
            $stmt = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($stmt, "iisi", $_POST["id_user"], $_POST["id"], $_POST["reason"], $viewed);
            mysqli_stmt_execute($stmt);

            echo"Success";
        }
    }

    if(isset($_POST["id_unblur"])){
        $id_post = $_POST["id_unblur"];

        $sql = "UPDATE post SET flou = NULL WHERE id = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id_post);
        mysqli_stmt_execute($stmt);
            
        echo"Success";
    }
?>