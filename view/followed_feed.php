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
    echo "<script src='../script/add_like.js'></script>";
    echo "<script src='../script/add_dislike.js'></script>";
    echo "<script src='../script/add_blur.js'></script>";
    echo "<script src='../script/add_delete_admin.js'></script>";
    echo "<script src='../script/add_blur_admin.js'></script>";
    echo "<script src='../script/loadMore.js'></script>";
    ?>
    <?php
    if (isset($_SESSION["id_user"])) {
        require("navbar.php");
    } else {
        header("Location: ../view/index.php");
    }
    require("../view/popup_signin.php");

    ?>
    <div id="wrap">
    <div id="searchresult"></div>
    </div>
    <div id="maincontainer">
        <div id="button">
            <p>Followed</p>
            <?php
            if (isset($_SESSION["id_user"])) {
                echo "<button type='button' class='btn btn' onclick='showRecent()' style='background-color: #303245; color:aliceblue'>Recent</button>";
            }
            ?>
        </div>

        <div id="postbox">

            <div id="recent">
                <?php
                $sql = "SELECT id_follow FROM follow WHERE id_user = ?";
                $query = $db->prepare($sql);
                $query->execute([$_SESSION["id_user"]]);
                $data = $query->fetchAll();
                if (empty($data)) {
                    echo "<p>Il n'y a pas de publication pour le moment.</p>";
                } else {
                    $posts = array();
                    $follows = array();
                    foreach ($data as $follow) {
                        $sql = "SELECT * FROM post WHERE id_user = ? ORDER BY time DESC";
                        $query = $db->prepare($sql);
                        $query->execute([$follow["id_follow"]]);
                        $posts = array_merge($posts, $query->fetchAll());
                        $follows[] = $follow["id_follow"];
                    }
                    usort($posts, function ($a, $b) {
                        return $b['time'] <=> $a['time'];
                    });
                    foreach ($posts as $post) {
                        if($post['retirer'] != 1){
                            $postData = $post;
                            $post = new Post($post["id"],$post["content"], $post["id_user"], $post["time"],$post["flou"],$post["retirer"],$post["image"]);
                            $post->displayPost();
                      

                        }
                    }
                }
                ?>
            </div>
        </div>
      
    </div>
    
</body>

</html>