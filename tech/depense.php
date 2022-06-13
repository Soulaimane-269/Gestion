<?php require"../init.php"; 

session_start();

if(!isset($_SESSION["userName"]) OR $_SESSION["type"] == "admin"  )
{
    header("location:../index.php");
} 
$userName=$_SESSION["userName"];
$idUser = $_SESSION["idUser"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo $srcAdminTech ?>images/favicon.png"/>
    <!-- CSS files -->
    <link rel="stylesheet" href="<?php echo $srcAdminTech?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $srcAdminTech?>css/main/main.css">
    <link rel="stylesheet" href="<?php echo $srcAdminTech?>css/load/load.css">
    <style>
        input.form-control:focus, select.form-select:focus  { 
            border-color: grey;
            outline: none;
            box-shadow: 0 0 0 0.25rem #fff;
        }
        input[name="submit"]{
            margin-top: 15px;
        }
        form{
            padding-top: 30px;
        }
        span{
            font-size: 11px;
            color: #00000085;
        }
    </style>
    <title>Accueil</title>
</head>
<body>
    <?php require"../header.php";?>
   <div class="container">
       <form  enctype="multipart/form-data" method="post" >
       <h3>Détail de facture</h3>
       
       <div class="mb-3">
           <label class="form-label">Date de la facture</label><input class="form-control" type="date" value="<?php echo date("Y-m-d"); ?>" name="dateFacture" required>
        </div>
        <div class="mb-3">
           <label class="form-label">Type</label>
           <select class="form-select" name="typeFacture" required>
            <option value="gasoil">Gasoil</option>
            <option value="frais de déplacement">Frais de déplacement</option>
            <option value="autre">Autre</option>
           </select>
        </div>
        <div class="mb-3">
           <label class="form-label">Montant de la facture</label><input class="form-control" type="number" name="montantFacture"  min="0" step="0.01" required >
        </div>
        <div>
            <label class="form-label">Facture</label><input class="form-control" type="file" capture="user" accept="image/*"  value="uploader l'image" name="imageFacture" required >
        </div>
        <span>*Vérifier bien l'exactitude des information communiquées avant d'envoyer</span>    
        <div>
            <input type="submit" name="submit" class="btn btn-primary button-green" value="Envoyer">
        </div>
    </form>
    <?php
        $statusMsg = '';
        // function to submit  files
        if(isset($_POST["submit"]) && count($_FILES)>0){
        $dateFacture=$_POST['dateFacture'];
        $typeFacture=$_POST['typeFacture'];
        $montantFacture=$_POST['montantFacture'];
        // File upload path
            // extensio to get file extension it returns an array
        $extension = explode(".", $_FILES["imageFacture"]["name"]);
            // target directory
        $targetDir = "../src/facture/";
            //File name= id    current time           extension
        $fileName = $idUser . round(microtime(true))."." .end($extension) ;
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

        //Allowed certain file formats
        $allowedType = array('jpg','png','jpeg');
        if(in_array($fileType , $allowedType)){
            // Upload file to the server
            if(move_uploaded_file($_FILES["imageFacture"]["tmp_name"], $targetFilePath)){
                // insert data into db
                $req =$conn->query("INSERT INTO facture (idUser, dateFacture, typeFacture, montantFacture, imageFacture) VALUES({$idUser},'{$dateFacture}' ,'{$typeFacture}', {$montantFacture}, '{$fileName}')");
                if($req){
                    $statusMsg = '<div class="modal" style="display: flex;
                    justify-content: center; align-items: center;background: #0000006e; z-index:1;" >
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-body">
                          <p style="margin: 1rem;"> Votre facture a été envoyé avec succès. </p>
                        </div>
                      </div>
                    </div>
                    </div>';
                    $verifier = 1 ;
                    require "../load.php";
                    echo ' <script type="text/javascript">                   
                    function Redirection(){
                        document.location.href="index.php"; 
                    }
                      setTimeout("Redirection()", 2000)
                    </script>';
                }else{
                    $statusMsg = "L'envoie de votre facture a échoué! Réssayer.";
                } 
            }else{
                $statusMsg = "Désolé, un erreur s'est produit, merci de réssayer.";
            }
        }else{
            $statusMsg = " Seulement les format 'jpg','png','jpeg' sont accepté.";
        }
        
    }
    echo  $statusMsg;
    ?>
   </div> 
</body>