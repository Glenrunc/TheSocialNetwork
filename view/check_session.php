<?php
session_start();
if (isset($_SESSION['id_user'])) {
    echo json_encode(array('sessionExists' => true));
} else {
    echo json_encode(array('sessionExists' => false));
}
?>
