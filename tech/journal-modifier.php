<?php require"../init.php" ;
      require"../connexiondb.php";
      //la session
      session_start();
      $verifier=0;

      if (!isset($_SESSION["userName"])){
        header("location:../index.php");
      }
      else{$userName=$_SESSION["userName"];
      };

    //recuperation des données
    //id
    $id = $conn->query("SELECT id FROM users WHERE userName='".$userName . "'");
    if (mysqli_num_rows($id) > 0) {
        while($rowData = mysqli_fetch_array($id)){
            $idInt= (int)$rowData["id"];
        }
    }
    $idUser = $idInt;
    //le type
    $type = $conn->query("SELECT type FROM users WHERE id=".$idUser."");
    if (mysqli_num_rows($type) > 0) {
        while($rowData = mysqli_fetch_array($type)){
              $typeStr=$rowData["type"];
        } 
    }
    //table        
    $dbTable = "comptelec";
    //date
    $date = $_GET['date'];
    $dateInter= $date;

    // mysql query to get columns name
    $req = "SHOW COLUMNS FROM " . $dbTable;
    // mysql query to get columns values
    $req1 ="select `Rendez-vous`, `Accessible`, `Grip` FROM " . $dbTable . " WHERE dateInter ='".$dateInter."' AND idUser= " . $idUser;
    //if it's gaz
    if($typeStr=='gaz'){
        $dbTable = "comptegaz";
        $req = "SHOW COLUMNS FROM " . $dbTable;
        $results = mysqli_query($conn,$req);
        // array to store columns names to make query dynamic
        $columnName = array();

        while( $row = mysqli_fetch_array($results) ){
            $columnName[] = $row['Field'] ;
        };
        $req1 ="SELECT `" .$columnName[2]. "` , `".$columnName[3]."` , `".$columnName[4]."` , `".$columnName[5]."` , `".$columnName[6]."` , `".$columnName[7]."` , `".$columnName[8]."` , `".$columnName[9]."` FROM `".$dbTable."` WHERE idUser=".$idUser." AND dateInter='".$date."'";
    }
;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="<?php echo $srcAdminTech ?>images/favicon.png"/> 
        <title>Modifier Mon Journal</title>
        <link href="<?php echo"$srcAdminTech"?>css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo"$srcAdminTech"?>css/main/main.css">
        <link href="<?php echo"$srcAdminTech"?>css/tech-journal/tech-journal.css" rel="stylesheet">

    </head>
    <body>
        <?php require"../header.php";?>
        <div class="container" style="position:relative">
            <form action="" method="post">               
            <?php  
                // queries execution
                $results1 = mysqli_query($conn,$req1);
                $results = mysqli_query($conn,$req);
                
                // array to store columns values
                $results1Row= mysqli_fetch_row($results1);
                
                // array to store columns names
                $columnName = array();

                while( $row = mysqli_fetch_array($results) ){
                    $columnName[] = $row['Field'] ;
                };
                // Condition to check if there is data for the date
                if( isset($results1Row) ){
                    echo " <h5>le ".$date."</h5>";
                // $x for columns name index and $y for columns values index
                for($x = 2 AND $y=0 ; $x < count($columnName) AND $y < count($results1Row); $x++ AND $y++){

                echo    "<div><label for=''> ". $columnName[$x] ."</label><input type='number' min='0' max='100' value=".$results1Row[$y]." name = 'champ".$x."'></div><hr>" ;
                }
                echo"
                <div >
                    <button name='submit' class='btn btn-primary button-green' type='submit'>Enregister les modifications</button>
                </div>
                ";
                }
                // if there is no data print an empty form
                else {echo"<h5>il n'existe pas de chiffre pour le ".$date."</h5>" ;
                for($x = 2 ; $x < count($columnName) ; $x++ ){

                    echo    "<div><label for=''> ". $columnName[$x] ."</label><input type='number' min='0' max='100' value='0' name = 'champ".$x."'></div><hr>";
                        }
                        echo"
                        <div >
                            <button name='submit' class='btn btn-primary button-green' type='submit'>Enregister les modifications</button>
                        </div>
                        ";
                    }
                echo"<a id='returnBtn' href='journal.php?date=".$date."'>retour au journale</a>";        
                ?> 
            </form>
            <?php
            // ****************Form Submition **********************
    if($typeStr=='gaz'){
        if( isset($_POST['submit']) && isset($_POST['champ9']) && isset($_POST['champ2']) && isset($_POST['champ3']) && isset($_POST['champ4']) && isset($_POST['champ5']) && isset($_POST['champ6']) && isset($_POST['champ7']) && isset($_POST['champ8'])){
            //storing in variables
            $champ1 = $_POST['champ2'];
            $champ2 = $_POST['champ3'];
            $champ3 = $_POST['champ4'];
            $champ4 = $_POST['champ5'];
            $champ5 = $_POST['champ6'];
            $champ6 = $_POST['champ7'];
            $champ7 = $_POST['champ8'];
            $champ8 = $_POST['champ9'];

            //condition to check if data exist
            if(!isset($results1Row)){
                // query insert
                $req ="INSERT INTO comptegaz VALUES (".$idUser.", '".$dateInter."',".$champ1.",".$champ2.",".$champ3." , ".$champ4.", ".$champ5.", ".$champ6." ,".$champ7.", ".$champ8." ) ";
            }elseif(isset($results1Row)){
                //query modify
                $req ="UPDATE comptegaz SET `".$columnName[2]."` = ".$champ1.", `".$columnName[3]."` = ".$champ2.", `".$columnName[4]."` = ".$champ3.", `".$columnName[5]."` = ".$champ4.", `".$columnName[6]."` = ".$champ5.", `".$columnName[7]."` = ".$champ6.", `".$columnName[8]."` = ".$champ7.", `".$columnName[9]."` = ".$champ8."  WHERE idUser =".$idUser." AND dateInter='".$date."' ";  
            }        
            $res = mysqli_query($conn,$req);
            // load variable
            $verifier=1;
            header('Refresh:2 ; URL=journal-modifier.php?date='.$date.'&succes=1');

        }
    }elseif($typeStr=='electricite'){
        if(isset($_POST['submit']) && isset($_POST['champ2']) && isset($_POST['champ3']) && isset($_POST['champ4'])){
            //storing in variables
            $rendezVous = $_POST['champ2'];
            $accesible = $_POST['champ3'];
            $grip = $_POST['champ4'];

            //requete modify
            if(!isset($results1Row)){
                $req ="INSERT INTO comptelec(idUser, dateInter, `Rendez-vous`, `Accessible`, `Grip`) VALUES (".$idUser.", '".$dateInter."',".$rendezVous.",".$accesible.",".$grip.") ";
            }elseif(isset($results1Row)){
                $req ="UPDATE comptelec SET `Rendez-vous` = ".$rendezVous.", `Accessible`=".$accesible.", `Grip`=".$grip." WHERE idUser =".$idUser." AND dateInter='".$dateInter."' ";  

            };  
            $res = mysqli_query($conn,$req);
            // load variable
            $verifier=1;
            header('Refresh:2 ; URL=journal-modifier.php?date='.$date.'&succes=1');
    } 
};
    ?>
            <?php require"../load.php"?>
        </div>
    </body>
    
</html>   