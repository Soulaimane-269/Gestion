<?php 
require"../init.php";
require"../connexiondb.php";
session_start();
if(!isset($_SESSION["userName"]) OR $_SESSION["type"] !== "admin" )
{
    header("location:../index.php");
}
$userName=$_SESSION["userName"];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="<?php echo $srcAdminTech ?>images/favicon.png"/>
        <title>Accueil</title>
        <link href="<?php echo"$srcAdminTech"?>css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo"$srcPages"?>css/main/main.css">
        <link href="<?php echo"$srcAdminTech"?>css/techAdmin/techAdmin.css" rel="stylesheet">
        
    </head>
    <body>
<?php require "../header.php"; ?>
   <div class="container">
       <div class="logoContainer">
           <img src="<?php echo"$srcAdminTech" ?>images/logo.svg" alt="">
       </div>
       <div class="linksContainer">
           <button class="btn btn-primary button-green" id="chiffre" >Suivi</button>
           <div class="twoButtonsHolder">
               <a type="button" class="button-gaz button-gaz-chiffres" href="chiffres-gaz.php">Gaz</a>
               <a type="button" class="button-elec button-gaz-elec" href="chiffres-elec.php">Électricité</a>
            </div>
            <a class="btn btn-primary button-green" href="gestion.php">Gestion</a>
            <?php if($_SESSION['idUser'] != 29) echo '<a class="btn btn-primary button-green" style="margin-top:0" href="depense.php">Dépenses</a>'?>    
        </div>
       
       <div class="linkHolder">
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