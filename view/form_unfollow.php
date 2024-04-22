<script src="../script/confirm.js"></script>
<form id="unfollow" method="post" action="../model/follow.php">
    <input type ="hidden" name="id_follow" value="<?php echo $_GET["id"] ?>">
    <input type ="hidden" name="id_user" value="<?php echo $_SESSION["id_user"] ?>">
    <input type ="hidden" name="unfollow" value="Unfollow">
    <button type="button" onclick="confirmUnfollow()">Unfollow</button>
</form>