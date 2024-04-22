
    <?php

    require("../model/database.php");
    session_start();
    global $db;


    if (!empty($_POST)) {
        if (!empty($_POST["content"])) {

            $content = "";

            $content = $_POST["content"];
            $id_user = $_SESSION["id_user"];
            $date = date("Y-m-d H:i:s");

            $query = $db->prepare("INSERT INTO post (id_user,time,content) VALUES (?,?,?)");
            $query->execute([$id_user, $date, $content]);

            if($_FILES["post_img"]["size"] != 0 ){
                echo  "<script>console.log('test') </script>";
                $path ="../image/post_photo/";
                $extention = pathinfo($_FILES["post_img"]["name"],PATHINFO_EXTENSION);
               
                $sql = "SELECT id FROM post WHERE time = ?";
                $query = $db->prepare($sql);
                $query->execute([$date]);

                $id_post = $query->fetch()[0];

                move_uploaded_file($_FILES["post_img"]["tmp_name"],$path.$id_post.".".$extention);

                $query = $db->prepare("UPDATE post SET image = ? WHERE id = ?");
                $query->execute([$id_post.".".$extention,$id_post]);
    
            }
            header("Location: ../view/user.php?id=" . $_SESSION["id_user"]);
        } else {
            echo "<div class=error-box>Fill all the fields</div>";
        }
    }

    require("../view/form_create_post.html");

    ?>
