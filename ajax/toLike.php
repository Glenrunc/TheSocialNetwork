<?php
require("../model/database.php");
session_start();
$id_post = $_GET["id_post"];
$sql = "DELETE FROM likedpost WHERE id_post = ? AND id_user = ?";
$query = $db->prepare($sql);
$query->execute([$id_post, $_SESSION["id_user"]]);
$sql = "SELECT COUNT(*) FROM likedpost WHERE id_post = ?";
$query = $db->prepare($sql);
$query->execute([$id_post]);
$like = $query->fetch()[0];

?>

<div id="like<?php echo $id_post; ?>">
    <button type="button" class="btn btn-success" onclick="toDislike(<?php echo $id_post; ?>)">Like</button>
    <span> Total amount of :<?php echo $like ?></span>
</div>