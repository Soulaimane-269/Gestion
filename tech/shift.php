<?php
    require"../init.php";
    require"../connexiondb.php";
    session_start();
    //session
    //load variable
$verifier = 0;
    if (!isset($_SESSION["userName"])){
        header("location:../index.php");
    }
    else{$userName=$_SESSION["userName"];
    }
    //les variable
    //date
    $date= date("Y-m-d");
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
    $verifierData = 0 ; 
//si il y'a des donnes deja enregister ce jour la 
    //if elec
    if($typeStr=='electricite'){
        $dbTable = "comptelec";
        $req = "select * from ".$dbTable." where idUser = '".$idUser."' and dateInter ='".$date."'";
        $res = mysqli_query($conn, $req);
        if(mysqli_num_rows($res)>0){
            $verifierData= 1;

        }
    }
    //if gaz
    if($typeStr=='gaz'){
        $dbTable = "comptegaz";
        $req = "select * from ".$dbTable." where idUser = '".$idUser."' and dateInter ='".$date."'";
        $res = mysqli_query($conn, $req);
        if(mysqli_num_rows($res)>0){
            $verifierData= 1;
        }
    }
    $destination='shift-remplir.php';
    $button='Enregister';
    if($verifierData==1){
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
        <link rel="icon" href="<?php echo $srcAdminTech ?>images/favicon.png"/>
        <title>Mon Shift</title>
        <link href="<?php echo"$srcAdminTech"?>css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo"$srcAdminTech"?>css/main/main.css">
        <link href="<?php echo"$srcAdminTech"?>css/tech-shift/tech-shift.css" rel="stylesheet">
        
    </head>
    <body>
        <?php require"../header.php";?>
        <div class="container">
            <form action="<?php echo $destination?>" method="post">
                <div>
                    <h5>Aujourd'hui le <?php echo date("Y-m-d")?></h5> 
                </div>
            <?php
            //si c'est elec
            if($typeStr=='electricite'){
                //valeur int
                $verifierData = 0 ;    
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
                     $verifierData= 1;
                 }

                 if($verifierData==1){
                     //requete pour aficher les chiffres du jour 
                     $req1="SELECT `Rendez-vous`, `Accessible`, `Grip` FROM `".$dbTable."` WHERE idUser=".$idUser." AND dateInter='".$date."'";
                     $exec = mysqli_query($conn,$req1);
                     $res1 = mysqli_fetch_assoc($exec);
                     //array to store values
                         $values= array (
                             2  => $res1['Rendez-vous'],
                             3 => $res1['Accessible'],
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
                                <input type='number' min='0' max='100' value='".$values[$x]."' name = 'champ".$x."'>
                            </div>
                            <hr>" ;
                    }
                }
            //si c'est pour gaz
                    if($typeStr=='gaz'){
                   //valeur int
                   $verifierData = 0 ;    
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
                        $verifierData= 1;
                    }

                    // array to store columns names
                    $columnName = array();
                    
                    while( $row = mysqli_fetch_array($results) ){
                        $columnName[] = $row['Field'] ;
                        };
                        if($verifierData==1){
                        $req1="SELECT `" .$columnName[2]. "` , `".$columnName[3]."` , `".$columnName[4]."` , `".$columnName[5]."` , `".$columnName[6]."` , `".$columnName[7]."` , `".$columnName[8]."` , `".$columnName[9]."` FROM `".$dbTable."` WHERE idUser=".$idUser." AND dateInter='".$date."'";
                        //requete pour aficher les chiffres du jour 
                        $exec = mysqli_query($conn,$req1);
                        $res1 = mysqli_fetch_assoc($exec);
                        //array to store values
                        $values= array (
                            2 => $res1[$columnName[2]],
                            3 => $res1[$columnName[3]],
                            4 => $res1[$columnName[4]],
                            5 => $res1[$columnName[5]],
                            6 => $res1[$columnName[6]],
                            7 => $res1[$columnName[7]],
                            8 => $res1[$columnName[8]],
                            9 => $res1[$columnName[9]],
                        );

                    }else{
                        $values= array (
                            2 => 0,
                            3 => 0,
                            4 => 0,
                            5 => 0,
                            6 => 0,
                            7 => 0,
                            8 => 0,
                            9 => 0,
                            );
                    }

                                        
                    // Condition to check if there is data for the date    
                    // $x for columns name index and $y for columns values index
                    for($x = 2 ; $x < count($columnName) ; $x++){
                    
                    echo    "<div>
                            <label for=''> ". $columnName[$x] ."</label>
                            <input type='number' min='0' max='100' required value='".$values[$x]."' name='champ".$x."'>
                            </div>
                            <hr>" ;
                                        }
                                
                    }
                    // if($verifierData==1){
                    //     echo'
                    // <div class="modal">
                    //     <div class="modal-dialog">
                    //       <div class="modal-content">
                    //           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    //         <div class="modal-body">
                    //           <p>Vous avez déja enregistrer vos chiffres pour aujourd\'hui. Mais vous pouvez toujours les modifier.</p>
                    //         </div>
                    //       </div>
                    //     </div>
                    //   </div>';
                    // }  
                ?>
                <div class="submit">
                    <button class="btn btn-primary button-green" name="submit"  type="submit"><?php echo $button?></button>
                </div>
            </form>
            <?php
            if(isset($_POST['submit'])) $verifier =1;
                require"../load.php" ;
             ?>
        </div>
    </body>
    <script>
    closeBtn = document.querySelector('.btn-close');
    modal = document.querySelector('.modal');
    closeBtn.addEventListener("click", function(){modal.style.display='none';});
    </script>
</html>        