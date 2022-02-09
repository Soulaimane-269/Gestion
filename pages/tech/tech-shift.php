<?php
    require"../init.php";
    require "../header.php"
?>
<!-- recuperation des données -->
<?php  
    $idUser = 1;
    $dbTable = "comptelec";
     // mysql query to get columns name
     $req = "SHOW COLUMNS FROM " . $dbTable;
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
        <link href="<?php echo"$srcAdminTech"?>css/tech-shift/tech-shift.css" rel="stylesheet">
        
    </head>
    <body>
        <div>
            <form action="formexec.php" method="post">
                <div>
                    <h4>Aujourd'hui le <?php echo date("Y-m-d")?></h4> 
                </div>
            <?php
                // query execution
                $results = mysqli_query($conn,$req);
                
                // array to store columns names
                $columnName = array();

                while( $row = mysqli_fetch_array($results) ){
                    $columnName[] = $row['Field'] ;
                };
                // Condition to check if there is data for the date

                // $x for columns name index and $y for columns values index
                for($x = 2 ; $x < count($columnName) ; $x++){

                echo    "<div>
                            <label for=''> ". $columnName[$x] ."</label>
                            <input type='number' min='0' max='100' value='0' name = " .$columnName[$x].">
                        </div>
                        <hr>" ;
                }
                ?>
                <div class="submit">
                    <button class="btn btn-primary" type="submit">Submit form</button>
                </div>
            </form>
        </div>
    </body>
</html>        