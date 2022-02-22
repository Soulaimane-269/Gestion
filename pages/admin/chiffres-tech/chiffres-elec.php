<?php
//init
require"../../init.php";
require"../../header.php";

//connexion to db
require"../../connexiondb.php";
//init month
$month = (int)date("m");
if (isset($_POST['month'])){
    $month = ($_POST['month']);
};
//queries
$req= "SELECT sum(Rendezvous), sum(Accesible), sum(Grip) from comptelec where month(dateInter)=".$month."";
$exec = mysqli_query($conn,$req);
$res=mysqli_fetch_assoc($exec);
// output Variables
$Rendezvous = isset($res['sum(Rendezvous)']) ? $res['sum(Rendezvous)'] : 0;
$Accesible = isset($res['sum(Accesible)']) ? $res['sum(Accesible)'] : 0;
$Grip = isset($res['sum(Grip)']) ? $res['sum(Grip)'] : 0;
$TotalCmpt = $Rendezvous + $Accesible + $Grip ;
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
    <title>Chiffres Elec</title>
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
                echo"<br> Pour le mois de ".$monthName[$month]."" ;
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
                <td><?php echo $Rendezvous?></td>
                </tr>
                <tr>
                <th scope="row">Accesible</th>
                <td><?php echo $Accesible?></td>
                </tr>
                <tr>
                <th scope="row">Grip</th>
                <td ><?php echo $Grip?></td>
                </tr>
            </tbody>
            <!-- Tbody Tech page 2-->
            <tbody>
              <?php

              //la table
               $dbTable = "users";
               // tghe req to select the ids and the usernames
               $req = "SELECT id , userName FROM ".$dbTable." WHERE type='electricite'" ;

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
                <td><a href='chiffres-elec-details?id=".$id[$x]."&month=".$month."'>voir</a></td>
              </tr>";
              }
              ?>
            </tbody>
        </table>
    </div>
</body>
</html>