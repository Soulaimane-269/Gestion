<?php
//init
require"../init.php";

//connexion to db
require"../connexiondb.php";
session_start();
if (!isset($_SESSION["userName"])){
    header("location:../index.php");
}elseif( $_SESSION["idUser"] == 29){ header("location:index.php");}
//init month
$month = (int)date("m");
if (isset($_POST['month'])){
    $month = ($_POST['month']);
};
// init montant Totale
$montantTotale = 0;
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
    <title>Dépenses</title>
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
                }
                    echo '<button class="button-green btn btn-primary" type="submit" name="submit"><i class="fa-solid fa-magnifying-glass"></i></button>';
                    
                    ?>
                </form> 
            </div>   
        </div>
        <div>                
         <?php 
            // echo"<h5> ".$monthName[$month]."</h5>";
            ?> 
        </div>
        <div>       
            <table class="table table-hover  ">
                <thead>
                    <th scope="col">Nom</th>
                    <th scope="col">Montant</th>
                    <th scope="col" style="padding-left: 24px;">Détails</th>
                </thead>
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
                    //queries
                        $req= "SELECT SUM(montantFacture) FROM facture WHERE idUser = ".$id[$x]." AND MONTH(dateFacture) = ".$month." ";
                        $exec = mysqli_query($conn,$req);
                        $res=mysqli_fetch_assoc($exec);
                        $montantFacture = isset($res['SUM(montantFacture)']) ? $res['SUM(montantFacture)'] : 0;
                        $montantTotale += $montantFacture;
                    echo"
                    <tr>
                        <th scope='row'><h4 class='userName'>".$usersName[$x]."</h4></th>
                        <td class='text-center'> <h4 class='userName'> ".$montantFacture." € <h4/> </td>
                        <td class='text-center'><a class='voir' href='depense-details.php?id=".$id[$x]."&month=".$month."'>détails</a></td>
                    </tr>";
                };
                ?>
                <tr>
                    <th>Total des dépenses</th>
                    <td colspan="2"><div style="text-align:center; "><?php  echo $montantTotale; ?> €</div></td>
                </tr>
                </tbody>
            </table>
           
        </div> 
    </div>
</body>
</html>