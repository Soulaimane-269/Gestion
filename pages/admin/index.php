<?php 
require "../header.php";
require"../init.php";
require"../connexiondb.php";
session_start();
if(!isset($_SESSION["userName"]))
{
    header("location:connexion.php");
}

$userName=$_SESSION["userName"];
echo $userName;

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="<?php echo"$srcAdminTech"?>css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo"$srcPages"?>css/main.css">
        <link href="<?php echo"$srcAdminTech"?>css/accueil/accueil.css" rel="stylesheet">
        
    </head>
    <body>
        <div class="container">
            <!--premier boutton-->
            <div class="button-holder1">
                <div>
                    <a href="gestion-tech/gestion.php" type="button" class="button-accueil btn btn-primary btn-lg">Gestion des profils</a>
                </div>
            </div>
            <!--2eme boutton-->
            <div class="button-holder2">
                <div>
                    <a type="button" class="button-gaz button-gaz-chiffres btn btn-primary btn-lg" href="chiffres-tech/chiffres-gaz.php">gaz</a>
                    <a type="button" class="button-elec button-gaz-elec btn btn-secondary btn-lg" href="chiffres-tech/chiffres-elec.php">electicité</a>
                </div>
                <div>
                    <button type="button" class="button-accueil btn btn-primary btn-lg" >Chiffres et statistiques</button>
                </div>
            </div>
            <!--boutton deconnection-->
            <div>
            <a href="../deconnexion.php">Déconnexion</a>
            </div>
        </div>        
    </body>
</html>