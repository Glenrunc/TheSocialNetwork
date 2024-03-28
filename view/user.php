<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TZU</title>

</head>

<body>
    <?php
    require("../controller/function.php");
    require("../model/database.php");
    require("../model/user_info.php");
    global $db;
    if (isset($_GET["id"]) && !isset($_SESSION["id_user"])) {

        $id_user = $_GET["id"];
        $sql = "SELECT MAX(id) as id FROM user";
        $qry = $db->prepare($sql);
        $qry->execute();
        $data = $qry->fetch();
        // echo'<script> console.log('.$data["id"].')</script>';
        if($data["id"] >= $id_user){
            $sql = "SELECT id,first_name,last_name,age,birthday,email,pseudo,admin,profil_picture FROM user WHERE id=?";
            $qryUser = $db->prepare($sql);
            $qryUser->execute([$_GET["id"]]);
            $dataUser = $qryUser->fetch();

            if($dataUser !== false){
                $user = new User($dataUser["id"], $dataUser["first_name"], $dataUser["last_name"], $dataUser["age"], $dataUser["birthday"], $dataUser["email"], $dataUser["pseudo"], $dataUser["admin"], $dataUser["profil_picture"]);
                $user->displayUserPage();
            }else{
                echo"<div class='unauthorized'><p>This page doesn't exist</p></div>";

            }

            // $user = new User($dataUser["id"], $dataUser["first_name"], $dataUser["last_name"], $dataUser["age"], $dataUser["birthday"], $dataUser["email"], $dataUser["pseudo"], $dataUser["admin"], $dataUser["profil_picture"]);
            // $user->displayUserPage();
        }else{
            echo"<div class='unauthorized'><p>This page doesn't exist</p></div>";
        }
    }




    ?>
</body>

</html>