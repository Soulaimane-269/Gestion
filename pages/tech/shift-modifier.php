<?php
require"shift.php";
if($typeStr=='gaz'){
    if(isset($_POST['Rendez_vous']) && isset($_POST['Sans_rendez_vous']) && isset($_POST['Module']) && isset($_POST['Detendeur']) ){
        //storing in variables
        $rendezVous = $_POST['Rendez_vous'];
        $sansRendezVous = $_POST['Sans_rendez_vous'];
        $module = $_POST['Module'];
        $detendeur= $_POST['Detendeur'];
        //requete modify
        $req ="UPDATE " . $dbTable . " SET Rendez_vous = ".$rendezVous.", Sans_rendez_vous=".$sansRendezVous.", Module=".$module.",Detendeur=".$detendeur." WHERE idUser =".$idUser." AND dateInter='".$date."' ";          
        $res = mysqli_query($conn,$req);
        header('Refresh:0 ; URL=rederiger-shift-modifier.php');;
        
    }
}elseif($typeStr=='electricite'){

    if(isset($_POST['Rendezvous']) && isset($_POST['Accesible']) && isset($_POST['Grip'])){
        //storing in variables
        $rendezVous = $_POST['Rendezvous'];
        $accesible = $_POST['Accesible'];
        $grip = $_POST['Grip'];

        //requete modify
        $req ="UPDATE comptelec SET Rendezvous = ".$rendezVous.", Accesible=".$accesible.", Grip=".$grip." WHERE idUser =".$idUser." AND dateInter='".$date."' ";          
        $res = mysqli_query($conn,$req);
        header('Refresh:0 ; URL=rederiger-shift-modifier.php');


} 
}