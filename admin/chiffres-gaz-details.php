<?php 
//init
require"../init.php";
require"../connexiondb.php";
session_start();
if (!isset($_SESSION["userName"])){
    header("location:../index.php");
}
//init month
$month = ($_GET['month']);

if (isset($_POST['month'])){
    $month = ($_POST['month']);
};

//get columns names
$req = "SHOW COLUMNS FROM comptegaz" ;
// query execution
$results = mysqli_query($conn,$req);
// array to store columns names
$columnName = array();
                
while( $row = mysqli_fetch_array($results) ){
    $columnName[] = $row['Field'] ;
    };

//id recup
$idUser = (int)$_GET["id"];

//query to get user id and user name
$req="SELECT * FROM users WHERE id= ".$idUser."";
$exec = mysqli_query($conn,$req);
$res = mysqli_fetch_assoc($exec);
$nom=$res["userName"];

//query to get tech data
$req="SELECT  SUM(`".$columnName[2]."`) as champ1, SUM(`".$columnName[3]."`) as champ2, SUM(`".$columnName[4]."`) as champ3, SUM(`".$columnName[5]."`) as champ4, SUM(`".$columnName[6]."`) as champ5, SUM(`".$columnName[7]."`) as champ6, SUM(`".$columnName[8]."`) as champ7, SUM(`".$columnName[9]."`) as champ8  FROM comptegaz WHERE idUser= ".$idUser." AND month(dateInter)=". $month;

$exec = mysqli_query($conn,$req);
$res = mysqli_fetch_assoc($exec);
$champ1 = isset($res['champ1']) ? $res['champ1'] : 0; 
$champ2 = isset($res['champ2']) ? $res['champ2'] : 0; 
$champ3 = isset($res['champ3']) ? $res['champ3'] : 0; 
$champ4 = isset($res['champ4']) ? $res['champ4'] : 0; 
$champ5 = isset($res['champ5']) ? $res['champ5'] : 0; 
$champ6 = isset($res['champ6']) ? $res['champ6'] : 0; 
$champ7 = isset($res['champ7']) ? $res['champ7'] : 0; 
$champ8 = isset($res['champ8']) ? $res['champ8'] : 0; 
$TotalCmpt = $champ1 + $champ2 + $champ3 + $champ4 + $champ5 + $champ6 + $champ7 + $champ8 ;
 
// Query to get number of days 
$req = "SELECT * FROM comptegaz WHERE idUser =".$idUser." AND month(dateInter)=". $month.";" ;
$exec = mysqli_query($conn,$req);
$TotalDays = mysqli_num_rows($exec);

//avg per day
$avg= ($TotalDays == 0)? 0 : $TotalCmpt / $TotalDays; 

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
    <link rel="stylesheet" href="<?php echo"$srcAdminTech"?>css/chiffres-details-admin/chiffres-details-admin.css">
    <title>Chiffres en détails</title>
</head>
<body>
    <?php require"../header.php";?>
    <!-- header -->
    <div class="container">
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
            <?php 
            if($monthName[$month]=== 'Avril' OR $monthName[$month]=== 'Aôut' ) echo"<h5> Pour le mois d'".$monthName[$month]."<h5/>";
            else echo"<h5> Pour le mois de ".$monthName[$month]."<h5/>"; ?>  
        <div class="body-wrapper">
            <h3>Technicien: <?php echo $nom?> </h3>
            <div class="container">
            <div class="page1">
            <table class="table table-striped">
                <tbody >
                    <tr >
                    <th scope="row"><h6>Totale des Compteures</h6></th>
                    <td><h6><?php echo $TotalCmpt?></h6></td>
                    </tr>
                    <tr>
                    <th scope="row"> <h6><?php echo $columnName[2]?></h6></th>
                    <td><h6><?php echo $champ1?></h6></td>
                    </tr>
                    <tr>
                    <th scope="row"><h6><?php echo $columnName[3]?></h6></th>
                    <td><h6><?php echo $champ2?></h6></td>
                    </tr>
                    <tr>
                    <th scope="row"><h6><?php echo $columnName[4]?></h6></th>
                    <td ><h6><?php echo $champ3?></h6></td>
                    </tr>
                    <tr>
                    <th scope="row"><h6><?php echo $columnName[5]?></h6></th>
                    <td ><h6><?php echo $champ4?></h6></td>
                    </tr>
                    <tr>
                    <th scope="row"><h6><?php echo $columnName[6]?></h6></th>
                    <td ><h6><?php echo $champ5?></h6></td>
                    </tr>
                    <tr>
                    <th scope="row"><h6><?php echo $columnName[7]?></h6></th>
                    <td ><h6><?php echo $champ6?></h6></td>
                    </tr>
                    <tr>
                    <th scope="row"><h6><?php echo $columnName[8]?></h6></th>
                    <td ><h6><?php echo $champ7?></h6></td>
                    </tr>
                    <tr>
                    <th scope="row"><h6><?php echo $columnName[9]?></h6></th>
                    <td ><h6><?php echo $champ8?></h6></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>