<?php
session_start();
require_once 'database.php';
require_once 'verifConnexion.php';
if (!estConnecte()) {
    header('Location: connexion.php');
    exit();
} 

$q = $db->prepare('SELECT * FROM commentaires WHERE commentaire_id=:commentaire_id');
$q->execute(['commentaire_id' => $_GET['commentaire']]);
$res = $q->fetch();
if ($res['user_id'] != $_SESSION['auth']['id'] && $_SESSION['auth']['admin'] != 1) {
    header('Location: animes.php');
    exit();
}

$q = $db->prepare('DELETE FROM commentaires WHERE commentaire_id=:commentaire_id');
$q->execute(['commentaire_id' => $_GET['commentaire']]);
echo "Le commentaire a bien été supprimé <br>";
header('Refresh: 3; animes.php');

?>
