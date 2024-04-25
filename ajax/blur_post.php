<?php
    require("../model/database.php");

    if(isset($_POST["id"]) && isset($_POST["action"]) && isset($_POST["reason"])){
        $id_post = $_POST["id"];
        $action = $_POST["action"];

        if($action === "Sensitive Content / Blur the post"){
            $sql = "UPDATE post SET flou = 1 WHERE id = ?";
            $stmt = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($stmt, "i", $id_post);
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