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
font-size: auto;
}

.active{
  width : 40%;
height: 50%;
background-color: rgb(184, 184, 66);
color: rgb(255, 255, 255);   
animation: mymove 1s infinite;
border-radius: 50px;
font-size: auto;
}

.droite{
      float:left;
      padding : 1%;
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
<?php } elseif($_SESSION['auth']['admin'] != 0) {?>
    <div class="formulaire">
      <a href="espaceAdmin.php"><input type="button" value="Espace Administrateur" ></a>
      <a href="deconnexion.php"><input type="button" value="Se déconnecter"></a>
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
        <center><h1 class="active">Salut <?php echo $_SESSION['auth']['pseudo'] ?>, bienvenue sur ton espace personnel !</h1> <br></center>

        <br>
        <br>
        <br>

        <center><div class="active">
          <br>
        <center><h2>Mes derniers commentaires : </h2> <br></center>

        <center><?php

          $q = $db->prepare('SELECT * FROM commentaires WHERE user_id=:user_id');
          $q->execute(['user_id' => $_SESSION['auth']['id']]);
          $res = $q->fetchAll();
          $n = $q->rowCount();


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
            echo "Animé : ".$res2['titre']."<br> Note : ".$ress['note']."/5 <br> Avis : ".$ress['avis']." <a href=\"suppression.php?commentaire=".$ress['commentaire_id']."\">Supprimer</a><br><br>";
          }

          $q = $db->prepare('SELECT * FROM commentaires_mangas WHERE user_id=:user_id');
          $q->execute(['user_id' => $_SESSION['auth']['id']]);
          $res = $q->fetchAll();

          $n2 = $q->rowCount();

          if ($n == 0 && $n2 == 0) {
            echo "Vous n'avez pas posté de commentaire.";
          }

          $res = array_reverse($res);
          $i = 0;

          foreach($res as $ress) {
              if ($i == 5) {
                  break;
              }
              $i++;
            $q = $db->prepare('SELECT titre FROM mangas WHERE id =:id');
            $q->execute(['id' => $ress['manga_id']]);
            $res2 = $q->fetch();
            echo "Mangas : ".$res2['titre']."<br> Note : ".$ress['note']."/5 <br> Avis : ".$ress['avis']." <a href=\"suppression.php?commentaireMangas=".$ress['commentaire_id']."\">Supprimer</a><br><br>";
          }
          ?></center>
          </div></center>


        
    </div>
</body>



</html>