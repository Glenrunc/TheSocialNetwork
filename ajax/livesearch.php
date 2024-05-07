<?php
    require("../model/database.php");

    if(isset($_POST["input"])){
        $input = $_POST["input"];

        $sql = "SELECT id,pseudo FROM user WHERE pseudo LIKE '{$input}%' OR pseudo LIKE '%{$input}%' OR pseudo LIKE '%{$input}' OR pseudo LIKE '{$input}'";

        $result = mysqli_query($con,$sql);

        if(mysqli_num_rows($result) > 0){?>
            <table class="table table-bordered table-striped mt-4">
                <tbody>
                    <?php 
                    while($row = mysqli_fetch_assoc($result)){
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
            echo "<h6 class='text-danger text-center mt-3'>No result found</H6>";
        }
    }

?>