<?php
header('Refresh:2 ;URL=index.php')  ; 
require"shift.php";
                // form submition

                if($typeStr=='gaz'){
                        $date = date('Y-m-d');
                        $champ1 = $_POST['champ2'];
                        $champ2 = $_POST['champ3'];
                        $champ3 = $_POST['champ4'];
                        $champ4 = $_POST['champ5'];
                        $champ5 = $_POST['champ6'];
                        $champ6 = $_POST['champ7'];
                        $champ7 = $_POST['champ8'];
                        $champ8 = $_POST['champ9'];  
                        if(isset($date) && isset($champ1) && isset($champ2) && isset($champ3) && isset($champ4) & isset($champ5) & isset($champ6) & isset($champ7) & isset($champ8)){
                            $verifier=1;
                            //msyql query to insert values
                            $req2= "insert into ". $dbTable. " values ( ".$idUser.", '" . $date . "', '" . $champ1 . "', '" . $champ2 . "', '" . $champ3 . "', '" . $champ4 . "' , '" . $champ5 . "', '" . $champ6 . "', '" . $champ7 . "', '" . $champ8 . "')";
                            $results = mysqli_query($conn,$req2);                        
                        } 

                    }

                    else{
                        $date = date('Y-m-d');
                        $rdv = $_POST['champ2'];
                        $accSans = $_POST['champ3'];
                        $gripMod = $_POST['champ4']; 
                        if(isset($date) && isset($rdv) && isset($accSans) && isset($gripMod) ){
                            $verifier=1;
                            //msyql query to insert values
                            $req2= "insert into ". $dbTable. " values ( ".$idUser.", '" . $date . "', '" . $rdv . "', '" . $accSans . "', '" . $gripMod . "')";
                            $results = mysqli_query($conn,$req2);                        
                        } 
                    }

                ?>