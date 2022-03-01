<?php require"../init.php" ;
      require"../connexiondb.php";
session_start();
header('Refresh:3 ; URL=index.php?succes=1'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <link href="<?php echo"$srcAdminTech"?>css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="<?php echo"$srcAdminTech"?>css/main/main.css">
      <link href="<?php echo"$srcAdminTech"?>css/rederiger/rederiger.css" rel="stylesheet"> 
</head>
<body>
      <?php require"../header.php";?>
      <div class="container">
            <div class="loader">
                  <div class="inner one"></div>
                  <div class="inner two"></div>
                  <div class="inner three"></div>
            </div>
      </div>  
      
</body>
</html>