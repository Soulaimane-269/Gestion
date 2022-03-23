<?php require"../init.php";

 //connection de la base de données 
   require"../connexiondb.php"; 

   session_start();
   if (!isset($_SESSION["userName"])){
    header("location:../index.php");
}
    //id
    $id=$_GET["id"];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="<?php echo $srcAdminTech ?>images/favicon.png"/>
        <title>Profil</title>
        <link href="<?php echo "$srcAdminTech"?>css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo"$srcAdminTech"?>css/main/main.css">
        <link href="<?php echo "$srcAdminTech"?>css/voir/voir.css" rel="stylesheet">
        
    </head>
    <body>
    <?php require"../header.php";?>
        <?php
        //the id
        $id=$_GET["id"];
        $req="SELECT * FROM users WHERE id= ".$id."";
        //the req
        $exec = mysqli_query($conn,$req);
        //the res
        $res = mysqli_fetch_assoc($exec);
        ?>
        <div class="container">
            <div class="headerHolder">
                <div class="iconHolder">
                    <img class="icon" src="<?php echo"$srcAdminTech"?>images/iconUserBlack.svg" alt="">
                </div>
                <h1 class="userName"><?php echo $res["userName"] ?></h1>
                <hr>
            </div>
            <div class="voirLeProfil">

            <?php
                    echo '
                        <h3 class="label">Nom: <span>'.$res["name"].'</span></h3>
                        <h3 class="label">Secteur: <span>'.$res["type"].'</span></h3>
                        <h3 class="label">identifiant: <span>'.$res["userName"].'</span></h3>
                    ';
                ?>
            </div>
            
            <?php
            // *************** delete request *******************

            if(isset($_POST["submit"])){
                $req ="DELETE FROM users WHERE id = ".$id."";
                $res = mysqli_query($conn,$req);
                header("refresh:2;url=gestion.php?deleted=1");
            }
            ?>
            <div class="linksHolder">
                <div>
                    <?php
                    // modify boutton
                        echo
                        "<a class='modifierBtn' href='modifier.php?id=".$id."'>modifier ce profil</a> ";
                    ?>
                </div>
                <div class="modal">
                        <div class="modal-dialog">
                          <div class="modal-content">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                <div class="modal-body">
                                <p>Voulez-vous vraiment supprimer ce profil?</p>
                                </div>
                                <form method="post" action="" >
                                <button name="submit" class="btn btn-primary button-green" type="submit">confirmer</button>   
                                </form> 
                          </div>
                        </div>
                </div>
                <div class="col-12">
                    <button class="supprimer">supprimer ce profil</button>
                </div>
            </div>
            <?php
            $verifier = (isset($_POST['submit']) ) ? 1 : 0;
            require"../load.php";
            ?>
        </div>
      
    </body> 
    <script  defer>
    supprimerBtn = document.querySelector('.supprimer');   
    closeBtn = document.querySelector('.btn-close');
    modal = document.querySelector('.modal');
    modal.addEventListener("click", function(){modal.style.display='none';});
    supprimerBtn.addEventListener("click", function(){modal.style.display='flex';});
    closeBtn.addEventListener("click", function(){modal.style.display='none';});
    </script>   
</html>    