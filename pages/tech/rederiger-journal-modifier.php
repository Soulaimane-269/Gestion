<?php require"../init.php" ;
      require"../header.php";
      require"../connexiondb.php";
$date = $_GET['date'];
header('Refresh:2 ; URL=journal-modifier.php?date='.$date.''); 
echo"modifications enregister. <br> patientez... "  ;

      
