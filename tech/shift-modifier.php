<?php
header('Refresh:2 ; URL=index.php');
require"shift.php";
if($typeStr=='gaz'){
    if( isset($_POST['submit']) && isset($_POST['champ9']) && isset($_POST['champ2']) && isset($_POST['champ3']) && isset($_POST['champ4']) && isset($_POST['champ5']) && isset($_POST['champ6']) && isset($_POST['champ7']) && isset($_POST['champ8'])){
        $champ1 = $_POST['champ2'];
        $champ2 = $_POST['champ3'];
        $champ3 = $_POST['champ4'];
        $champ4 = $_POST['champ5'];
        $champ5 = $_POST['champ6'];
        $champ6 = $_POST['champ7'];
        $champ7 = $_POST['champ8'];
        $champ8 = $_POST['champ9'];
        //requete modify
        $req ="UPDATE comptegaz SET `".$columnName[2]."` = ".$champ1.", `".$columnName[3]."` = ".$champ2.", `".$columnName[4]."` = ".$champ3.", `".$columnName[5]."` = ".$champ4.", `".$columnName[6]."` = ".$champ5.", `".$columnName[7]."` = ".$champ6.", `".$columnName[8]."` = ".$champ7.", `".$columnName[9]."` = ".$champ8."  WHERE idUser =".$idUser." AND dateInter='".$date."' ";          
        $res = mysqli_query($conn,$req);
    }
}elseif($typeStr=='electricite'){

    if(isset($_POST['champ2']) && isset($_POST['champ3']) && isset($_POST['champ4'])){
        //storing in variables
        $rendezVous = $_POST['champ2'];
        $accesible = $_POST['champ3'];
        $grip = $_POST['champ4'];
        //requete modify
        $req ="UPDATE comptelec SET `Rendez-vous`= ".$rendezVous.", `Accessible`=".$accesible.", `Grip`=".$grip." WHERE idUser =".$idUser." AND dateInter='".$date."' ";          
        $res = mysqli_query($conn,$req);
} 
}