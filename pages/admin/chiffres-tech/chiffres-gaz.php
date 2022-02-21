<?php
//init
require"../../init.php";
require"../../header.php";

//connexion to db
require"../../connexiondb.php";
$month = 3;
if (isset($_POST['month'])){
    $month = ($_POST['month']);
};
//queries
$req= "SELECT sum(Rendez_vous), sum(Sans_rendez_vous), sum(Module) , sum(Detendeur) from comptegaz where month(dateInter)=".$month."";
$exec = mysqli_query($conn,$req);
$res=mysqli_fetch_assoc($exec);
// output Variables
$Rendez_vous = $res['sum(Rendez_vous)'];
$Sans_rendez_vous = $res['sum(Sans_rendez_vous)'];
$Module = $res['sum(Module)'];
$Detendeur = $res['sum(Detendeur)'];
$TotalCmpt = $Rendez_vous + $Sans_rendez_vous + $Module + $Detendeur ;
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
                <?php
                $monthName = array(0,'Janvier','Février','Mars','Avril' ,'Mai' ,'Juin','Juillet','Aôut','Septembre','Octbre','Novembre','Décembre');
                $monthOut=1;
                if(isset($month)){ 
                    echo'<select name="month" >';
                    for($monthOut=1 ; $monthOut<= 12 ; $monthOut++){
                    echo'
                    <option ';
                    if ($monthOut == $month)
                    {
                        print"selected ";
                    };
                    echo 'value="'.$monthOut.'" >'.$monthName[$monthOut].'</option>';                   
                };
                echo'</select>';
                echo '<button class="btn btn-primary" type="submit" name="submit">submit</button>';
                };
                echo"<br> Pour le mois de ".$monthName[$month]."" 
                ?>
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
                <td><?php echo $TotalCmpt?></td>
                </tr>
                <tr>
                <th scope="row">Avec rendez-vous</th>
                <td><?php echo $Rendez_vous?></td>
                </tr>
                <tr>
                <th scope="row">Sans rendez-vous</th>
                <td><?php echo $Sans_rendez_vous?></td>
                </tr>
                <tr>
                <th scope="row">Module</th>
                <td ><?php echo $Module?></td>
                </tr>
                <tr>
                <th scope="row">Grip</th>
                <td ><?php echo $Detendeur?></td>
                </tr>
            </tbody>
            <!-- Tbody Tech page 2-->
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