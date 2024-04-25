<?php
    require("../model/database.php");

    if(isset($_POST["id"]) && isset($_POST["reason"])){

        $id_post = $_POST["id"];

        $sql = "UPDATE post SET retirer = 1 WHERE id = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id_post);
        mysqli_stmt_execute($stmt);
        
        echo"Success";
    }
    if(isset($_POST["id_undelete"])){
        $id_post = $_POST["id_undelete"];

        $sql = "UPDATE post SET retirer = NULL WHERE id = ?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id_post);
        mysqli_stmt_execute($stmt);
            
        echo"Success";
    }
?>