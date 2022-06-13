<?php 
//init
require"../init.php";
require"../connexiondb.php";
session_start();
if (!isset($_SESSION["userName"])){
    header("location:../index.php");
}
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

//id recup
$idUser = (int)$_GET["id"];

//query to get user id and user name
$req="SELECT * FROM users WHERE id= ".$idUser."";
$exec = mysqli_query($conn,$req);
$res = mysqli_fetch_assoc($exec);
$nom=$res["userName"];

//query to get tech data
$req="SELECT  SUM(`".$columnName[2]."`) as champ1, SUM(`".$columnName[3]."`) as champ2, SUM(`".$columnName[4]."`) as champ3, SUM(`".$columnName[5]."`) as champ4, SUM(`".$columnName[6]."`) as champ5, SUM(`".$columnName[7]."`) as champ6, SUM(`".$columnName[8]."`) as champ7, SUM(`".$columnName[9]."`) as champ8  FROM comptegaz WHERE idUser= ".$idUser." AND dateInter >= '".$dateFrom."' AND dateInter <= '".$dateTo."'";

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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo $srcAdminTech ?>images/favicon.png"/>
    <script type="text/javascript" src="<?php echo "$srcAdminTech"?>js/bootstrap.min.js" defer ></script>
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
            // };
            ?>
            
        </form>    
        <div class="body-wrapper">
            <h3>Technicien: <?php echo $nom?> </h3>
            <div class="container">
                <div class="page1">
                    <table class="table table-striped">
                        <tbody >
                            <tr >
                            <th scope="row"><h6>Total compteurs</h6></th>
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
                <!--Absence accordion -->
                <?php
                // Query to get number of days 
                $req = "SELECT * FROM comptegaz WHERE idUser =".$idUser." AND dateInter >= '".$dateFrom."' AND dateInter <= '".$dateTo."'" ;
                $exec = mysqli_query($conn,$req);
                $res =mysqli_fetch_all($exec);
                // Init array that will contain worked days 
                $workedDays = array(); 
                for($x = 0 ; $x < count($res ); $x++){
                    // check if all the values are not equal to 0
                    if(!($res[$x][2] === '0' && $res[$x][3]=== '0' && $res[$x][4]=== '0' && $res[$x][5]=== '0' && $res[$x][6]=== '0' && $res[$x][7]=== '0' && $res[$x][8]=== '0' && $res[$x][9]=== '0')) array_push($workedDays , $res[$x][1]);
                }
                // function to calculate absence
                function AbsenceCalculator($startDate, $endDate){
                    // date to timestamp
                    $endDate = strtotime($endDate);
                    $startDate = strtotime($startDate);
                    // num of days between two dates
                    $days = ($endDate - $startDate) / 86400 + 1;
                    // get the working days without weekends
                    $workingDays = array();
                    for($x= $startDate ; $x <= $endDate ; $x+=86400){
                        if(!(date("N",$x) == 6 or date("N",$x) == 7 )){
                            $y = date('Y-m-d', $x);
                            array_push($workingDays , $y); 
                        } 
                    };
                    return $workingDays;
                }
                $jourFerie= array('2022-01-01', '2022-04-18','2022-05-01','2022-05-08','2022-05-26', '2022-06-06','2022-07-14','2022-08-15','2022-11-01','2022-11-11','2022-12-25');
                $workingDays = AbsenceCalculator($dateFrom,$dateTo);
                $Absence =array_values(array_diff($workingDays, $workedDays, $jourFerie)) ; 
                ?>
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Détails des absences
                        </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body" style="padding:1rem 0;">
                                <h2> journées d'absence  </h2>
                                <?php 
                                if(count($Absence)> 0){
                                    for($x = 0 ; $x <= max(array_keys($Absence)); $x++){
                                        echo"le " .$Absence[$x]. "<br>";
                                    }
                                }else{ echo"pas d'absences pour cette période";}
                                
                                ?>
                            </div>      
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>