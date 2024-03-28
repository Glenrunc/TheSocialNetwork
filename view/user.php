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

    if (!isset($_SESSION["id_user"])) {
        if(isset($_GET["id"])){
            //on affiche le nombre de follower de following  plus page avec les post car la personne n'est pas co 
        }else{
            echo'<div><p>unauthorized redirection</p></div>';
        }
    }




    ?>

</body>

</html>