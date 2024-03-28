
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/user.css" rel="stylesheet">
</head>

<body>
    <div id="title"><h1>Profil page</h1></div>
    <div id= "creation_post"><?php require("../model/create_post.php");?></div>
    <?php
    require("../model/user_info.php");
    require("../model/database.php");
    session_start();
    global $db;
    
   
    if (isset($_SESSION["id_user"])) {

        $user = $_SESSION["id_user"];
        $sql = "SELECT id,first_name,last_name,age,birthday,email,pseudo,admin,profil_picture FROM user WHERE id=?";
        $qry = $db->prepare($sql);
        $qry->execute([$user]);
        $data = $qry->fetch();
        $user = new User($data["id"], $data["first_name"], $data["last_name"], $data["age"], $data["birthday"], $data["email"], $data["pseudo"], $data["admin"], $data["profil_picture"]);

        $user->displayUserPage();
        ?>
        <div id="button">
            <button id="update" onclick="checkAndRedirect()">Update</button>
        </div>
        <div id="overlay"></div>
        <div id="rectangle">
        <?php
        echo '<form class="form" action="../model/update_user.php" method="POST">';
        echo '    <input type="text" name="first_name" value="' . $user->getFirstName() . '"><br>';

        echo '    <input type="text" name="last_name" value="' . $user->getLastName() . '"><br>';

        echo '    <input type="number" name="age" value="' . $user->getAge() . '"><br>';

        echo '    <input type="date" name="birthday" ><br>';

        echo '    <input type="email" name="email" value="' . $user->getEmail() . '"><br>';

        echo '    <input type="text" name="pseudo" value="' . $user->getPseudo() . '"><br>';

        echo '    <input type="password" name="password" placeholder="password"><br>';

        echo '    <input type="password" name="passwordRepeat" placeholder="password repeat"><br>';

        echo '    <input type="submit" value="Update">';
        echo '</form>';
        ?>
        </div>
      
        <div id="flou-body"></div>
    <?php    

    }
    ?>
    <script src="script.js"></script>

    
    
    <div id="post-container">
        <?php
        require("../model/post_info.php");
        $sql = "SELECT id_user,time,content FROM post WHERE id_user=?";
        $qry = $db->prepare($sql);
        $qry->execute([$user->getIdUser()]);
        $data = $qry->fetchAll();
        foreach ($data as $post) {
            $post = new Post($post["content"], $post["id_user"], $post["time"]);
            $post->displayPost();
        }
        ?>
    </div>
<?php 
echo"<a href=index.php>kerfervfer</a>"
?>
<a href="../model/create_post.php">Create a post</a>

</body>


