<?php require"../init.php" ?>
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
    <link rel="stylesheet" href="<?php echo"$srcAdminTech"?>css/main.css">
    <title>Chiffres en détails</title>
</head>
<body>
   <div class="container">
       <a class="btn btn-primary" href="shift.php">Mon shift</a>
       <a class="btn btn-primary" href="journal.php">Mon journal</a>
       <a class="btn btn-primary" href="chiffres-mois.php" > Mes chiffres</a>
   </div> 
   <div>
   <a href="../deconnexion.php">Déconnexion</a>
   </div>
</body>