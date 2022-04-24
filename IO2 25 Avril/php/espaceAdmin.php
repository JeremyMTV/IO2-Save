<?php
session_start();
require_once 'database.php';
require_once 'verifConnexion.php';
if (!estConnecte()) {
  header('Location: connexion.php');
  exit();
}
if ($_SESSION['auth']['admin'] != 1) {
    header('Location: index.php');
    exit();
}

echo "<a href=\"pageProfile.php\">Retour à l'espace perso</a>";


?>

<!DOCTYPE html>
<html lang="fr">

  <head>
    <meta charset="UTF-8">
    <title>Mon espace</title>
  </head>

  <body>
  <h2>Supprimer un utilisateur : </h2>
<form  method="post">
        <input type="text" name="pseudo" size="30" placeholder="Pseudo de l'utilisateur" class="i-box" required>
        <br><br>
        <input type="submit" name="send" size="15" value="Supprimer l'Utilisateur" class="buton">
        <br>
</form>

    <?php
          
          if (isset($_POST['send'])) {
            $q = $db->prepare("SELECT * FROM users WHERE pseudo = :pseudo");
            $q->execute(['pseudo' => htmlspecialchars($_POST['pseudo'])]);
            $res = $q->fetch(); 

            if ($res) {
              if (htmlspecialchars($_POST['pseudo']) != $_SESSION['auth']['pseudo']) {
              $q = $db->prepare("DELETE FROM users WHERE pseudo = :pseudo");
              $q->execute(['pseudo' => htmlspecialchars($_POST['pseudo'])]);
              echo "L'utilisateur a bien été supprimé";
              } else {
                echo "Erreur : ce pseudo est le votre";
              }
            } else {
              echo "Cet utilisateur n'existe pas";
            }
          }


          ?>
  
  <h2>Signalements: </h2>
  <?php

          $q = $db->prepare('SELECT * FROM signalements');
          $q->execute();
          $res = $q->fetchAll();

          foreach($res as $ress) {
            $q = $db->prepare('SELECT pseudo FROM users WHERE id =:id');
            $q->execute(['id' => $ress['user_id']]);
            $res2 = $q->fetch();

            $q = $db->prepare('SELECT avis FROM commentaires WHERE commentaire_id =:commentaire_id');
            $q->execute(['commentaire_id' => $ress['commentaire_id']]);
            $res3 = $q->fetch();
            
            echo "Pseudo : ".$res2['pseudo']."<br> Motif : ".$ress['motif']." <br> Avis : ".$res3['avis']." <a href=\"suppression.php?commentaire=".$ress['commentaire_id']."\">Supprimer</a><br><br>";
          }


?>

        </body>

          </html>

 
