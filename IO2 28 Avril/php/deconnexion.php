<?php
session_start();
$_SESSION = array();
session_destroy();
if (isset($_COOKIE['rester_connecte'])) {
    unset($_COOKIE['rester_connecte']);
    setcookie('rester_connecte', '', time() - 3000);
}
header('Location: ../index.php');

?>

