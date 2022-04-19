<?php
$user = 'root';
$pass = '';

try {
$db = new PDO('mysql:host=127.0.0.1;dbname=siteweb', $user, $pass);
echo "Connexion réussie <br>";
} catch (PDOException $e) {
    print "Erreur :" . $e->getMessage() . "<br/>";
    die;
}

?>
