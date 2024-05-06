
    <?php

    require("../model/database.php");
    session_start();
    global $db;


    if (!empty($_POST)) {
        if (!empty($_POST["message"])) {

            $content = $_POST["message"];
            $id_user = $_SESSION["id_user"];
            $date = date("Y-m-d H:i:s");

            $query = $db->prepare("INSERT INTO post (id_user,time,content) VALUES (?,?,?)");
            $query->execute([$id_user, $date, $content]);
            $id_post = $db->lastInsertId();
            
            if($_FILES["image"]["size"] != 0 ){
                echo  "<script>console.log('test') </script>";
                $path ="../image/post_photo/";
                $extention = pathinfo($_FILES["image"]["name"],PATHINFO_EXTENSION);

                move_uploaded_file($_FILES["image"]["tmp_name"],$path.$id_post.".".$extention);

                $query = $db->prepare("UPDATE post SET image = ? WHERE id = ?");
                $query->execute([$id_post.".".$extention,$id_post]);
    
            }

            $sql = "SELECT id_user FROM follow WHERE id_follow = ?";
            $query = $db->prepare($sql);
            $query->execute([$_SESSION["id_user"]]);
            $data = $query->fetchAll(PDO::FETCH_COLUMN);

            foreach($data as $follow){
                $follow = intval($follow);
                $sql = "INSERT INTO notification(id_user,id_post,content,viewed,retirer,id_like,warning,id_comment,id_follow) VALUES (?,?,?,0,0,NULL,0,NULL,NULL)";
                $query = $db->prepare($sql);
                $query->execute([$follow,$id_post,"add a new"]);
            }

            header("Location: ../view/user.php?id=" . $_SESSION["id_user"]);
        }
    }

    ?>
