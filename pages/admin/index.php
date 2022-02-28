<?php 
require "../header.php";
require"../init.php";
require"../connexiondb.php";
session_start();
if(!isset($_SESSION["userName"]) OR $_SESSION["type"] !== "admin" )
{
    header("location:../connexion.php");
}
$userName=$_SESSION["userName"];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="<?php echo"$srcAdminTech"?>css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo"$srcPages"?>css/main/main.css">
        <link href="<?php echo"$srcAdminTech"?>css/techAdmin/techAdmin.css" rel="stylesheet">
        
    </head>
    <body>
   <div class="container">
       <div class="logoContainer">
           <img src="<?php echo"$srcAdminTech" ?>images/logo.svg" alt="">
       </div>
       <div class="linksContainer">
           <button class="btn btn-primary button-green" id="chiffre" >Chiffres</button>
           <div class="twoButtonsHolder">
               <a type="button" class="button-gaz button-gaz-chiffres btn btn-primary btn-lg" href="chiffres-gaz.php">Gaz</a>
               <a type="button" class="button-elec button-gaz-elec btn btn-secondary btn-lg" href="chiffres-elec.php">Électricité</a>
            </div>
            <a class="btn btn-primary button-green" href="gestion.php">Gestion</a>
       </div>
       <div>
       <a href="../deconnexion.php">Déconnexion</a>
       </div>
   </div>
</body>
<script>
   const chiffre = document.getElementById("chiffre");
const btnGaz = document.querySelector(".button-gaz");
const btnElec = document.querySelector(".button-elec");

chiffre.addEventListener("click", function(){
    chiffre.classList.toggle("chiffre");
    btnGaz.classList.toggle("btn-gaz-active");
    btnElec.classList.toggle("btn-elec-active");
});

</script>
</html>