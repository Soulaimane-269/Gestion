<?php require"../../init.php";
  require"../../header.php";

 //connection de la base de données 
   require"../../connexiondb.php"; 


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="<?php echo "$srcGestionChiffres"?>css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo"$srcGestionChiffres"?>css/main.css">
        <link href="<?php echo "$srcGestionChiffres"?>css/voir/voir.css" rel="stylesheet">
        
    </head>
    <body>
        <div class="container">
            <div class="voir-le-profil">
                <?php
                    //the id
                    $id=$_GET["id"];
                    $req="SELECT * FROM users WHERE id= ".$id."";
                    //the req
                    $exec = mysqli_query($conn,$req);
                    //the res
                    $res = mysqli_fetch_assoc($exec);

                    echo '
                        <h1>Nom: <span>'.$res["name"].'</span></h1>
                        <h1>Secteur: <span>'.$res["type"].'</span></h1>
                        <h1>identifiant: <span>'.$res["userName"].'</span></h1>
                    ';
                ?>
            </div>
            <div>
                <?php
                //modify boutton
                    echo
                    "<a href='modifier.php?id=".$id."'>modifier ce profil</a> ";
                ?>
            </div>
            <div class="col-12">
                <a class="btn btn-primary" href="<?php echo"supprimer.php?id=".$id.""?>">supprimer ce profil</a>
            </div>
        </div>
    </body>    
</html>    