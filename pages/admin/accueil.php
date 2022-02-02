<?php 
require"../init.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="<?php echo"$srcAdminTech"?>css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo"$srcAdminTech"?>css/accueil/accueil.css" rel="stylesheet">
        
    </head>
    <body>
        <div class="container">
            <div class="button-holder1">
                <div>
                    <a href="gestion-tech/gestion.php" type="button" class="button-gaz boutton-gaz-getion btn btn-primary btn-lg">gaz</a>
                    <a type="button" class="button-elec boutton-elec-gestion btn btn-secondary btn-lg">electicité</a>
                </div>
                <div>
                    <button type="button" class="button-accueil btn btn-primary btn-lg">Gestion des profils</button>
                </div>
            </div>
            <div class="button-holder2">
                <div>
                    <a type="button" class="button-gaz button-gaz-chiffres btn btn-primary btn-lg">gaz</a>
                    <a type="button" class="button-elec button-gaz-elec btn btn-secondary btn-lg">electicité</a>
                </div>
                <div>
                    <button type="button" class="button-accueil btn btn-primary btn-lg" >Chiffres et statistiques</button>
                </div>
            </div>
        </div>        
    </body>
</html>