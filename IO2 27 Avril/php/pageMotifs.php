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
  <title>Motifs du signalment</title>
</head>

<body>
    <a href="animes.php">Retour aux animés</a>
    <h1>Veuillez choisir le motif du signalement</h1>

    <form  method="post">
        Motifs : <br><input type="radio" name="motif" value="Commentaire violent"required> Commentaire violent <br>
                 <input type="radio" name="motif" value="Commentaire offensant ou haineux" required> Commentaire offensant ou haineux <br>
                 <input type="radio" name="motif" value="Commentaire à but commercial" required> Commentaire à but commercial <br>
                 <input type="radio" name="motif" value="Commentaire menaçant" required> Commentaire menaçant <br>
                 <input type="radio" name="motif" value="Autre" required> Autre <br>
                 <br>
    <input type="submit" name="submit" size="15" value="Envoyer">
    </form>

    <?php
     if (isset($_POST['submit'])) {
        $q = $db->prepare('SELECT * FROM signalements WHERE commentaire_id=:commentaire_id');
        $q->execute(['commentaire_id' => $_GET['commentaire']]);
        $res = $q->rowCount();
        if ($res != 0) {
            echo "Ce commentaire a déjà été signalé";
            header('Refresh: 3; animes.php');
        } else {
            $q = $db->prepare('SELECT * FROM commentaires WHERE commentaire_id=:commentaire_id');
            $q->execute(['commentaire_id' => $_GET['commentaire']]);
            $res = $q->fetch();
        $u = $res['user_id'];
        $c = $res['avis'];
        
        
        $q = $db->prepare('INSERT INTO `signalements`(`user_id`,`commentaire_id`,`motif`, `commentaire`) VALUES(?,?,?,?)');
        $q->execute(array($u, htmlspecialchars($_GET['commentaire']), htmlspecialchars($_POST['motif']), $c));
        echo "Le commentaire a bien été signalé";
        header('Refresh: 3; animes.php');
        }
        
        
     }

    ?>
    
</body> 
</html>
