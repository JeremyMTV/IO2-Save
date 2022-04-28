<?php
session_start();
require_once 'database.php';
require_once 'verifConnexion.php';

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
          $q = $db->prepare('SELECT * FROM commentaires WHERE anime_id=:anime_id');
          $q->execute(['anime_id' => $idA]);
          $res = $q->fetchALL();
          if ($res) {
            $moy = 0;
            foreach($res as $ress) {
              $moy = $moy + $ress['note'];
            }
            $q = $db->prepare('SELECT * FROM commentaires WHERE anime_id=:anime_id');
            $q->execute(['anime_id' => $idA]);
            $resF = $q->rowCount();
            

            $moy = $moy / $resF;

            $q = $db->prepare('UPDATE `animes` SET `note` = :note WHERE `animes`.`id` = :id');
            $q->execute(array('note' => $moy, 'id' => $idA));
            


          }


        
          $q = $db->prepare('SELECT * FROM animes WHERE id=:id');
          $q->execute(['id' => $idA]);
          $res = $q->fetch();
          echo "Bienvenue sur la page de ".$res['titre']."<br><br>";
          if ($res['note'] != -1) {
            echo "Note moyenne : ".$res['note']."/5   (".$resF." commentaires) <br><br>";
          }
          echo "Synopsis : ".$res['synopsis']."<br><br>";

          echo "Les commentaires sur ".$res['titre']."  : <br><br>";
          if (!estConnecte()) {
            echo "<a href=\"connexion.php\">Me connecter pour consulter tous les commentaires</a><br><br>";
          }

          $q = $db->prepare('SELECT user_id,avis,note,commentaire_id FROM commentaires WHERE anime_id=:anime_id');
          $q->execute(['anime_id' => $idA]);
          $res = $q->fetchAll();
          $res = array_reverse($res);
          $i = 0;
          
          
          foreach($res as $ress) {
            if (!estConnecte()) {
              if ($i == 3) {
                break;
              }
              $i++;
          }
            $q = $db->prepare('SELECT pseudo FROM users WHERE id =:id');
            $q->execute(['id' => $ress['user_id']]);
            $res2 = $q->fetch();
            if (estConnecte() && $_SESSION['auth']['admin'] == 1) {
                 echo "Pseudo : ".$res2['pseudo']."<br> Note : ".$ress['note']."/5 <br> Avis : ".$ress['avis']." <a href=\"suppression.php?commentaire=".$ress['commentaire_id']."\">Supprimer</a><br><br>";

            } else if (estConnecte() && $_SESSION['auth']['admin'] == 0 && $_SESSION['auth']['pseudo'] == $res2['pseudo']) {
              echo "Pseudo : ".$res2['pseudo']."<br> Note : ".$ress['note']."/5 <br> Avis : ".$ress['avis']." <a href=\"suppression.php?commentaire=".$ress['commentaire_id']."\">Supprimer mon commentaire</a><br><br>";

            } else if (estConnecte() && $_SESSION['auth']['admin'] == 0 && $_SESSION['auth']['pseudo'] != $res2['pseudo']) {
              echo "Pseudo : ".$res2['pseudo']."<br> Note : ".$ress['note']."/5 <br> Avis : ".$ress['avis']." <a href=\"pageMotifs.php?commentaire=".$ress['commentaire_id']."\">Signaler le commentaire</a><br><br>";

            
            } else {
              echo "Pseudo : ".$res2['pseudo']."<br> Note : ".$ress['note']."/5 <br> Avis : ".$ress['avis']." <br><br>";
            }
          }
        }
      if (estConnecte()) {
?>

<body>
  <div class="form-commentaire">
    <h1>Ajouter un commentaire</h1>
      <form  method="post">
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
                  echo "Le commentaire a bien été ajouté !!";
                  header('Refresh: 0');
                  
              } else {
                echo "Vous devez saisir une note entre 0 et 5";
              }
            }
          

?>

</body>
</html>




