<?php require"../init.php" ;
      require"../header.php";
      require"../connexiondb.php";
      
     //la session
      session_start();

    if (!isset($_SESSION["userName"])){
        header("location:../connexion.php");
    }
    else{$userName=$_SESSION["userName"];}
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
  
    $date= date("Y-m-d");
    
    if(isset($_POST["submit"])){
        $date=$_POST["date"];
    }
    if(isset($_GET["date"])){
        $date =$_GET["date"];
        if(isset($_POST["submit"])){
            $date=$_POST["date"];
        }
    }
    
    $dateInter= $date;
    // mysql query to get columns name
    $req = "SHOW COLUMNS FROM " . $dbTable;
    // mysql query to get columns values
    $req1 ="select Rendezvous, Accesible , Grip FROM " . $dbTable . " WHERE dateInter ='".$dateInter."' AND idUser= " . $idUser;
    //if gaz
    if($typeStr=='gaz'){
        $dbTable = "comptegaz";
        $req1 ="select Rendez_vous, sans_rendez_vous , Module , Detendeur FROM " . $dbTable . " WHERE dateInter ='".$dateInter."' AND idUser= " . $idUser;
        $req = "SHOW COLUMNS FROM " . $dbTable;
    }
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
            <!-- Form de recherche -->
            <form action="" method="post" class="search">
                <input type="date" name="date" value="<?php echo $dateInter?>">
                <button class="button-green btn btn-primary" type="submit" name="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            <form action="formexec.php" method="post">               
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
                    echo '<h5>Résultats pour le ' .$date.'</h5>' ;
                // $x for columns name index and $y for columns values index
                for($x = 2 AND $y=0 ; $x < count($columnName) AND $y < count($results1Row); $x++ AND $y++){

                echo    "<div>
                            <label for=''> ". $columnName[$x] ."</label>
                            <input type='number' min='0' max='100' value=".$results1Row[$y]." name = " .$columnName[$x].">
                        </div>
                        <hr>" ;
                }
                echo"
                <div ><span>voulez vous le </span>
                    <a href='journal-modifier.php?date=".$date."' type='submit'>modifier</a>
                </div>
                ";
                }
                // if there is no data print an empty form
                elseif(!isset($results1Row)){

                 echo"il n'existe pas de chiffre pour ce jour" ;
                    echo"
                    <div ><span>voulez vous le </span>
                        <a id='modifierBtn' href='journal-modifier.php?date=".$date."' type='submit'>modifier</a>
                    </div>
                    "; 
                }     
                ?> 
            </form>
        </div>
    </body>
</html>        