<?php
$user = 'root';
$pass = '';

try {
$db = new PDO('mysql:host=127.0.0.1;dbname=test', $user, $pass);
} catch (PDOException $e) {
    print "Erreur :" . $e->getMessage() . "<br/>";
    die;
}

?>
