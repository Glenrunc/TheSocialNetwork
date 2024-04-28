<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/style.css" rel="stylesheet">
        <link href="../css/blur.css" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </head>


    </head>
    <body>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <?php 
            require("../model/database.php");
            require("../model/post_info.php");
            session_start();
            echo "<script src='../script/add_like.js'></script>";
            echo "<script src='../script/add_dislike.js'></script>";
            
            if(isset($_SESSION["admin"]) && $_SESSION["admin"] == 1){

                $sql = "SELECT * FROM post WHERE flou = 1";
                $query = $db->prepare($sql);
                $query->execute();
                $data = $query->fetchAll();
                if(!empty($data)){
                echo "<h1>Blured post</h1>";
                echo" <a class='link' href= '../view/user.php?id=".$_SESSION["id_user"]."'>Back</a>";
                echo '<div id="postbox">';

                foreach($data as $post){
                    
                    $post_obj = new Post($post["id"],$post["content"], $post["id_user"], $post["time"],$post["id"]);
                    echo '<div class="btn-div">';
                    echo '<button id ="unblur'.$post_obj->getId().'" type="button" class="btn btn-danger mb-1">Unblur</button>';
                    echo '</div>';
                    $post_obj->displayPost();
                    ?>
                    <script>
                        var buttonAction = document.getElementById("btn-action"+<?php echo $post_obj->getId(); ?>);
                        if(buttonAction != null) {buttonAction.remove();};
                    </script>
                    <?php
                    echo'
                        <script>
                        $(document).ready(function(){
                            $("#unblur'.$post_obj->getId().'").click(function(){
                                
                                if(confirm("Are you sure you want to unblur this post?")){
                                $.ajax({
                                    url: "../ajax/blur_post.php",
                                    type: "POST",
                                    data: {id_unblur: '.$post_obj->getId().'},
                                    success: function(data){
                                        $("#post'.$post_obj->getId().'").remove();
                                        $("#unblur'.$post_obj->getId().'").remove();
                                    }
                                });
                                
                            }
                            });
                        });
                        </script>
                    ';
                }
                echo '</div>';
                }
                else{
                    echo "<h2>No blured post</h2>";
                    echo" <a class='link' href= '../view/user.php?id=".$_SESSION["id_user"]."'>Back</a>";
                }
            }
            else{

                header("Location: ../view/user.php?id=".$_SESSION["id_user"]);
            }
        ?>

    </body>
</html>