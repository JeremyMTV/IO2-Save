<!DOCTYPE html>
<html lang="fr">
<meta charset="UTF-8" />

<head>
    <link rel="stylesheet" href="../css/style.css">
    <title>Nakama San</title>
    <link rel="icon" type="image/png" href="../image/logo.png">
</head>


<!-- Style pour la barre de recherche -->

<style>
    .heros {
    height: 10vh;
    display: flex;
    align-items: center;
    position: relative  ;
    top: 5%;
    left: 82.5%;
    transform: translate(-50%,-50%);
  }
  .heros h1 {
    font-weight: 800;
    font-size: 4em;
    margin-bottom: 80px;
  }
  .heros form {
    position: relative;
    z-index: 600;
  }
  .heros form .input {
    display: flex;
    height: 120px;
    width: 110%;
    box-shadow: 0 30px 50px rgba(255, 255, 255, 0.753)
  }
  .heros form .input input {
    width: calc(100% - 120px);
    border: none;
    padding: 0 32px;
    font-family: "Roboto Mono", monospace;
    font-size: 1.2em;
    font-weight: 600;
    outline: none;
  }
  .heros form .input button {
    width: 120px;
    height: 120px;
    background: #8DBE77;
    border: none;
    font-family: "Roboto Mono", monospace;
    font-size: 2em;
    cursor: pointer;
    flex-shrink: 0;
    font-weight: 800;
    position: relative;
    transition: 0.4s;
  }
  .heros form .input button span {
    position: relative;
    z-index: 2;
  }
  .heros form .input button::after {
    content: "";
    width: 100%;
    height: 0;
    background: rgb(216, 230, 24);
    display: block;
    position: absolute;
    bottom: 0;
    left: 0;
    z-index: 0;
    transition: 0.4s;
  }
  .heros form .input button:hover {
    color: #fff;
  }
  .heros form .input button:hover::after {
    height: 100%;
  }
  .heros .left {
    flex: 3;
  }
</style>


<?php
 
 $bdd = new PDO('mysql:host=127.0.0.1;dbname=test;charset=utf8','root','');
  
 $anime = $bdd->query('SELECT titre FROM animes ORDER BY id DESC');
 $synop = $bdd->query('SELECT synopsis FROM animes ORDER BY id DESC');
 if(isset($_POST['recherche']) AND !empty($_POST['recherche'])) {
    $recherche = htmlspecialchars($_POST['recherche']);
    $anime = $bdd->query('SELECT titre FROM animes WHERE titre LIKE "%'.$recherche.'%" ORDER BY id DESC');
    $synop = $bdd->query('SELECT synopsis FROM animes WHERE synopsis LIKE "%'.$recherche.'%" ORDER BY id DESC');
    if($anime->rowCount() == 0 AND $synop->rowCount() == 0) {
       $anime = $bdd->query('SELECT titre FROM animes WHERE CONCAT(titre, synopsis) LIKE "%'.$recherche.'%" ORDER BY id DESC');
       $synop = $bdd->query('SELECT synopsis FROM animes WHERE CONCAT(titre, synopsis) LIKE "%'.$recherche.'%" ORDER BY id DESC');
    }
 }
 
?>

<header>
    <div class="container" onclick="myFunction(this)">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
    </div>

    <center><a href="../index.php"><img src="..\image\Nakama San2.png" width=20% height=40%></a></center>
    
    <!-- <div class="header-message">
        <a href="=#default" class="logo">Anime</a>
    </div> -->

 
</header>

<script>
    function myFunction(x) {
        x.classList.toggle("change");
    }
</script>

<body>
    <div class="corps"> 
    <br>
    <div class="heros container">
        <br>
        <br>
    <center><div class="left">
              <form action="recherche.php" method="post">
                <div class="input">
                  <input type="text" name="recherche" placeholder="Trouve ton coup de coeur">
                  <button type="submit"><span>Go</span></button>
                </div>
              </form>
            </div></center>
    </div>

            <br>
            
    <!-- <center><h1 class="active">Vous avez recherché :  <?php echo $_POST['recherche']; ?></h1></center> -->
    <br>
    <br>
    <div class="conteneur">
    <?php if(empty($_POST['recherche'])) { ?>
        <ul>
            <br>
            <center><h1 class="active">Vous n'avez rien saisi, recommencez !</h1></center>
    <?php } elseif($anime->rowCount() > 0) { ?>
        <ul>
        <?php while($a = $anime->fetch() AND $b = $synop->fetch()) { ?>
            <br>
            <h1 class="active"><?= $a['titre'] ?></h1>
            <br>
            <p><?= $b['synopsis'] ?></p>
            <br>
        <?php } ?>
        </ul>
    <?php } else { ?>
        <center><h1 class="active">Aucun résultat pour: <?= $recherche ?>...</h1></center>
    <?php } ?>
    </div>
        <video autoplay="autoplay" muted="" loop="infinite" src="../video/amv.mp4"></video>
        
    </div>
</body>

</html>