<!DOCTYPE html>
<html lang="fr">


<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <title>Nakama San</title>
    <link rel="icon" type="image/png" href="../image/logo.png">

<style>

.formulaire{
  margin: 6px 0;
  cursor: pointer;
  position: absolute;
    top: 5%;
    right: 0px;

}
    input[type=button] {
      /* background-color: #e4f12a;
      border: none;
      color: white;
      padding: 16px 32px;
      text-decoration: none;
      margin: 4px 2px;
      cursor: pointer; */
      background: none;
        border: 4px solid rgb(0, 0, 0);
        border-radius: 10px;
        color: rgb(225, 228, 49);
        display: inline-flexbox;
        font-size: 10px;
        font-weight: bold;
        margin: 10px auto;
        padding: 2em 6em;
        position: relative;
        text-transform: uppercase;
    }

    input[type=button], input[type=button]:after{
      -webkit-transition: all 0.3s;
      -moz-transition: all 0.3s;
      -o-transition: all 0.3s;
      transition: all 0.3s;
    }

    input[type=button]::before, input[type=button]::after{
      background: rgb(235, 53, 53);
        content: "";
        position: absolute;
        z-index: -1;
    }

    input[type=button]:hover{
      color: white;
      background-color: #a2e946
    }

    input[type=button]::after{
      height: 0;
      left: 0;
      top: 0;
      width: 100%;
    }

    input[type=button]:hover:after{
      height: 100%;
    }

    .corps h1.active{
width : 40%;
height: 50%;
background-color: rgb(184, 184, 66);
color: rgb(255, 255, 255);   
animation: mymove 1s infinite;
border-radius: 50px;
font-size: 170%;
display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

.corps h1.ac{
  font-size: 170%;
display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

.active{
  width : 20%;
height: 50%;
background-color: rgb(184, 184, 66);
color: rgb(255, 255, 255);   
animation: mymove 1s infinite;
border-radius: 50px;
font-size: auto;
display: inline-block;
 vertical-align: middle;
 float: none;
 margin:30px;
}

.droite{
      float:left;
      padding : 1%;
    }

.active .supp .nommer .ajouterA .ajouterM .Signaler{
  display: inline-block;
 vertical-align: middle;
  float:none;
  
}
</style>
</head>



<header>
    <!-- <div class="container" onclick="myFunction(this)">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
    </div> -->

    <div class="droite"><a href="../index.php" ><img src="../image/Nakama San2.png" width=40% height=40%></a></div>

<?php 
require_once 'database.php';
require_once 'verifConnexion.php';
if(!estConnecte()){?>
    <div class="formulaire">
      <a href="../page de connexion/PageInscription.html"><input type="button" value="S'inscrire"></a>
      <a href="../page de connexion/connexion1.php"><input type="button" value="Se connecter"></a>
     </div>
<?php } else { ?>
    <div class="formulaire">
      <a href="pageProfile.php"><input type="button" value=<?php echo $_SESSION['auth']['pseudo'] ?> ></a>
      <a href="deconnexion.php"><input type="button" value="Se déconnecter"></a>
    </div>
<?php } ?>
   
</header>


<script>
    function myFunction(x) {x.classList.toggle("change");}
</script>


<body>
    <div class="corps"> 
        <video autoplay="autoplay" muted="" loop="infinite" src="../video/amv.mp4"></video>

        <br>
        <br>
        <br>

        <center><h1 class="active">Salut <?php echo $_SESSION['auth']['pseudo'] ?>, bienvenue sur l'Espace Administrateur !</h1> <br></center>
        <?php
        if(!isset($_SESSION)){
          session_start();
        }
            require_once 'database.php';
            require_once 'verifConnexion.php';
            if (!estConnecte()) {
                header('Location: connexion.php');
                exit();
            }
            if ($_SESSION['auth']['admin'] == 0) {
                header('Location: ../index.php');
                exit();
            }

        // echo "<a href=\"pageProfile.php\">Retour à l'espace perso</a>";
        echo "<aside><div class=\"formulaire\"><a href=\"pageProfile.php\"><input type=\"button\" value=\"Retour à l'espace perso\"></a></div></aside>"?>
        <br>
        <br>
        <br>
        <br>

        <div class="active">
          <div class="supp">
            <br>
        <h1 class="ac">Supprimer un utilisateur : </h1>
        <br>
        <br>

<center><form  method="post">
        <input type="text" name="pseudo" size="30" placeholder="Pseudo de l'utilisateur" class="i-box" required>
        <br><br>
        <input type="submit" name="send" size="15" value="Supprimer l'Utilisateur" class="buton">
        <br>
</form></center>

    <?php
          
          if (isset($_POST['send'])) {
            $q = $db->prepare("SELECT * FROM users WHERE pseudo = :pseudo");
            $q->execute(['pseudo' => htmlspecialchars($_POST['pseudo'])]);
            $res = $q->fetch(); 

            if ($res) {
              if ($_SESSION['auth']['admin'] == 2 && htmlspecialchars($_POST['pseudo']) != $_SESSION['auth']['pseudo']) {
              $q = $db->prepare("DELETE FROM users WHERE pseudo = :pseudo");
              $q->execute(['pseudo' => htmlspecialchars($_POST['pseudo'])]);
              echo "L'utilisateur a bien été supprimé";

              } else if (htmlspecialchars($_POST['pseudo']) == $_SESSION['auth']['pseudo']) {
                echo "Erreur : ce pseudo est le vôtre";

              } else if ($_SESSION['auth']['admin'] == 1 && htmlspecialchars($_POST['pseudo']) != $_SESSION['auth']['pseudo'] && $res['admin'] == 0) {
                $q = $db->prepare("DELETE FROM users WHERE pseudo = :pseudo");
                $q->execute(['pseudo' => htmlspecialchars($_POST['pseudo'])]);
                echo "L'utilisateur a bien été supprimé";

              } else if ($_SESSION['auth']['admin'] == 1 && htmlspecialchars($_POST['pseudo']) != $_SESSION['auth']['pseudo'] && $res['admin'] != 0) {
                echo "Erreur : vous ne pouvez pas supprimer le compte d'un autre admin";
              }
            } else {
              echo "Cet utilisateur n'existe pas";
            }
          }
        


          ?></div></div>



<div class="active">
<div class="nommer">
  <br>
<h1 class="ac">Nommer un utilisateur admin  : </h1>
<br>
<br>
<center><form  method="post">
        <input type="text" name="pseudo" size="30" placeholder="Pseudo de l'utilisateur" class="i-box" required>
        <br><br>
        <input type="submit" name="nommeAdmin" size="15" value="Nommer l'Utilisateur admin" class="buton">
        <br>
</form></center>
<?php

if (isset($_POST['nommeAdmin'])) {
            $q = $db->prepare("SELECT * FROM users WHERE pseudo = :pseudo");
            $q->execute(['pseudo' => htmlspecialchars($_POST['pseudo'])]);
            $res = $q->fetch(); 

            if ($res) {
              if (htmlspecialchars($_POST['pseudo']) == $_SESSION['auth']['pseudo']) {
                echo "Erreur : ce pseudo est le vôtre";

              } else if (htmlspecialchars($_POST['pseudo']) != $_SESSION['auth']['pseudo'] && $res['admin'] == 0) {
                $q = $db->prepare('UPDATE `users` SET `admin` = :admin WHERE `users`.`id` = :id');
                $q->execute(array('admin' => 1, 'id' => $res['id']));
                echo "L'utilisateur a bien été nommé admin";

              } else if (htmlspecialchars($_POST['pseudo']) != $_SESSION['auth']['pseudo'] && $res['admin'] != 0) {
                echo "Erreur : cet utilisateur est déjà admin";
              }
            } else {
              echo "Cet utilisateur n'existe pas";
            }
          }
        
          ?></div></div>

    <div class="active">
    <div class="ajouterA">
      <br>
    <h1 class="ac">Ajouter un animé :</h1>
    <br>
    <br>
      <center><form  method="post">
        <input type="text" name="titre" size="30" placeholder="Titre" class="i-box" required>
        <br><br>
        <textarea type="text" name="synopsis" size="30" placeholder="Synopsis" class="i-box" required></textarea>
        <br><br>
        <input type="text" name="image" size="30" placeholder="Image" class="i-box" required>
        <br><br>
        <input type="text" name="video" size="30" placeholder="Vidéo" class="i-box" required>
        <br><br>
        <input type="submit" name="ajoutAnime" size="15" value="Ajouter l'animé !" class="buton">
        <br>
      </form></center>
 

<?php


if (isset($_POST['ajoutAnime'])) {
    $q = $db->prepare('INSERT INTO `animes`(`titre`, `synopsis`, `image`, `video`) VALUES(?,?,?,?)');
    $q->execute(array(htmlspecialchars($_POST['titre']), htmlspecialchars($_POST['synopsis']), htmlspecialchars($_POST['image']), htmlspecialchars($_POST['video'])));
    echo "L'animé a bien été ajouté !!";
}

?></div></div>

<div class="active">
<div class="ajouterM">
  <br>
<h1 class="ac">Ajouter un manga :</h1>
<br>
<br>
      <center><form  method="post">
        <input type="text" name="titre" size="30" placeholder="Titre" class="i-box" required>
        <br><br>
        <textarea type="text" name="synopsis" size="30" placeholder="Synopsis" class="i-box" required></textarea>
        <br><br>
        <input type="text" name="image" size="30" placeholder="Image" class="i-box" required>
        <br><br>
        <input type="submit" name="ajoutManga" size="15" value="Ajouter le manga !" class="buton">
        <br>
      </form></center>
 

<?php


if (isset($_POST['ajoutManga'])) {
    $q = $db->prepare('INSERT INTO `mangas`(`titre`, `synopsis`, `image`) VALUES(?,?,?)');
    $q->execute(array(htmlspecialchars($_POST['titre']), htmlspecialchars($_POST['synopsis']), htmlspecialchars($_POST['image'])));
    echo "Le manga a bien été ajouté !!";
}





          $q = $db->prepare('SELECT * FROM signalements');
          $q->execute();
          $res = $q->fetchAll();

          if ($res) {

?></div></div>
  

  <div class="active">
  <div class="Signaler">
    <br>
  <h1 class="ac">Signalements : </h1>
  <br>
  <br>
  <center><?php
  
          foreach($res as $ress) {
            $q = $db->prepare('SELECT pseudo FROM users WHERE id =:id');
            $q->execute(['id' => $ress['user_id']]);
            $res2 = $q->fetch();

            $q = $db->prepare('SELECT avis FROM commentaires WHERE commentaire_id =:commentaire_id');
            $q->execute(['commentaire_id' => $ress['commentaire_id']]);
            $res3 = $q->fetch();
            
            echo "Pseudo : ".$res2['pseudo']."<br> Motif : ".$ress['motif']." <br> Avis : ".$res3['avis']." <a href=\"suppression.php?commentaire=".$ress['commentaire_id']."\">Supprimer</a> ou <a href=\"suppression.php?signalement=".$ress['signalement_id']."\">Ignorer</a><br><br>";
          }

          $q = $db->prepare('SELECT * FROM signalements_mangas');
          $q->execute();
          $res = $q->fetchAll();

          foreach($res as $ress) {
            $q = $db->prepare('SELECT pseudo FROM users WHERE id =:id');
            $q->execute(['id' => $ress['user_id']]);
            $res2 = $q->fetch();

            $q = $db->prepare('SELECT avis FROM commentaires_mangas WHERE commentaire_id =:commentaire_id');
            $q->execute(['commentaire_id' => $ress['commentaire_id']]);
            $res3 = $q->fetch();
            
            echo "Pseudo : ".$res2['pseudo']."<br> Motif : ".$ress['motif']." <br> Avis : ".$res3['avis']." <a href=\"suppression.php?commentaireMangas=".$ress['commentaire_id']."\">Supprimer</a> ou ou <a href=\"suppression.php?signalementMangas=".$ress['signalement_id']."\">Ignorer</a><br><br>";
          }
        }


?></center></div></div>
       
          


        
    </div>
</body>



</html>