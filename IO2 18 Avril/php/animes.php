<?php

session_start();

require_once 'database.php';

require_once 'verifConnexion.php';

if (!estConnecte()) {

header('Location: connexion.php');

exit();

}

?>

<!DOCTYPE HTML>

<html lang="fr">

<head>

<meta charset="utf-8">

<title>Formulaire</title>

</head>

<?php

$q = $db->prepare('SELECT * FROM animes');

$q->execute();

$res = $q->fetchAll();

echo "<form action= \"animesV2.php\" method=\"get\">";

echo "<select name=\"anime\" size=\"1\">";

foreach($res as $ress) {

echo "<option value=\"".$ress["id"]."\">$ress[id]</option>";

}

echo "</select>";

echo "<input type=\"submit\" name=\"choisir\" size=\"15\" value=\"Choisir\" class=\"buton\"><br><br>";

?>

</html>
