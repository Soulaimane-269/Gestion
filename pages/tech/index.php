<?php require"../init.php"; 
    

session_start();

if(!isset($_SESSION["userName"]) OR $_SESSION["type"] == "admin"  )
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
    <!-- CSS files -->
    <link rel="stylesheet" href="<?php echo"$srcAdminTech"?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo"$srcAdminTech"?>css/main/main.css">
    <link rel="stylesheet" href="<?php echo"$srcAdminTech"?>css/techAdmin/techAdmin.css">

    <title>Chiffres en détails</title>
</head>
<body>
    <?php require"../header.php";?>
   <div class="container">
       <div class="logoContainer">
           <img src="<?php echo"$srcAdminTech" ?>images/logo.svg" alt="">
       </div>
       <div class="linksContainer">
            <a class="btn btn-primary button-green" href="shift.php">Mon shift</a>
            <a class="btn btn-primary button-green" href="journal.php">Mon journal</a>
            <a class="btn btn-primary button-green" href="chiffres-mois.php" > Mes chiffres</a>
       </div>
       <div>
            <a href="../deconnexion.php">Déconnexion</a>
       </div>
       <?php
       if(isset($_GET['succes'])){
        echo'
        <div class="modal">
            <div class="modal-dialog">
              <div class="modal-content">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                  <p>Vos données ont été bien sauvegardées.</p>
                </div>
              </div>
            </div>
        </div>';
        }
       ?>
   </div> 
<script>
closeBtn = document.querySelector('.btn-close');
modal = document.querySelector('.modal');
closeBtn.addEventListener("click", function(){modal.style.display='none';});
modal.addEventListener("click", function(){modal.style.display='none';});
</script>
</body>