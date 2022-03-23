<?php
require"init.php" ;

require"connexiondb.php";
session_start();
session_destroy();
header("refresh:2;url=index.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="icon" href="<?php echo $srcPages ?>images/favicon.png"/>
      <title>Déconnexion</title>
      <link href="<?php echo"$srcPages"?>css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="<?php echo"$srcPages"?>css/main/main.css">
      <link href="<?php echo"$srcPages"?>css/load/load.css" rel="stylesheet"> 
</head>
<body>
      <div class="container" style="min-height:100vh">
      <div class="loaderContainer">
            <div class="loader">
                  <div class="inner one"></div>
                  <div class="inner two"></div>
                  <div class="inner three"></div>
            </div>
      </div> 
      </div> 
      
</body>
</html>