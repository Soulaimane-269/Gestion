<?php require"../init.php" ;
      require"../header.php";
      require"../connexiondb.php";
      //la session
      session_start();

      if (!isset($_SESSION["userName"])){
        header("location:../connexion.php");
      }
      else{$userName=$_SESSION["userName"];
      }
?>

<!-- recuperation des données -->
<?php  
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
    $req1 ="select Rendezvous, Accesible , Grip FROM " . $dbTable . " WHERE dateInter ='".$dateInter."' AND idUser= " . $idUser;
    //if it's gaz
    if($typeStr=='gaz'){
        $dbTable = "comptegaz";
        $req1 ="select Rendez_vous, Sans_rendez_vous , Module , Detendeur FROM " . $dbTable . " WHERE dateInter ='".$dateInter."' AND idUser= " . $idUser;
        $req = "SHOW COLUMNS FROM " . $dbTable;
    }
;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="<?php echo"$srcAdminTech"?>css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo"$srcAdminTech"?>css/main/main.css">
        <link href="<?php echo"$srcAdminTech"?>css/tech-journal/tech-journal.css" rel="stylesheet">
        
    </head>
    <body>
        <div class="container">
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

                echo    "<div>
                            <label for=''> ". $columnName[$x] ."</label>
                            <input type='number' min='0' max='100' value=".$results1Row[$y]." name = " .$columnName[$x].">
                        </div>
                        <hr>" ;
                }
                echo"
                <div >
                    <button name='submit' class='btn btn-primary button-green' type='submit'>enregister les modifications</button>
                </div>
                ";
                }
                // if there is no data print an empty form
                else {echo"il n'existe pas de chiffre pour ce jour" ;
                for($x = 2 ; $x < count($columnName) ; $x++ ){

                    echo    "<div>
                                <label for=''> ". $columnName[$x] ."</label>
                                <input type='number' min='0' max='100' value='0' name = " .$columnName[$x].">
                            </div>
                            <hr>" ;
                    
                        }
                        echo"
                        <div >
                            <button name='submit' class='btn btn-primary button-green' type='submit'>enregister les modifications</button>
                        </div>
                        ";
                    }
                echo"<a href='journal.php?date=".$date."'>retour au journale</a>";        
                ?> 
            </form>
        </div>
    </body>
    <?php
    if($typeStr=='gaz'){

        if(isset($_POST['Rendez_vous']) && isset($_POST['Sans_rendez_vous']) && isset($_POST['Module']) && isset($_POST['Detendeur']) ){
            //storing in variables
            $rendezVous = $_POST['Rendez_vous'];
            $sansRendezVous = $_POST['Sans_rendez_vous'];
            $module = $_POST['Module'];
            $detendeur= $_POST['Detendeur'];
            echo 'het';

            echo $rendezVous . $sansRendezVous . $module . $detendeur;

            //requete modify
            $req ="UPDATE " . $dbTable . " SET Rendez_vous = ".$rendezVous.", Sans_rendez_vous=".$sansRendezVous.", Module=".$module.",Detendeur=".$detendeur." WHERE idUser =".$idUser." AND dateInter='".$dateInter."' ";
            //condition to check if data exist
            if(!isset($results1Row)){
                $req ="INSERT INTO comptegaz VALUES (".$idUser.", '".$dateInter."',".$rendezVous.",".$sansRendezVous.",".$module." , ".$detendeur." ) ";
            }        
            $res = mysqli_query($conn,$req);
            header('Refresh:0 ; URL=rederiger-journal-modifier.php?date='.$date.'');
            

        }
    }elseif($typeStr=='electricite'){
        if(isset($_POST['Rendezvous']) && isset($_POST['Accesible']) && isset($_POST['Grip'])){
            //storing in variables
            $rendezVous = $_POST['Rendezvous'];
            $accesible = $_POST['Accesible'];
            $grip = $_POST['Grip'];
            echo 'het';

            //
            //requete modify
            if(!isset($results1Row)){
                $req ="INSERT INTO comptelec(idUser, dateInter, Rendezvous,Accesible,Grip) VALUES (".$idUser.", '".$dateInter."',".$rendezVous.",".$accesible.",".$grip.") ";
            }elseif(isset($results1Row)){
                $req ="UPDATE comptelec SET Rendezvous = ".$rendezVous.", Accesible=".$accesible.", Grip=".$grip." WHERE idUser =".$idUser." AND dateInter='".$dateInter."' ";  

            };  
            $res = mysqli_query($conn,$req);
            header('Refresh:0 ; URL=rederiger-journal-modifier.php?date='.$date.'');
    

    } 
    
    

};

    ?>
</html>   