<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/IO2/css/style.css">
    <title>Website Of Jeremy</title>
</head>

<?php 

session_start();

/* fonction pour visiteur */
if(isset($_SESSION["count"])){
    $_SESSION['count']++;
}else{
    $_SESSION['count']=0; 
}

?>

<!-- <div class="right">
    <a class="active" href="#seconnecter"> Se Connecter</a>
    <a href="#s'inscire">S'inscire</a>
 </div> -->


<header>
    <div class="container" onclick="myFunction(this)">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
    </div>

    <center><a href="/IO2/index.html"><img src="/IO2/image/Nakama San2.png" width=20% height=40%></a></center>
    
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
    <center><h1 class="active">Vous avez recherché :  <?php  echo $_POST["recherche"]; ?></h1></center>

        <video autoplay="autoplay" muted="" loop="infinite" src="/IO2/video/amv.mp4"></video>
        
    </div>
</body>


<footer>
<h1>Vous avez visité la page : <?php echo $_SESSION['count'] ?> </h1>

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