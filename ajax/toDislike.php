<?php 
require("../model/database.php");
$id_post = $_GET["id_post"];
session_start();

$sql = "SELECT COUNT(*) FROM likedpost WHERE id_post = ? AND id_user = ?";
$query = $db->prepare($sql);
$query->execute([$id_post, $_SESSION["id_user"]]);
$liked = $query->fetch()[0];

if(!$liked){
    $sql = "INSERT INTO likedpost(id_post,id_user) VALUES (?,?)";
    $query = $db->prepare($sql);
    $query->execute([$id_post,$_SESSION["id_user"]]);
    $lastInsertId = $db->lastInsertId();

    $sql = "SELECT id_user FROM post WHERE id = ?";
    $query = $db->prepare($sql);
    $query->execute([$id_post]);
    $id_user = $query->fetch()[0];

    if($id_user != $_SESSION["id_user"]){
        $sql = "INSERT INTO notification(id_user,id_post,content,viewed,retirer,id_like,warning) VALUES (?,?,?,0,0,?,0)";
        $query = $db->prepare($sql);
        $query->execute([$id_user,$id_post,"liked your post", $lastInsertId]);
    }
   
}


$sql = "SELECT COUNT(*) FROM likedpost WHERE id_post = ?";
$query = $db->prepare($sql);
$query->execute([$id_post]);
$like = $query->fetch()[0];
?>

<div id="dislike<?php echo $id_post; ?>">
    <button type="button" class="btn btn-danger btn-sm mb-1" onclick="toLike(<?php echo $id_post; ?>)">Dislike</button>
    <span> Total amount of like : <?php echo $like ?></span>
</div>