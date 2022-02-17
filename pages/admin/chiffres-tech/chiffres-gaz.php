<?php
//init
require"../../init.php";
require"../../header.php";

//connection de la base de données 
require"../../connexiondb.php";
$month = date("Y-m");
if (isset($_POST['month'])){
$month = ($_POST['month']);
echo $month;
echo 'hey';
};
echo $month;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS files -->
    <link rel="stylesheet" href="<?php echo"$srcGestionChiffres"?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo"$srcGestionChiffres"?>css/main.css">
    <link rel="stylesheet" href="<?php echo"$srcGestionChiffres"?>css/chiffres/chiffres.css">
    <title>Chiffres Gaz</title>
</head>
<body>
    <div class="container">
        <!-- header -->
        <div class="head">
         <div>
            <form method="post" action="">
                <input  type="month" name="month">
                <button type="submit" name="submit">submit</button>
            </form>    
            </div>
            
        </div>
        <!-- Main Table -->
        <table class="table table-striped">
        <div class="flex">
        <button class="btn  btn-lg col-5">Tous</button>
        <button class="btn  btn-lg col-5">Chiffre par technicien</button>
        </div>
            <tbody>
                <tr>
                <th scope="row">Totale des Compteures</th>
                <td>451</td>
                </tr>
                <tr>
                <th scope="row">Avec rendez-vous</th>
                <td>319</td>
                </tr>
                <tr>
                <th scope="row">Grip</th>
                <td >23</td>
                </tr>
                <tr>
                <th scope="row">Accessible</th>
                <td >20</td>
                </tr>
            </tbody>
            <!-- Tbody Tech -->
            <tbody>
              <?php

              //la table
               $dbTable = "users";
               // tghe req to select the ids and the usernames
               $req = "SELECT id , userName FROM ".$dbTable." WHERE type='gaz'" ;

               // query execution
               $results = mysqli_query($conn,$req);
               
               // array to store usersName
               $usersName = array();

               while( $row = mysqli_fetch_array($results) ){
                 //storing the username
                $usersName[] = $row['userName'];
                //sroring the id
                $id[]= $row['id'];
               };
                  
               // the loop
               for($x = 0 ; $x < count($usersName) ; $x++){
                 echo"
              <tr>
                <td>".$usersName[$x]."</td>
                <td><a href='chiffres-gaz-details?id=".$id[$x]."'>voir</a></td>
              </tr>";
              }
              ?>
            </tbody>
        </table>
    </div>
</body>
</html>