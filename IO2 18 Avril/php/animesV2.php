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

if (isset($_GET['anime'])) {

$idA = $_GET['anime'];

$q = $db->prepare('SELECT * FROM animes WHERE id='.$idA);

$q->execute();

$res = $q->fetch();

echo "Bienvenue sur la page de ".$res['titre']."<br><br>";

echo "Synopsis : ".$res['synopsis']."<br><br>";

$q = $db->prepare('SELECT * FROM animes WHERE id='.$idA);

$q->execute();

$res = $q->fetch();

echo "Les commentaires sur ".$res['titre']." : <br><br>";

$q = $db->prepare('SELECT user_id,avis,note FROM commentaires WHERE anime_id='.$idA);

$q->execute();

$res = $q->fetchAll();

foreach($res as $ress) {

$q = $db->prepare('SELECT pseudo FROM users WHERE `id` =' .$ress['user_id'] );

$q->execute();

$res2 = $q->fetch();

echo "Pseudo : ".$res2['pseudo']."<br> Note : ".$ress['note']."/5 <br> Avis : ".$ress['avis']."<br><br>";

}

?>

<body>

<div class="form-commentaire">

<h1>Ajouter un commentaire</h1>

<form method="post">

<textarea type="text" name="avis" size="30" placeholder="Votre avis" class="i-box" required></textarea>

<br><br>

<input type="number" name="note" size="30" placeholder="Note entre 0 et 5" class="i-box" required>

<br><br>

<input type="submit" name="formsend" size="15" value="Ajouter mon commentaire !" class="buton">

<br>

</form>

<a href="animes.php">Choisir un autre animé</a>

</div>

<?php

}

if (isset($_POST['formsend'])) {

if ($_POST['note'] >= 0 && $_POST['note'] <= 5) {

$q = $db->prepare('INSERT INTO `commentaires`(`user_id`,`anime_id`,`note`, `avis`) VALUES(?,?,?,?)');

$q->execute(array($_SESSION['auth']['id'],$_GET['anime'], htmlspecialchars($_POST['note']), htmlspecialchars($_POST['avis'])));

echo $_GET['anime'];

echo "Le commentaire a bien été ajouté !!";

header('Refresh: 0');

} else {

echo "Vous devez saisir une note entre 0 et 5";

}

}

?>

</body>

</html>
