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
// Dates
$dateFrom= isset($_POST['dateFrom']) ? $_POST['dateFrom'] : date('Y-m-d');
$dateTo= isset($_POST['dateTo']) ? $_POST['dateTo'] : date('Y-m-d');
//get columns names
$req = "SHOW COLUMNS FROM comptegaz" ;
// query execution
  $results = mysqli_query($conn,$req);
 // array to store columns names
 $columnName = array();
                    
 while( $row = mysqli_fetch_array($results) ){
     $columnName[] = $row['Field'] ;
     };
//queries
$req= "SELECT SUM(`".$columnName[2]."`), SUM(`".$columnName[3]."`), SUM(`".$columnName[4]."`) , SUM(`".$columnName[5]."`), SUM(`".$columnName[6]."`), SUM(`".$columnName[7]."`), SUM(`".$columnName[8]."`), SUM(`".$columnName[9]."`) FROM comptegaz WHERE dateInter >= '".$dateFrom."' AND dateInter <= '".$dateTo."'";
$exec = mysqli_query($conn,$req);
$res=mysqli_fetch_assoc($exec);
// output Variables
$champ1 = isset($res['SUM(`'.$columnName[2].'`)']) ? $res['SUM(`'.$columnName[2].'`)'] : 0;
$champ2 = isset($res['SUM(`'.$columnName[3].'`)']) ? $res['SUM(`'.$columnName[3].'`)'] : 0;
$champ3 = isset($res['SUM(`'.$columnName[4].'`)']) ? $res['SUM(`'.$columnName[4].'`)'] : 0;
$champ4 = isset($res['SUM(`'.$columnName[5].'`)']) ? $res['SUM(`'.$columnName[5].'`)'] : 0;
$champ5 = isset($res['SUM(`'.$columnName[6].'`)']) ? $res['SUM(`'.$columnName[6].'`)'] : 0;
$champ6 = isset($res['SUM(`'.$columnName[7].'`)']) ? $res['SUM(`'.$columnName[7].'`)'] : 0;
$champ7 = isset($res['SUM(`'.$columnName[8].'`)']) ? $res['SUM(`'.$columnName[8].'`)'] : 0;
$champ8 = isset($res['SUM(`'.$columnName[9].'`)']) ? $res['SUM(`'.$columnName[9].'`)'] : 0;
$TotalCmpt = $champ1 + $champ2 + $champ3 + $champ4 + $champ5 + $champ6 + $champ7 + $champ8 ;
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
    <title>Gaz</title>
</head>
<body>
    <?php require"../header.php";?>
    <div class="container">
        <!-- header -->
        <div class="head">
            <div>
                <form method="post" action="">
                    <input type="date" name="dateFrom" value="<?php echo $dateFrom; ?>">
                    <input type="date" name="dateTo" value="<?php echo $dateTo; ?>">
                    <?php
                    // $monthName = array(0,'Janvier','Février','Mars','Avril' ,'Mai' ,'Juin','Juillet','Aôut','Septembre','Octbre','Novembre','Décembre');
                    // $monthOut=1;
                    // if(isset($month)){ 
                    //     echo'<select name="month" >';
                    //     for($monthOut=1 ; $monthOut<= 12 ; $monthOut++){
                    //     echo'
                    //     <option ';
                    //     if ($monthOut == $month)
                    //     {
                    //         print"selected ";
                    //     };
                    //     echo 'value="'.$monthOut.'" >'.$monthName[$monthOut].'</option>';                   
                    // };
                    // echo'</select>';
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
         <div class="flex">
            <button class="button1 btn btn-lg col-5 activeBtn">Tous</button>
            <button class="button2 btn btn-lg col-5">Par technicien</button>
          </div>
        <!-- Main Table -->
        <div class="page1">
            <table class="table table-striped">
                <tbody >
                    <tr >
                    <th scope="row"><h6>Total compteurs</h6></th>
                    <td><?php echo $TotalCmpt?></td>
                    </tr>
                    <tr>
                    <th scope="row"> <h6><?php echo $columnName[2]?></h6></th>
                    <td><?php echo $champ1?></td>
                    </tr>
                    <tr>
                    <th scope="row"><h6><?php echo $columnName[3]?></h6></th>
                    <td><?php echo $champ2?></td>
                    </tr>
                    <tr>
                    <th scope="row"><h6><?php echo $columnName[4]?></h6></th>
                    <td ><?php echo $champ3?></td>
                    </tr>
                    <tr>
                    <th scope="row"><h6><?php echo $columnName[5]?></h6></th>
                    <td ><?php echo $champ4?></td>
                    </tr>
                    <tr>
                    <th scope="row"><h6><?php echo $columnName[6]?></h6></th>
                    <td ><?php echo $champ5?></td>
                    </tr>
                    <tr>
                    <th scope="row"><h6><?php echo $columnName[7]?></h6></th>
                    <td ><?php echo $champ6?></td>
                    </tr>
                    <tr>
                    <th scope="row"><h6><?php echo $columnName[8]?></h6></th>
                    <td ><?php echo $champ7?></td>
                    </tr>
                    <tr>
                    <th scope="row"><h6><?php echo $columnName[9]?></h6></th>
                    <td ><?php echo $champ8?></td>
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