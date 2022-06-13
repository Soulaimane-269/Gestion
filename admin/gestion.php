<?php

//init
 require"../init.php";

//connection de la base de données 
 require"../connexiondb.php";
 $verifierUserName=0;

 session_start();
 if (!isset($_SESSION["userName"])){
  header("location:../index.php");
}
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

//userName check
$req="SELECT * FROM users WHERE userName='".$userName."'";
$res=mysqli_query($conn,$req);
if(mysqli_num_rows($res)>0){
  $verifierUserName= 1;
}

  //requete insert
  if($verifierUserName==0){
  $req ="INSERT INTO users (id,name,firstName,type,userName, passWord ,secret) VALUES (id,'$name','$firstName' ,'$secteur','$userName','$passWord','$secret')";
  $res = mysqli_query($conn,$req);
  }
}
else{
  if(isset($_POST['submit']))
  $verifierUserName=1;

}


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="<?php echo $srcAdminTech ?>images/favicon.png"/>
        <title>Gérer les Profils</title>
        <link href="<?php echo "$srcAdminTech"?>css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo"$srcAdminTech"?>css/main/main.css">
        <link href="<?php echo "$srcAdminTech"?>css/gestion/gestion.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="<?php echo "$srcAdminTech"?>js/toggle-page.js" defer ></script>
        
    </head>
    <body>
    <?php require"../header.php";?>
      <!---->
      <div class="container">
        
        <!--slider-->
          <div class="flex">
            <button class="button1 btn btn-lg col-5 activeBtn">Tous</button>
            <button class="button2 btn btn-lg col-5">Créer un profil</button>
          </div>
        <!--premiere page-->
        <div class="page1">
          <table class="table table-hover ">
            <tbody >
              <?php
              //la table
               $dbTable = "users";
               //req to select the ids and the usernames
               $req = "SELECT id , userName, type FROM ".$dbTable;

               // query execution
               $results = mysqli_query($conn,$req);
               
               // array to store usersName
               $usersName = array();
               $type = array();

               while( $row = mysqli_fetch_array($results) ){
                 //storing the username
                $usersName[] = $row['userName'];
                $type[] = $row['type'];
                //sroring the id
                $id[]= $row['id'];
               };
                  
               // the loop
               for($x = 0 ; $x < count($usersName) ; $x++){
                 if($type[$x] !== 'admin'){
                 echo"
              <tr>
                <td><h2 class='userName'>".$usersName[$x]."</h2></td>
                <td><a class='voirLeProfil' href='voir.php?id=".$id[$x]."'>voir le profil</a></td>
              </tr>";
              }
            }
              ?>
            </tbody>
          </table> 
        </div> 
        <!--deuzieme page-->
        <div class="page2 hidden">
          <!--le formulaire-->
          <div class="formulaire">
            <form method="post" action="gestion.php?created=1" class=" row g-3 needs-validation">
                  <div class="input">
                      <label for="validationCustom01" class="form-label">Nom</label>
                      <input name="name" type="text" class="form-control" id="validationCustom01" value="" required>
                  </div>
                  <div class="input">
                      <label for="validationCustom02" class="form-label">Prénom</label>
                      <input name="firstName" type="text" class="form-control" id="validationCustom02" value="" required>
                  </div>
                  <div class="input">
                      <label for="validationCustom04" class="input form-label">Secteur</label>
                      <select name="secteur" class="form-select" id="validationCustom04" required>
                          <option  value="Gaz">Gaz</option>
                          <option value="Electricite">Electricite</option>
                          <option value="Admin">Admin</option>
                      </select>

                  </div>
                  <div class="input">
                      <label for="validationCustomUsername" class="form-label">Identifiant</label>
                      <div class="input-group has-validation">
                      <input name="userName" type="text" class="input form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                      </div>
                  </div>
                  <div class="button">
                      <label for="validationCustom02" class="form-label">Mot de passe</label>
                      <input name="passWord" type="text" class="input form-control" id="validationCustom02" value="" required>
                  </div>
                  <div class="col-12">
                      <input name="submit" class="button-green btn btn-primary" type="submit" value="Enregister">
                  </div>
              </form>
            </div>
            <!--bouton de deconnexion-->
            <div>
          
            </div>
      </div> 
      <?php
      // ********modals**********
      // delete
      $deleted = (isset($_GET['deleted'])) ? $_GET['deleted']  : 0;
      if($deleted){
        echo'
        <div class="modal" style="display:block;">
            <div class="modal-dialog">
              <div class="modal-content">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                  <p>Utilisateur supprimé.</p>
                </div>
              </div>
            </div>
        </div>';
       };
      
      // ************* username already taken ***********
      $created = (isset($_GET['created'])) ? $_GET['created']  : 0;
      $modalContent = ($verifierUserName==1) ? "Cet identifiant est deja utilisé." : "Utilisateur créer avec succès";
      if($verifierUserName==1 or $created == 1){
          echo'
           <div class="modal" style="display:block;" >
               <div class="modal-dialog">
                 <div class="modal-content">
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   <div class="modal-body">
                     <p> '.$modalContent.'</p>
                   </div>
                 </div>
               </div>
           </div>';
          }
          ?> 
      </div> 
      <script>
       closeBtn = document.querySelector('.btn-close');
       modal = document.querySelector('.modal');
       closeBtn.addEventListener("click", function(){modal.style.display='none';});
       modal.addEventListener("click", function(){modal.style.display='none';});
       </script>
    </body>
</html>        