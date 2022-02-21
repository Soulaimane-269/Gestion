<?php require"../init.php" ?>
<?php require"../init.php"; 

session_start();

if(!isset($_SESSION["userName"]))
{
    header("location:../connexion.php");
}

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
       <a class="btn btn-primary" href="shift.php">mon shift</a>
       <a class="btn btn-primary" href="journal.php">mon journal</a>
   </div> 
   <div>
   <a href="../deconnexion.php">Déconnexion</a>
   </div>
</body>