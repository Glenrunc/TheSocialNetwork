<?php 
     try {
      $db = new PDO("mysql:host=localhost;dbname=socialnetwork", "root", "");
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
      exit(); 
    }

    $con = mysqli_connect("localhost", "root", "", "socialnetwork");

    if(!$con){
      echo "Connection failed" . mysqli_connect_error();
    }
?>