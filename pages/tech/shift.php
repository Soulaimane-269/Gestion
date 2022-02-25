<?php
    require"../init.php";
    require"../header.php";
    require"../connexiondb.php";
    session_start();
    //session

    if (!isset($_SESSION["userName"])){
        header("location:../connexion.php");
    }
    else{$userName=$_SESSION["userName"];
    }
    //les variable
    //date
    $date= date("j, n, Y");
    //id
    $id = $conn->query("SELECT id FROM users WHERE userName='".$userName . "'");
    if (mysqli_num_rows($id) > 0) {
        while($rowData = mysqli_fetch_array($id)){
              $idInt= (int)$rowData["id"];
              
        }

    }
    //le type
    $type = $conn->query("SELECT type FROM users WHERE userName='".$userName . "'");
    if (mysqli_num_rows($type) > 0) {
        while($rowData = mysqli_fetch_array($type)){
              $typeStr=$rowData["type"];
        } 
    }


    $idUser = $idInt;
//valeur int
    $verifier = 0 ; 
//si il y'a des donnes deja enregister ce jour la 
    //if elec
    if($typeStr=='electricite'){
        $dbTable = "comptelec";
        $req = "select * from ".$dbTable." where idUser = '".$idUser."' and dateInter ='".$date."'";
        $res = mysqli_query($conn, $req);
        if(mysqli_num_rows($res)>0){
            $verifier= 1;

        }
    }
    //if gaz
    if($typeStr=='gaz'){
        $dbTable = "comptegaz";
        $req = "select * from ".$dbTable." where idUser = '".$idUser."' and dateInter ='".$date."'";
        $res = mysqli_query($conn, $req);
        if(mysqli_num_rows($res)>0){
            $verifier= 1;
        }
    }
    $destination='shift-remplir.php';
    $button='Enregister';
    if($verifier==1){
        $destination='shift-modifier.php';
        $button='Enregistre les modification';
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
        <link href="<?php echo"$srcAdminTech"?>css/tech-shift/tech-shift.css" rel="stylesheet">
        
    </head>
    <body>
        <div class="container">
            <form action="<?php echo $destination?>" method="post">
                <div>
                    <h5>Aujourd'hui le <?php echo date("Y-m-d")?></h5> 
                </div>
            <?php
            //si c'est elec
            if($typeStr=='electricite'){
                //valeur int
                $verifier = 0 ;    
                //table     
                 $dbTable = "comptelec";
                 // mysql query to get columns name
                 $req = "SHOW COLUMNS FROM " . $dbTable;
                 // query execution
                 $results = mysqli_query($conn,$req);
                 //pour savoir si il y'a deja des valeurs 
                 $req = "select * from ".$dbTable." where idUser = '".$idUser."' and dateInter ='".$date."'";
                 $res = mysqli_query($conn, $req);
                 if(mysqli_num_rows($res)>0){
                     $verifier= 1;
                 }

                 if($verifier==1){
                     //requete pour aficher les chiffres du jour 
                     $req1="SELECT RendezVous, Accesible, Grip FROM `".$dbTable."` WHERE idUser=".$idUser." AND dateInter='".$date."'";
                     $exec = mysqli_query($conn,$req1);
                     $res1 = mysqli_fetch_assoc($exec);
                     //array to store values
                         $values= array (
                             2  => $res1['RendezVous'],
                             3 => $res1['Accesible'],
                             4 => $res1['Grip'],
                             );

                 }else{
                     $values= array (
                         2  => 0,
                         3 => 0,
                         4 => 0,
                         );

                 }
                    
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
                                <input type='number' min='0' max='100' value='".$values[$x]."' name = " .$columnName[$x].">
                            </div>
                            <hr>" ;
                    }
                }
            //si c'est pour gaz
                    if($typeStr=='gaz'){
                   //valeur int
                   $verifier = 0 ;    
                   //table     
                    $dbTable = "comptegaz";
                    // mysql query to get columns name
                    $req = "SHOW COLUMNS FROM " . $dbTable;
                    // query execution
                    $results = mysqli_query($conn,$req);
                    //pour savoir si il y'a deja des valeurs 
                    $req = "select * from ".$dbTable." where idUser = '".$idUser."' and dateInter ='".$date."'";
                    $res = mysqli_query($conn, $req);
                    if(mysqli_num_rows($res)>0){
                        $verifier= 1;
                    }

                    if($verifier==1){
                        //requete pour aficher les chiffres du jour 
                        $req1="SELECT Rendez_vous, Sans_rendez_vous, Module , Detendeur FROM `".$dbTable."` WHERE idUser=".$idUser." AND dateInter='".$date."'";
                        $exec = mysqli_query($conn,$req1);
                        $res1 = mysqli_fetch_assoc($exec);
                        //array to store values
                            $values= array (
                                2  => $res1['Rendez_vous'],
                                3 => $res1['Sans_rendez_vous'],
                                4 => $res1['Module'],
                                5 => $res1['Detendeur'],
                                );

                    }else{
                        $values= array (
                            2  => 0,
                            3 => 0,
                            4 => 0,
                            5 =>0,
                            );
                    }

                                        
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
                            <input type='number' min='0' max='100' value='".$values[$x]."' name = " .$columnName[$x].">
                            </div>
                            <hr>" ;
                                        }
                                
                    }
                    if($verifier==1){
                        echo'
                    <div class="modal">
                        <div class="modal-dialog">
                          <div class="modal-content">
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="modal-body">
                              <p>Vous avez déja enregistrer vos chiffres pour aujourd\'hui. Mais vous pouvez toujours les modifier.</p>
                            </div>
                          </div>
                        </div>
                      </div>';
                    }  

                

                ?>
                <div class="submit">
                    <button class="btn btn-primary button-green" type="submit"><?php echo $button?></button>
                </div>
            </form>
        </div>
    </body>
    <script>
    closeBtn = document.querySelector('.btn-close');
    modal = document.querySelector('.modal');
    closeBtn.addEventListener("click", function(){modal.style.display='none';});
    </script>
</html>        