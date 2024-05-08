<?php
    require("../model/database.php");

    if(isset($_POST["input"])){
        $input = $_POST["input"];

        $sql = "SELECT id,pseudo FROM user WHERE pseudo LIKE '{$input}%' OR pseudo LIKE '%{$input}%' OR pseudo LIKE '%{$input}' OR pseudo LIKE '{$input}'";
        $resultUser = mysqli_query($con,$sql);
        $sql = "SELECT id AS post_id,content,id_user,retirer FROM post WHERE content LIKE '{$input}%' OR content LIKE '%{$input}%' OR content LIKE '%{$input}' OR content LIKE '{$input}'";
        $resultPost = mysqli_query($con,$sql);

        if(mysqli_num_rows($resultUser) > 0 ){?>
            <h6 class='text-black text-center mt-3'>Search Results for User</h6>
            <table class="table table-bordered table-striped mt-4">
                <tbody>
                    <?php 
                    while($row = mysqli_fetch_assoc($resultUser)){
                        $pseudo = $row["pseudo"];
                        $id= $row["id"];
                         ?>
                        <tr>
                            <td><a href="../view/user.php?id=<?php echo $id; ?>"><?php echo $pseudo; ?></a></td>
                        </tr>
                        <?php
                    }
                        
                    ?>
                      
                    
                    
                </tbody>
            </table>
            <?php 

        }else{
            echo "<h6 class='text-danger text-center mt-3'>No result found for user</H6>";
        }

        if(mysqli_num_rows($resultPost) > 0 ){?>
            <h6 class='text-black text-center mt-3'>Search Results for Post</h6>
            <table class="table table-bordered table-striped mt-4">
                <tbody>
                    <?php 
                    while($row = mysqli_fetch_assoc($resultPost)){
                        $content = $row["content"];
                        $id= $row["id_user"];
                        $id_post = $row["post_id"];
                        $retire = $row["retirer"];

                        $sql = "SELECT pseudo FROM user WHERE id = $id";
                        $result = mysqli_query($con,$sql);
                        $row = mysqli_fetch_assoc($result);
                        $pseudo = $row["pseudo"];
                        if($retire == NULL){
                         ?>
                        <tr>
                            <td><a href="../view/user.php?id=<?php echo $id; ?>"><?php echo $pseudo; ?></a> : <?php echo $content; ?>. <a href="../view/post.php?id_post=<?php echo $id_post;?>">(go to)</a></td>
                        </tr>
                         
                        <?php
                         }
                    }
                        
                    ?>
                      
                    
                    
                </tbody>
            </table>
            <?php


    }else{
        echo "<h6 class='text-danger text-center mt-3'>No result found for post</H6>";}
}

?>