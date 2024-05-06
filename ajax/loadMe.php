<?php
    Session_start();

    require_once("../model/database.php"); //Connecte
	require_once("../model/post_info.php"); //Importe classe postStorage
    ?>
    
    <?php
    
    $postNumber = $_GET["firstPost"];
    $sql = "SELECT * FROM post ORDER BY time DESC LIMIT 5 OFFSET ".$postNumber;
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll();
    
    if (!empty($data)) { 
        foreach($data as $row){
            if ($row['retirer'] != 1) {
                
                $post = $post = new Post($row["id"],$row["content"], $row["id_user"], $row["time"],$row["flou"],$row["retirer"],$row["image"]);
                $post->displayPost();
            }
			//On utilise la classe "postStorage pour afficher le post


            
			
			//On incrémente le compteur de posts 
			//(utile pour créer le bouton avec bon javascript à la fin)
            $postNumber++;
			
			
        } // fin du while qui affiche les posts

        //While terminé. On crée un bouton "charger plus de posts"
		?>
        <div id="morePosts" >
            <button type="button"  class="btn btn-light btn-sm" onclick="loadMorePosts(<?php echo $postNumber; ?>)">Load more</button>
        </div>
		<?php
    }
?>