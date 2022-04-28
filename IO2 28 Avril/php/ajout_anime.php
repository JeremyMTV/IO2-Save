<!DOCTYPE HTML>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Ajouter un animé </title>
  
</head>

<body>
  <div class="form-anime">
    <h1>Ajouter un animé</h1>
      <form  method="post">
        <input type="text" name="titre" size="30" placeholder="Titre" class="i-box" required>
        <br><br>
        <input type="text" name="synopsis" size="30" placeholder="Synopsis" class="i-box" required>
        <br><br>
        <input type="submit" name="formsend" size="15" value="Ajouter l'animé !" class="buton">
        <br>
      </form>
 </div>

<?php

require_once 'database.php';

$q = $db->prepare('SELECT synopsis FROM animes');
$q->execute();
$res = $q->fetchAll();

foreach($res as $ress) {
    echo $ress['synopsis'] . "<br>";
}

if (isset($_POST['formsend'])) {
    $q = $db->prepare('INSERT INTO `animes`(`nom`, `synopsis`) VALUES(?,?)');
    $q->execute(array(htmlspecialchars($_POST['titre']), htmlspecialchars($_POST['synopsis'])));
    echo "L'animé a bien été ajouté !!";
}

?>

</body>
</html>



