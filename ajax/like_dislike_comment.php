<?php
    if(isset($_POST["id_comment"])&& isset($_POST["id_user"])){
        require("../model/database.php");
        session_start();
        global $db;

        $id_comment = $_POST["id_comment"];
        $id_user = $_POST["id_user"];
        $sql = "SELECT * FROM likedcomment WHERE id_comment = ? AND id_user = ?";
        $query = $db->prepare($sql);
        $query->execute([$id_comment,$id_user]);
        $data = $query->fetch();
        if($data){
            $sql = "DELETE FROM likedcomment WHERE id_comment = ? AND id_user = ?";
            $query = $db->prepare($sql);
            $query->execute([$id_comment,$id_user]);
            echo "dislike";
        }else{
            $sql = "INSERT INTO likedcomment(id_comment,id_user) VALUES(?,?)";
            $query = $db->prepare($sql);
            $query->execute([$id_comment,$id_user]);
            $id_like_comment = $db->lastInsertId();

            $sql="SELECT id_user,id_post FROM comment WHERE id = ?";
            $q = $db->prepare($sql);
            $q->execute([$id_comment]);
            $comment = $q->fetch(); // Récupère la première ligne de résultat

            $id_user_comment = $comment['id_user'];
            $id_post = $comment['id_post'];
          
            if($_SESSION["id_user"] != $id_user_comment){
            
                $sql = "INSERT INTO notification(id_user,id_post,content,viewed,retirer,id_like,warning,id_comment,id_follow,id_like_comment) VALUES(?,?,?,0,0,NULL,0,NULL,NULL,?)";
                $query = $db->prepare($sql);
                $query->execute([$id_user_comment,$id_post,"liked your",$id_like_comment]);
                
            }
            echo "like";
        }
    }
?>