<?php
//init
require"../init.php";
//connexion to db
require"../connexiondb.php";
session_start();
if (!isset($_SESSION["userName"])){
    header("location:../index.php");
}
//init month
$month = (int)date("m");
if (isset($_POST['month'])){
    $month = ($_POST['month']);
};
//queries
$req= "SELECT sum(`Rendez-vous`), sum(`Accessible`), sum(`Grip`) from comptelec where month(dateInter)=".$month."";
$exec = mysqli_query($conn,$req);
$res=mysqli_fetch_assoc($exec);
// output Variables
$Rendezvous = isset($res['sum(`Rendez-vous`)']) ? $res['sum(`Rendez-vous`)'] : 0;
$Accesible = isset($res['sum(`Accessible`)']) ? $res['sum(`Accessible`)'] : 0;
$Grip = isset($res['sum(`Grip`)']) ? $res['sum(`Grip`)'] : 0;
$TotalCmpt = $Rendezvous + $Accesible + $Grip ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo $srcAdminTech ?>images/favicon.png"/>
    <!-- CSS files -->
    <link rel="stylesheet" href="<?php echo"$srcAdminTech"?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo"$srcAdminTech"?>css/main/main.css">
    <link rel="stylesheet" href="<?php echo"$srcAdminTech"?>css/chiffres/chiffres.css">
    <script type="text/javascript" src="<?php echo "$srcAdminTech"?>js/toggle-page.js" defer ></script>
    <title>Chiffres Eléctricité</title>
</head>
<body>
    <?php require"../header.php";?>
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
                    echo '<button class="button-green btn btn-primary" type="submit" name="submit"><i class="fa-solid fa-magnifying-glass"></i></button>';
                    }; 
                    ?>
                </form> 
            </div>   
        </div>
        <div>                
        <?php 
            if($monthName[$month]=== 'Avril' OR $monthName[$month]=== 'Aôut' ) echo"<h5> Pour le mois d'".$monthName[$month]."<h5/>";
            else echo"<h5> Pour le mois de ".$monthName[$month]."<h5/>"; ?>
        </div>
        <div class="flex">
            <button class="button1 btn btn-lg col-5 activeBtn">Tous</button>
            <button class="button2 btn btn-lg col-5">Par tech</button>
        </div>
        <!-- Main Table -->
        <div  class="page1">
            <table class="table table-striped">
                <tbody>
                    <tr>
                    <th scope="row"> <h6> Totale des Compteures</h6></th>
                    <td><?php echo $TotalCmpt?></td>
                    </tr>
                    <tr>
                    <th scope="row"><h6>Rendez-vous</h6></th>
                    <td><?php echo $Rendezvous?></td>
                    </tr>
                    <tr>
                    <th scope="row"><h6>Accesible</h6></th>
                    <td><?php echo $Accesible?></td>
                    </tr>
                    <tr>
                    <th scope="row"><h6>Grip</h6></th>
                    <td ><?php echo $Grip?></td>
                    </tr>
                </tbody>    
            </table>
        </div>    
            <!-- Tbody Tech page 2-->
        <div class="page2 hidden">   
            <table class="table table-hover">   
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
                    <td><h4 class='userName'>".$usersName[$x]."</h4></td>
                    <td><a class='voir' href='chiffres-elec-details.php?id=".$id[$x]."&month=".$month."'>chiffres</a></td>
                </tr>";
                }
                ?>
                </tbody>
            </table>
        </div> 
    </div>
</body>
</html>