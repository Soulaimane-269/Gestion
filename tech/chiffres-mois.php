<?php 
//init
require"../init.php";
require"../connexiondb.php";

//la session
session_start();

if (!isset($_SESSION["userName"])){
    header("location:../index.php");
}
else{$userName=$_SESSION["userName"];
}

//init month
$month = (int)date('m');

if (isset($_POST['month'])){
    $month = ($_POST['month']);
};

//id recup
$id = $conn->query("SELECT id FROM users WHERE userName='".$userName . "'");
if (mysqli_num_rows($id) > 0) {
    while($rowData = mysqli_fetch_array($id)){
        $idInt= (int)$rowData["id"];
        }
}
$idUser = $idInt;

// type recu
$type = $conn->query("SELECT type FROM users WHERE id=".$idUser."");
if (mysqli_num_rows($type) > 0) {
    while($rowData = mysqli_fetch_array($type)){
          $typeStr=$rowData["type"];
    } 
}

// gaz columns names recu
$req = "SHOW COLUMNS FROM comptegaz";
$results = mysqli_query($conn,$req);
$columnName = array();
while( $row = mysqli_fetch_array($results) ){
    $columnName[] = $row['Field'] ;
};

//query to get and user name
$req="SELECT * FROM users WHERE id= ".$idUser."";
$exec = mysqli_query($conn,$req);
$res = mysqli_fetch_assoc($exec);
$nom=$res["userName"];

//check if the tech was elec
if($typeStr=="electricite"){
    $tabletype= "comptelec";
    $reqElec="SELECT SUM(`Rendez-vous`+ `Accessible`+`Grip`) AS Total FROM comptelec WHERE idUser= ".$idUser." AND month(dateInter)=". $month;
    $exec = mysqli_query($conn,$reqElec);
    $res = mysqli_fetch_assoc($exec);
    $TotalCmpt =isset($res['Total']) ? $res['Total'] :0 ;
}elseif($typeStr == "gaz"){
    $tabletype= "comptegaz";
    $req="SELECT SUM(`".$columnName[2]."`+ `".$columnName[3]."`+ `".$columnName[4]."`+ `".$columnName[5]."`+ `".$columnName[6]."`+ `".$columnName[7]."`+ `".$columnName[8]."`+ `".$columnName[9]."`) AS Total FROM comptegaz WHERE idUser= ".$idUser." AND month(dateInter)=". $month;
    $exec = mysqli_query($conn,$req);
    $res = mysqli_fetch_assoc($exec);
    
    $TotalCmpt =isset($res["Total"]) ? $res["Total"] :0 ;
}

// Query to get number of days 
$req = "SELECT * FROM ".$tabletype." WHERE idUser =".$idUser." AND month(dateInter)=". $month.";" ;
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
    <link rel="stylesheet" href="<?php echo"$srcAdminTech"?>css/chiffres-details/chiffres-details.css">
    <title>Chiffres en détails</title>
</head>
<body>
    <?php require"../header.php"; ?>
    <!-- header -->
    <div class="container">
    <form method="post" action="">
                <?php
                $monthName = array(0,'Janvier','Février','Mars','Avril' ,'Mai' ,'Juin','Juillet','Aôut','Septembre','Octbre','Novembre','Décembre');
                $monthOut=1;
                if(isset($month)){ 
                    echo'<select class="form-select" aria-label=".form-select-lg example" name="month" >';
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
            <div class="container">
                <h1><?php echo $nom?> </h1>
                <div class="oval oval-1">
                    <div class="fs-2 text"><?php echo $TotalCmpt?></div>
                    <h6>Compteurs</h6>
                </div>
                <div class="oval oval-2">
                    <div><?php echo number_format($avg, 2, '.', '') ?></div>
                    <h6>Sur <?php echo $TotalDays ?> jour de travail</h6>
                </div>
            </div>
        </div>
    </div>
</body>
</html>