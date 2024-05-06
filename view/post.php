<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TZU</title>
  <link href="../css/style.css" rel="stylesheet">
  <link href="../css/style_popup.css" rel="stylesheet">
  <link href="../css/style_post.css" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    
    <?php
    if(isset($_GET["id_post"])){
        require("../model/database.php");
        session_start();
        require("navbar.php");
        echo "<script src='../script/add_like.js'></script>";
        echo "<script src='../script/add_dislike.js'></script>";
        echo "<script src='../script/add_blur.js'></script>";
        echo "<script src='../script/add_delete_admin.js'></script>";
        echo "<script src='../script/add_blur_admin.js'></script>";
        require("../view/popup_signin.php");
        ?>
     
        <div id="postboxPost">
        <div id="wrap">
        <div id="searchresult"></div>
        </div>
            <?php
                        
                $sql= "SELECT * FROM post WHERE id= ?";
                $query = $db->prepare($sql);
                $query->execute([$_GET["id_post"]]);
                $data = $query->fetch();

                if($data){
                    $post = new Post($data["id"], $data["content"], $data["id_user"], $data["time"], $data["flou"], $data["retirer"], $data["image"]);
                    
                    if($data["retirer"] == 1){
                        echo "<p>Post removed</p>";
                    }else{
                    $post->displayPost();
                    ?>
                    
                        <script>
                            var element = document.getElementById("goto"+<?php echo $_GET["id_post"] ?>);
                            element.remove();
                        </script>
                       

                    <div id="commentbox">
                       
                    <?php
                    require("../model/comment_info.php");
                    $sql = "SELECT * FROM comment WHERE id_post = ? ORDER BY date DESC, hour DESC";
                    $query = $db->prepare($sql);
                    $query->execute([$post->getId()]);
                    $data = $query->fetchAll();

                    if($data){
                        foreach($data as $commentUser){
                            $comment = new Comment($commentUser["id"],$commentUser["id_post"],$commentUser["id_user"],$commentUser["content"],$commentUser["date"],$commentUser["hour"],$commentUser["image"]);
                            $comment->displayComment();
                        }
                    }else{
                        echo "<p>No comment</p>";
                    }
                     
                    ?>
                    </div>
                    <?php
                    }

                }else{
                    echo "<p>Post not found</p>";
                }
            ?>
        </div>
        <?php
    }else{
        header("Location: index.php");
    }
    ?>

   

</body>
</html>