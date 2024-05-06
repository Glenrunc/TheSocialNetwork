<?php
    Session_start();

    require_once("../model/database.php"); //Connecte
	require_once("../model/post_info.php"); //Importe classe postStorage
    
    
    $postNumber = $_GET["firstPost"];
    $sql = "SELECT * FROM post WHERE id_user=? ORDER BY time DESC LIMIT 5 OFFSET ".$postNumber;
    $stmt = $db->prepare($sql);
    $stmt->execute([$_GET["id"]]);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (!empty($data)) { 
        foreach($data as $row){
            if ($row['retirer'] != 1) {
                
                $post = $post = new Post($row["id"],$row["content"], $row["id_user"], $row["time"],$row["flou"],$row["retirer"],$row["image"]);
                $post->displayPost();
                $lastDisplayedPostId = $row["id"];
            }else{
                echo "<p>la publication numero </p>";
                echo $row["id"];
                echo "<p> ne rentre pas dans le if</p>";
              }
			//On utilise la classe "postStorage pour afficher le post


            
			
			//On incrémente le compteur de posts 
			//(utile pour créer le bouton avec bon javascript à la fin)
            $postNumber++;
			
			
        } // fin du while qui affiche les posts

        //While terminé. On crée un bouton "charger plus de posts"
		?>
        <?php
        // Vérifier si l'ID du dernier post affiché est le même que l'ID du dernier post dans la base de données
        $sqlLastPostId = "SELECT id FROM post ORDER BY id ASC LIMIT 1";
        $queryLastPostId = $db->query($sqlLastPostId);
        $lastPostIdInDatabase = $queryLastPostId->fetchColumn();
        if ($lastDisplayedPostId === $lastPostIdInDatabase) {

        } else {
            ?>
            <div id="morePosts" >
                <button type="button" onclick="loadMorePosts(<?php echo $postNumber; ?>,'<?php echo $_GET["id"]; ?>')">Charger plus de Posts</button>
            </div>
            <?php
        }
    ?>

		<?php
    }
?>