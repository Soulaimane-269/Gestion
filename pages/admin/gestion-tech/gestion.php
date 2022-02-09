<?php

//init
 require"../../init.php";

//connection de la base de données 
 require"../../connectionbd.php";

//conditionn
 if(!empty($_POST['name']) && !empty($_POST['firstName']) && !empty($_POST['secteur']) && !empty($_POST['userName']) && !empty($_POST['passWord']) ){
//les variable
 $name= $_POST['name'];
 $firstName= $_POST['firstName'];
 $secteur= $_POST['secteur'];
 $userName= $_POST['userName'];
 $passWord= $_POST['passWord'];
 $secret= "123".sha1($userName);

 //crypter le password
$passWord="123".sha1($passWord);

//requete insert
$req ="INSERT INTO users (id,name,firstName,type,userName, passWord ,secret) VALUES (id,'$name','$firstName' ,'$secteur','$userName','$passWord','$secret')";
echo $name . $firstName . $secret .$secteur;
$db ->exec($req);
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
        <link rel="stylesheet" href="<?php echo"$srcGestionChiffres"?>css/main.css">
        <link href="<?php echo "$srcGestionChiffres"?>css/gestion/gestion.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="<?php echo "$srcGestionChiffres"?>js/toggle-page.js" ></script>
        
    </head>
    <body>
      <!---->
      <div class="container">
        
        <div class="page1">
          <table class="table table-striped">
          <div class="flex">
        <button class="btn btn-lg col-5">Tous</button>
        <button class="btn btn-lg col-5">créer un profil</button>
        </div>
        <!--premiere page-->
            <tbody>
              <tr>
                <td>utilisateur1</td>
                <td><a href="voir.php">voir le profil</a></td>

              </tr>
              <tr>
                <td>utilisateur2</td>
                <td><a href="voir.php">voir le profil</a></td>
              </tr>
              <tr>
                <td>utilisateur3</td>
                <td ><a href="voir.php">voir le profil</a></td>
              </tr>
            </tbody>
          </table> 
        </div> 
        <!--deuzieme page-->
        <div class="page2">
          <!--le formulaire-->
          <form method="post" action="gestion.php" class=" row g-3 needs-validation" novalidate>
                <div class="">
                    <label for="validationCustom01" class="form-label">Nom</label>
                    <input name="name" type="text" class="form-control" id="validationCustom01" value="" required>
                </div>
                <div class="">
                    <label for="validationCustom02" class="form-label">prenom</label>
                    <input name="firstName" type="text" class="form-control" id="validationCustom02" value="" required>
                </div>
                <div class="">
                    <label for="validationCustom04" class="form-label">Secteur</label>
                    <select name="secteur" class="form-select" id="validationCustom04" required>
                        <option  value="Gaz">Gaz</option>
                        <option value="Eletricite">Electricite</option>
                    </select>

                </div>
                <div class="">
                    <label for="validationCustomUsername" class="form-label">Identifiant</label>
                    <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                    <input name="userName" type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                    </div>
                </div>
                <div class="">
                    <label for="validationCustom02" class="form-label">mot de passe</label>
                    <input name="passWord" type="text" class="form-control" id="validationCustom02" value="" required>
                </div>
                <div class="col-12">
                    <input class="btn btn-primary" type="submit" value="Enregister">
                </div>
          </form>
        </div>
      </div>   
    </body>
</html>        