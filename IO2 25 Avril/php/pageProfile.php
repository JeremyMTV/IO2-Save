<?php
session_start();
require_once 'database.php';
require_once 'verifConnexion.php';
if (!estConnecte()) {
  header('Location: connexion.php');
  exit();
}

?>

<!DOCTYPE html>
<html lang="fr">

  <head>
    <meta charset="UTF-8">
    <title>Mon espace</title>
  </head>

  <body>
      <h1>Salut <?php echo $_SESSION['auth']['pseudo'] ?>, bienvenue sur ton espace personnel !</h1> <br>
      <?php
       if ($_SESSION['auth']['admin'] == 1) {
            echo "<a href=\"espaceAdmin.php\">Continuer sur mon espace administrateur</a>";
          }
      ?>

      <h2>Mes derniers commentaires sur les animés : </h2> <br>



<?php

          $q = $db->prepare('SELECT * FROM commentaires WHERE user_id=:user_id');
          $q->execute(['user_id' => $_SESSION['auth']['id']]);
          $res = $q->fetchAll();
          $res = array_reverse($res);
          $i = 0;

          foreach($res as $ress) {
              if ($i == 5) {
                  break;
              }
              $i++;
            $q = $db->prepare('SELECT titre FROM animes WHERE id =:id');
            $q->execute(['id' => $ress['anime_id']]);
            $res2 = $q->fetch();
            echo "Animé : ".$res2['titre']."<br> Note : ".$ress['note']."/5 <br> Avis : ".$ress['avis']."<br><br>";
          }


          ?>

        </body>
        </html>

