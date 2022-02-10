<?php
require"tech-shift.php";
                // form submition
                        $date = date('Y-m-d');
                        $rdv = $_POST[$columnName[2]];
                        $accSans = $_POST[$columnName[3]];
                        $gripMod = $_POST[$columnName[4]]; 
                        if(isset($date) && isset($rdv) && isset($accSans) && isset($gripMod) ){
                            //msyql query to insert values
                            $req2= "insert into ". $dbTable. " values ( ".$idInt.", '" . $date . "', '" . $rdv . "', '" . $accSans . "', '" . $gripMod . "')";
                            $results = mysqli_query($conn,$req2);
                            echo"Succès";   
                            header('Refresh:2 ; URL=index.php')     ;                         
                        } 

                ?>