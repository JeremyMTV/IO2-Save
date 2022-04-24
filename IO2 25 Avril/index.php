<!DOCTYPE html>
<html lang="fr">


<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/IO2/css/style.css">
    <title>Nakama San</title>
    <link rel="icon" type="image/png" href="../IO2/image/logo.png">

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
</style>
</head>



<header>
    <div class="container" onclick="myFunction(this)">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
    </div>

<?php 
require_once 'php/database.php';
require_once 'php/verifConnexion.php';
if(!estConnecte()){?>
    <div class="formulaire">
      <a href="../IO2/page de connexion/PageInscription.html"><input type="button" value="S'inscrire"></a>
      <a href="../IO2/page de connexion/pagedeconnexion.html"><input type="button" value="Se connecter"></a>
     </div>
<?php } else {?>
    <div class="formulaire">
      <a href="pageprofile.php"><input type="button" value=<?php echo $_SESSION['auth']['pseudo'] ?> ></a>
      <a href="#"><input type="button" value="Se déconnecter"></a>
<?php } ?>

   <center><a href="../IO2/index.php" ><img src="../IO2/image/Nakama San2.png" width=20% height=40%></a></center>

   
   
   
  </header>




<script>
    function myFunction(x) {x.classList.toggle("change");}
</script>


<body>
    <div class="corps"> 
        <video autoplay="autoplay" muted="" loop="infinite" src="../IO2/video/amv.mp4"></video>
        <div class="hero container">

            <div class="left">
              <form action="../IO2/php/recherche.php" method="post">
                <div class="input">
                  <input type="text" name="recherche" placeholder="Trouve ton coup de coeur">
                  <button type="submit"><span>Go</span></button>
                </div>
              </form>
            </div>
        
            <div class="right">
                
              <section  class="box1">
                <div class="content">
                  <h2>Les Animés</h2>
                  <h3>100<span>topics</span></h3>
                </div>
              </section>
              

              <section class="box2">
                <div class="content">
                  <h2>Les Mangas</h2>
                  <h3>100<span>topics</span></h3>
                </div>
              </section>
              
        
              
              <section class="box3">
                <div class="content">
                  <h2>Vos Avis</h2>
                  <h3>100<span>topics</span></h3>
                </div>
              </section>
              

            </div>
          </div>
    </div>
</body>


<footer>
        <!-- <div class="row">
            <div class="large-12 columns">
                <div class="row">
                    <div class="large-8 columns">
                        <ul class="social">
                            <li class="twitter"><a href="https://twitter.com/Jeremy_MTV">Follow us on Twitter</a></li>
                            <li class="facebook"><a href="https://www.facebook.com/jeremy.mootooveeren">Like us on Facebook</a></li>
                        </ul>

                        <ul class="inline-list">
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                    <div class="large-4 columns">
                        <p class="text-right">WebSite by <a href="https://www.instagram.com/jeremy_mtv_"> Jeremy</a></p>
                    </div>
                </div>
            </div>
        </div> -->
</footer>

</html>