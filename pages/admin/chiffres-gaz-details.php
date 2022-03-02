<?php 
//init
require"../init.php";
require"../connexiondb.php";
session_start();
//init month
$month = ($_GET['month']);

if (isset($_POST['month'])){
    $month = ($_POST['month']);
};

//connexion to db
//id recup
$idUser = (int)$_GET["id"];

//query to get user id and user name
$req="SELECT * FROM users WHERE id= ".$idUser."";
$exec = mysqli_query($conn,$req);
$res = mysqli_fetch_assoc($exec);
$nom=$res["userName"];

//query to get tech data
$req="SELECT SUM(Rendez_vous + Sans_rendez_vous + Module + Detendeur) FROM comptegaz WHERE idUser= ".$idUser." AND month(dateInter)=". $month;
$exec = mysqli_query($conn,$req);
$res = mysqli_fetch_assoc($exec);
$TotalCmpt =isset($res['SUM(Rendez_vous + Sans_rendez_vous + Module + Detendeur)']) ? $res['SUM(Rendez_vous + Sans_rendez_vous + Module + Detendeur)'] :0 ;

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
    <!-- CSS files -->
    <link rel="stylesheet" href="<?php echo"$srcAdminTech"?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo"$srcAdminTech"?>css/main/main.css">
    <link rel="stylesheet" href="<?php echo"$srcAdminTech"?>css/chiffres-details/chiffres-details.css">
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