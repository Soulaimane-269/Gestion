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

//id recup
$idUser = (int)$_GET["id"];
//query to get  user name
$req="SELECT * FROM users WHERE id= ".$idUser."";
$exec = mysqli_query($conn,$req);
$res = mysqli_fetch_assoc($exec);
$nom=$res["userName"];
// query to get gasoil
$req = 'SELECT SUM(montantFacture) FROM facture WHERE idUser = '.$idUser.' AND typeFacture = "gasoil" AND MONTH(dateFacture) = '.$month.'';
$exec = mysqli_query($conn,$req);
$res = mysqli_fetch_assoc($exec);
$montantGasoil = isset($res['SUM(montantFacture)']) ? $res['SUM(montantFacture)'] : 0;
// query to get frais deplacement 
$req = 'SELECT SUM(montantFacture) FROM facture WHERE idUser = '.$idUser.' AND typeFacture = "frais de déplacement " AND MONTH(dateFacture) = '.$month.'';
$exec = mysqli_query($conn,$req);
$res = mysqli_fetch_assoc($exec);
$montantDeplacement = isset($res['SUM(montantFacture)']) ? $res['SUM(montantFacture)'] : 0;
// query to get autre
$req = 'SELECT SUM(montantFacture) FROM facture WHERE idUser = '.$idUser.' AND typeFacture = "autre " AND MONTH(dateFacture) = '.$month.'';
$exec = mysqli_query($conn,$req);
$res = mysqli_fetch_assoc($exec);
$montantAutre = isset($res['SUM(montantFacture)']) ? $res['SUM(montantFacture)'] : 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo $srcAdminTech ?>images/favicon.png"/>
   
    <!-- CSS files -->
    <style>
        .montant {text-align:center};
        .accordion-button.collapsed {
            color: #0da443;
            background-color: #0da44342;
            box-shadow: inset 0 -1px 0 rgb(0 0 0 / 13%);
        }
    </style>
    <link rel="stylesheet" href="<?php echo"$srcAdminTech"?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo"$srcAdminTech"?>css/main/main.css">
    <link rel="stylesheet" href="<?php echo"$srcAdminTech"?>css/chiffres-details-admin/chiffres-details-admin.css">
    <title>Depépenses en détails</title>
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
            echo'<select style="min-width: 75%; text-align: center;" name="month" >';
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
        // };
        ?>
        
    </form>    
        <div class="body-wrapper">
            <h3>Technicien: <?php echo $nom?> </h3>
            <div>
                <div class="page1">
                    <table class="table table-striped">
                        <tbody >
                            <tr >
                            <th scope="row"><h6>Dépenses gasoil</h6></th>
                            <td><h6 class="montant"><?php echo $montantGasoil ?></h6></td>
                            </tr>
                            <tr >
                            <th scope="row"><h6>Frais de déplacement</h6></th>
                            <td><h6 class="montant"><?php echo $montantDeplacement?></h6></td>
                            </tr>
                            <tr >
                            <th scope="row"><h6>Autre dépenses </h6></th>
                            <td><h6 class="montant"><?php echo $montantAutre ?></h6></td>
                            </tr>
                            <tr >
                            <th scope="row"><h6>Total des dépenses</h6></th>
                            <td><h6 class="montant"><?php echo $montantAutre + $montantDeplacement + $montantGasoil ?></h6></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Détail facture -->
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Détails des facture
                        </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body" style="padding:1rem 0;">
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Montant</th>
                                    <th scope="col">Facture</th>
                                    </tr>
                                </thead>
                                <tbody>
                        <?php 
                        $req = "Select idFacture, dateFacture, typeFacture , montantFacture , imageFacture from facture where idUser = ".$idUser." and month(dateFacture)= ".$month." ORDER BY dateFacture ASC";
                        $exec = mysqli_query($conn,$req);
                        $res=mysqli_fetch_all($exec);
                        if ($exec->num_rows > 0)  {
                            for($x=0 ; $x < count($res) ; $x++) {
                                echo '
                                    <tr>
                                    <th scope="row">'.$res[$x][0].'</th>
                                    <td>'.$res[$x][1].'</td>
                                    <td>'.$res[$x][2].'</td>
                                    <td>'.$res[$x][3].'</td>';
                                    // modal to display image
                                    echo '<td> 
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary button-green" style="min-width:fit-content; padding: 5px 20px;" data-bs-toggle="modal" data-bs-target="#exampleModal' .$x.'">
                                    voir
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade " id="exampleModal'.$x.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Facture du '.$res[$x][1].'</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        <img src="../src/facture/'.$res[$x][4].'" alt="facture" style="width: 100%">
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                    </td>
                                    </tr>
                                '; 
                            }
                        }
                        ?>
                            </tbody>
                                </table>
                            </div>   
                            
                        </div>
                    </div>
                </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="<?php echo "$srcAdminTech"?>js/bootstrap.min.js" defer ></script>
</html>