<?php
require"journal-modifier.php";
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
    
    

}



