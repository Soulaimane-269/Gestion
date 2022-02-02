<?php require"../../init.php" ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="<?php echo "$srcGestionChiffres"?>css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo "$srcGestionChiffres"?>css/voir/voir.css" rel="stylesheet">
        
    </head>
    <body>
        <div class="voir-le-profil">
            <h1>Nom: <span>XXX</span></h1>
            <h1>Secteur: <span>XXX</span></h1>
            <h1>identifiant: <span>XXX</span></h1>
        </div>
        <div>
            <a href="modifier-le-profil.php">modifier ce profil</a>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit">supprimer profil</button>
        </div>
    </body>    
</html>    