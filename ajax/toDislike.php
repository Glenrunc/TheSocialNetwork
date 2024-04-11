<?php 
// require("../model/database.php");
$id_post = $_GET["id_post"];
// session_start();


// $sql = "INSERT INTO likedpost(id_post,id_user) VALUES (?,?)";
// $query = $db->prepare($sql);
// $query->execute([$id_post,$_SESSION["id_user"]]);

// $sql = "SELECT COUNT(*) FROM likedpost WHERE id_post = ?";
// $query = $db->prepare($sql);
// $query->execute([$id_post]);
// $like = $query->fetch()[0];
?>

<div id="dislike<?php echo $id_post; ?>">
    <button type="button" class="btn btn-danger" onclick="toLike(<?php echo $id_post; ?>)">Dislike</button>
    <!-- <span> Total amount of :<?php echo $like ?></span> -->
</div>