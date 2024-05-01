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