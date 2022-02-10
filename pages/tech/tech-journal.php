<?php require"../init.php" ;
      require"../header.php";
      require"../connexiondb.php";
?>
<!-- recuperation des données -->
<?php  
     $idUser = 1;
     $dbTable = "comptelec";
     $dateInter= "2022-02-06";
      // mysql query to get columns name
     $req = "SHOW COLUMNS FROM " . $dbTable;
     // mysql query to get columns values
     $req1 ="select Rendezvous, Accesible , Grip FROM " . $dbTable . " WHERE dateInter ='".$dateInter."' AND idUser= " . $idUser;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="<?php echo"$srcAdminTech"?>css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo"$srcAdminTech"?>css/main.css">
        <link href="<?php echo"$srcAdminTech"?>css/tech-journal/tech-journal.css" rel="stylesheet">
        
    </head>
    <body>
        <div class="container">
            <!-- Form de recherche -->
            <form action="" method="post">
                <input type="date" name="date" value="<?php echo date('Y-m-d') ?>" id="">
                <input type="submit" name="submit" class="btn btn-primary" value="Rechercher">
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
                    echo "<input type='date' name='date' value='".date('Y-m-d')."' >";
                // $x for columns name index and $y for columns values index
                for($x = 2 AND $y=0 ; $x < count($columnName) AND $y < count($results1Row); $x++ AND $y++){

                echo    "<div>
                            <label for=''> ". $columnName[$x] ."</label>
                            <input type='number' min='0' max='100' value=".$results1Row[$y]." name = " .$columnName[$x].">
                        </div>
                        <hr>" ;
                }
                echo"
                <div class='submit'>
                    <button class='btn btn-primary' type='submit'>Submit form</button>
                </div>
                ";
                }
                // if there is no data print an empty form
                else echo"il n'existe pas de chiffre pour ce jour" ;
                        
                ?> 
            </form>
        </div>
    </body>
</html>        