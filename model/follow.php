<?php   
require_once("database.php");
if (isset($_POST['follow'])) {
    // Vérifier si le suivi n'est pas déjà actif
    $query_check_follow = $db->prepare("SELECT COUNT(*) FROM follow WHERE id_user = ? AND id_follow = ?");
    $query_check_follow->execute([$_POST["id_user"], $_POST["id_follow"]]);
    $count_follow = $query_check_follow->fetchColumn();

    if ($count_follow > 0) {
        // L'utilisateur suit déjà l'autre utilisateur
        echo "Vous suivez déjà cet utilisateur.";
    } else {
        // Le suivi n'est pas déjà actif, donc on l'insère
        $query_insert_follow = $db->prepare("INSERT INTO follow (id_user, id_follow) VALUES (?, ?)");
        $query_insert_follow->execute([$_POST["id_user"], $_POST["id_follow"]]);
        header("Location: ../view/user.php?id=" . $_POST["id_follow"]);
    }
}
if (isset($_POST['unfollow'])) {
    // Vérifier si le suivi est actif
    $query_check_follow = $db->prepare("SELECT COUNT(*) FROM follow WHERE id_user = ? AND id_follow = ?");
    $query_check_follow->execute([$_POST["id_user"], $_POST["id_follow"]]);
    $count_follow = $query_check_follow->fetchColumn();

    if ($count_follow > 0) {
        // L'utilisateur suit déjà l'autre utilisateur
        $query_delete_follow = $db->prepare("DELETE FROM follow WHERE id_user = ? AND id_follow = ?");
        $query_delete_follow->execute([$_POST["id_user"], $_POST["id_follow"]]);
    }
    header("Location: ../view/user.php?id=" . $_POST["id_follow"]);
}
?>
