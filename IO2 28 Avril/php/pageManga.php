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
display: inline-block !important;
vertical-align: middle;
float: none;
margin:30px;
}

.droite{
  float:left;
  padding : 1%;
}

.active .supp .nommer .ajouterA .ajouterM .Signaler{
  display: inline-block !important;
  vertical-align: middle;
  float:none;
}
</style>


<?php
  
require_once 'database.php';
  
 $manga = $db->query('SELECT titre FROM mangas ORDER BY id DESC');
 $synop = $db->query('SELECT synopsis FROM mangas ORDER BY id DESC');
 $img = $db->query('SELECT image FROM mangas ORDER BY id DESC');
 
?>

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
      <a href="../page de connexion/PageInscription.php"><input type="button" value="S'inscrire"></a>
      <a href="../page de connexion/connexion1.php"><input type="button" value="Se connecter"></a>
     </div>
<?php } else {?>
    <div class="formulaire">
      <a href="pageProfile.php"><input type="button" value=<?php echo $_SESSION['auth']['pseudo'] ?> ></a>
      <a href="deconnexion.php"><input type="button" value="Se déconnecter"></a>
    </div>
<?php } ?>
 
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
    <br>
    <br>
    
    <?php if($manga->rowCount() > 0) { ?>
        <?php while($a = $manga->fetch() AND $b = $img->fetch()) { ?>
            <div class="active">
            <div class="ajouterM">
            <center><h1 class="ac"><?= $a['titre'] ?></h1></center>
            <br>
            <center><img src=<?php echo $b['image'] ?> width=60% height=40%></center>
            <br>
            </div>
            </div>
        <?php } ?> 
    <?php } ?>
        <video autoplay="autoplay" muted="" loop="infinite" src="../video/amv.mp4"></video>
    </div>
</body>



<!-- <footer>
  <br>
  <br>
  <br>
  <br>
</footer> -->

</html>