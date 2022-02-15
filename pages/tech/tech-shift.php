<?php
    require"../init.php";
    require "../header.php";
    require"../connexiondb.php";
    session_start();
    //session

    if (!isset($_SESSION["userName"])){
        header("location:../connexion.php");
    }
    else{$userName=$_SESSION["userName"];
        echo $userName;}
    //les variable
    //id
    $id = $conn->query("SELECT id FROM users WHERE userName='".$userName . "'");
    if (mysqli_num_rows($id) > 0) {
        while($rowData = mysqli_fetch_array($id)){
              $idInt= (int)$rowData["id"];
              echo $idInt;
              
        }

    }
    //le type
    $type = $conn->query("SELECT type FROM users WHERE userName='".$userName . "'");
    if (mysqli_num_rows($type) > 0) {
        while($rowData = mysqli_fetch_array($type)){
              $typeStr=$rowData["type"];
        } 
    }


?>
<!-- recuperation des données -->
<?php  
    $idUser = $idInt;
    $dbTable = "comptelec";

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
                    //si c'est pour gaz
                    if($typeStr=='gaz'){
                    $dbTable = "comptegaz";
                    
                }


                     // mysql query to get columns name
                    $req = "SHOW COLUMNS FROM " . $dbTable;

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