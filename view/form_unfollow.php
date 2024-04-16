<form method="post" action="../model/follow.php">
    <input type ="hidden" name="id_follow" value="<?php echo $_GET["id"] ?>">
    <input type ="hidden" name="id_user" value="<?php echo $_SESSION["id_user"] ?>">
    <input type ="hidden" name="unfollow" value="Unfollow">
    <input type="submit" value="unfollow">
</form>