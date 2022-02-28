<?php
//init
require"../init.php";
require"../header.php";

//connexion to db
require"../connexiondb.php";
//init month
$month = (int)date("m");
if (isset($_POST['month'])){
    $month = ($_POST['month']);
};
//queries
$req= "SELECT sum(Rendez_vous), sum(Sans_rendez_vous), sum(Module) , sum(Detendeur) from comptegaz where month(dateInter)=".$month."";
$exec = mysqli_query($conn,$req);
$res=mysqli_fetch_assoc($exec);
// output Variables
$Rendez_vous = isset($res['sum(Rendez_vous)']) ? $res['sum(Rendez_vous)'] : 0;
$Sans_rendez_vous = isset($res['sum(Sans_rendez_vous)']) ? $res['sum(Sans_rendez_vous)'] : 0;
$Module = isset($res['sum(Module)']) ? $res['sum(Module)'] : 0;
$Detendeur = isset($res['sum(Detendeur)']) ? $res['sum(Detendeur)'] : 0;
$TotalCmpt = $Rendez_vous + $Sans_rendez_vous + $Module + $Detendeur ;
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
    <link rel="stylesheet" href="<?php echo"$srcAdminTech"?>css/chiffres/chiffres.css">
    <script type="text/javascript" src="<?php echo "$srcAdminTech"?>js/toggle-page.js" defer ></script>
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
                    echo '<button class="button-green btn btn-primary" type="submit" name="submit">rechercher</button>';
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
        <div class="page1">
            <table class="table table-striped">
                <tbody >
                    <tr >
                    <th scope="row"><h6>Totale des Compteures</h6></th>
                    <td><?php echo $TotalCmpt?></td>
                    </tr>
                    <tr>
                    <th scope="row"> <h6> Avec rendez-vous</h6></th>
                    <td><?php echo $Rendez_vous?></td>
                    </tr>
                    <tr>
                    <th scope="row"><h6>Sans rendez-vous</h6></th>
                    <td><?php echo $Sans_rendez_vous?></td>
                    </tr>
                    <tr>
                    <th scope="row"><h6>Module</h6></th>
                    <td ><?php echo $Module?></td>
                    </tr>
                    <tr>
                    <th scope="row"><h6>Grip</h6></th>
                    <td ><?php echo $Detendeur?></td>
                    </tr>
                </tbody>
            </table>
        </div>        
            <!-- Tbody Tech page 2-->

        <div class="page2 hidden">       
            <table class="table table-hover ">
                <tbody >
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
                    <td><h4 class='userName'>".$usersName[$x]."</h4></td>
                    <td><a class='voir' href='chiffres-gaz-details.php?id=".$id[$x]."&month=".$month."'>chiffres</a></td>
                </tr>";
                }
                ?>
                </tbody>
            </table>
        </div> 
    </div>
</body>
</html>