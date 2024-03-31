<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/user_page.css" rel="stylesheet">
    <title>TZU</title>

</head>

<body>


    <?php
    require("../controller/function.php");
    require("../model/database.php");
    require("../model/user_info.php");
    session_start();
    global $db;

    if(isset($_GET["id"])){
        $sql = "SELECT * FROM user WHERE id = ?";
        $query = $db->prepare($sql);
        $query->execute([$_GET["id"]]);
        $data = $query->fetch();
        if($data){
            $user = new User($data["id"],$data["first_name"],$data["last_name"],$data["age"],$data["birthday"],$data["email"],$data["pseudo"],$data["admin"],$data["profil_picture"]);
            $user->displayUserPage();
            //afficher follower number
            //bouton follow
            //afficher post
            if(isset($_SESSION["id_user"])){
                if($_SESSION["id_user"] == $data["id"]){
                    echo'<div><a href="../model/user_gestion.php">Edit</a></div>';
                    //afficher création de post 
                }
            }
        }else{
            echo'<div><p>user not found</p></div>';
        }
        
    }else{
        echo'<div><p>unauthorized</p></div>';
    }




    ?>

</body>

</html>