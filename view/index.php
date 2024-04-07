<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TZU</title>
  <link href="../css/style.css" rel="stylesheet">
  <link href="../css/style_popup.css" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>

  <?php
  require("../model/database.php");
  session_start();
  ?>
  <?php 
    require("navbar.php");
    require("../view/popup_signin.php");
    
    // require("../controller/function.php");
  ?>
  </a>

    <div id="postbox">
    <div id="button">
  <button onclick="showRecent()">Afficher les publications récentes</button>
  <button onclick="showFollowed()">Afficher les publications suivies</button>
</div>
  <div id="recent" class="post">
    <?php
    $sql = "SELECT * FROM post ORDER BY time DESC";
    $query = $db->prepare($sql);
    $query->execute();
    $data = $query->fetchAll();
    if (empty($data)) {
        echo "<p>No post found</p>";
    }
    else{
        _displayPost($data);
    }

    ?>
  </div>
  <div id="follow" class="post">
   
            <?php
            
            // Récupérer les utilisateurs que vous suivez
            $sql_follow = "SELECT id_follow FROM follow WHERE id_user = ?";
            $query_follow = $db->prepare($sql_follow);
            $query_follow->execute([$_SESSION["id_user"]]);
            $followed_users = $query_follow->fetchAll(PDO::FETCH_COLUMN);
            
            // Récupérer les posts de chaque utilisateur suivi
            foreach($followed_users as $followed_user_id) {
                $sql_post = "SELECT * FROM post WHERE id_user = ? ORDER BY time DESC";
                $query_post = $db->prepare($sql_post);
                $query_post->execute([$followed_user_id]);
                $data = $query_post->fetchAll();
                if (empty($data)) {
                    
                }else{
                  
                    _displayPost($data);
                }
            
            }
            ?>
        
    
</div>
</div>
</body>

</html>