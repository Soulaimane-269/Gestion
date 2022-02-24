<?php require"../../init.php" ;
      require"../../header.php";
      //connection de la base de données 
      require"../../connexiondb.php";
    //id 
    $id=$_GET["id"];
    //conditionn
    if(!empty($_POST['name']) && !empty($_POST['firstName']) && !empty($_POST['secteur']) && !empty($_POST['userName']) && !empty($_POST['passWord']) ){   
    //les variable
     $name= $_POST['name'];
     $firstName= $_POST['firstName'];
     $secteur = $_POST['secteur'];
     $userName= $_POST['userName'];
     $passWord= $_POST['passWord'];
     $secret= "123".sha1($userName);
  
    
    //crypter le password                                
    $passWord="123".sha1($passWord);
    if (isset($_POST['submit'])  ){
        header('Refresh:1 ; URL=voir.php?id='.$id.'');

    }
    
    //requete modify
    $req ="UPDATE users SET name = '".$name."',firstName='".$firstName."',type='".$secteur."',userName='".$userName."', passWord='".$passWord."' ,secret='".$secret."' WHERE id =".$id." ";   
    $res = mysqli_query($conn,$req);
    
    
    }
    
    
    


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="<?php echo "$srcGestionChiffres"?>css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo"$srcGestionChiffres"?>css/main/main.css">
        <link href="<?php echo "$srcGestionChiffres"?>css/modifier/modifier.css" rel="stylesheet">
        
    </head>
    <body>
        <div class="container">
            <?php
            
            //the id
                $id=$_GET["id"];
            //type
                $type = $conn->query("SELECT type FROM users WHERE id=".$id."");
                if (mysqli_num_rows($type) > 0) {
                    while($rowData = mysqli_fetch_array($type)){
                    $typeStr=$rowData["type"];
                    }

                
                    };
                //the req
                $req="SELECT * FROM users WHERE id= ".$id." ";
                //exec
                $exec = mysqli_query($conn,$req);
                $res = mysqli_fetch_assoc($exec);
                ?>
                <!--the form-->                    
                <form method="post" action="" class="row g-3 needs-validation" novalidate>
                        <div class="">
                            <label for="validationCustom01" class="form-label">Nom</label>
                            <input name="name" type="text" class="form-control" id="validationCustom01" value="<?php echo $res["name"]?>" required>
                        </div>
                        <div class="">
                            <label for="validationCustom02" class="form-label">prenom</label>
                            <input name="firstName" type="text" class="form-control" id="validationCustom02" value="<?php echo $res["firstName"]?>" required>
                        </div>
                        <div class="">
                            <label for="validationCustom04" class="form-label">Secteur</label>
                            <select name="secteur" class="form-select" id="validationCustom04" required>
                                <?php
                                    if($typeStr=='electricite')echo"{
                                        <option  value='gaz'>Gaz</option>
                                        <option selected value='electricite' >Electricite</option>
                                    }";
                                    elseif($typeStr=='gaz') echo"{
                                        <option selected value='gaz'>Gaz</option>
                                        <option value='electricite' >Electricite</option>
                                    }";
                                ?>
                            </select>

                        </div>
                        <div class="">
                            <label for="validationCustomUsername" class="form-label">Identifiant</label>
                            <div class="input-group has-validation">
                            <input name="userName" value ="<?php echo $res["userName"]?>" type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                            </div>
                        </div>
                        <div class="">
                            <label for="validationCustom02" class="form-label">mot de passe</label>
                            <input placeHolder="Entrer un nouveau mots de passe" name='passWord' value ="" type="text" class="form-control" id="validationCustom02" required>
                        </div>

                        <div class="col-12">
                            <button class=" button-green btn btn-primary" type="submit" name='submit'>Enregister les modifications</button>
                        </div>
                    </form>
                    
            
        </div>
    </body>    
</html>    