<!DOCTYPE HTML>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Teko:wght@700&display=swap" rel="stylesheet">

<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Formulaire de Connexion</title>
        <link rel="stylesheet" media="screen" type="text/css" href="ismaconnexion.css">
    </head>

<body>
    <div class="corps">
        <video autoplay="autoplay" muted="" loop="infinite" src="/IO2/video/amv.mp4"></video>
        <div class="form-connexion">
        <center><a href="/IO2/index.html" ><img src="/IO2/image/logo.png" width=40% height=40%></a></center>
            <h1>Connexion</h1>
            <form method="post">
                <input type="text" name="pseudo" size="30" placeholder="Pseudo" class="i-box" required>
                <br><br>
                <input type="password" name="pwd" size="30" placeholder="Mot de Passe" class="i-box" required>
                <br><br>
                <input type="submit" name="formlogin" size="15" value="Connexion" class="buton">
                <br>
                <br>
                
                <div class="bouton-a">
                <a href="inscription.php">Je souhaite m'inscrire</a>
                </div>
                
            </form>
        </div>
    </div>

<?php

if(isset($_POST['formlogin'])) {
if ($_POST['pseudo'] != "" && $_POST['pwd'] != "") {
include 'database.php';
$q = $db->prepare("SELECT * FROM users WHERE pseudo = :pseudo");
$q->execute(['pseudo' => htmlspecialchars($_POST['pseudo'])]);
$res = $q->fetch();
if($res) {

if (password_verify(htmlspecialchars($_POST['pwd']), $res['password'])) {
session_start();
$_SESSION['connecté'] = 1;
header('Location: index.php');
echo "<p>Connexion réussie !</p><br>";
} else {
echo "<p>Mot de Passe incorrect</p><br>";
}
} else {
echo "<p>Ce compte n'existe pas</p><br>";
}
} else {
echo "<p>Veuillez completer l'ensemble des champs</p><br>";
}
}
?>
</body>


</html>