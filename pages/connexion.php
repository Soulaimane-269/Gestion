<?php


//requiered files 
 require"init.php" ;
 require"connexiondb.php";
 //
 session_start(); 

 if (!empty($_POST['userName']) && !empty($_POST['passWord'])){

    //les variables
    $userName=$_POST['userName'];
    $passWord= $_POST['passWord'];
    //crypter le password                               
     $passWord="123".sha1($passWord);
    //type
    $type = $conn->query("SELECT type FROM users WHERE userName='".$userName . "'");
    if (mysqli_num_rows($type) > 0) {
        while($rowData = mysqli_fetch_array($type)){
              $typeStr=$rowData["type"];
        }

    }

    //connection
    $req = "select * from users where userName = '".$userName."' and passWord ='".$passWord."'";
    $res = mysqli_query($conn, $req);
     if(mysqli_num_rows($res)>0){
         if($typeStr=='admin'){
             //admin
             $_SESSION["userName"] = $userName;
             $_SESSION["type"] = $typeStr;
             header("location:admin/index.php");
           }
           //tech
           elseif($typeStr=='gaz' or $typeStr=='electricite'){
            $_SESSION["userName"] = $userName;
            $_SESSION["type"] = $typeStr;

            header("location:tech/index.php");
           }
        }else{
            echo '<div class="modal" style="display:block; background: rgba(0,0,O,0.5)">
            <div class="modal-dialog">
              <div class="modal-content">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                  <p> Erreur Mot de passe ou Identifiant .</p>
                </div>
              </div>
            </div>
          </div>';        
        }
} 
 

    

?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="<?php echo"$srcPages"?>css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo"$srcPages"?>css/main/main.css">
    <link href="<?php echo"$srcPages"?>css/connexion/style.css" rel="stylesheet">
    
</head>
<body>
    <div class="container">
        <div class="overlay">
        <!--image1-->  
        <div>
                <img  src="<?php echo"$srcPages"?>images/logo.svg" alt="">
        </div>
        <div>
                <form method='post' action='connexion.php' > 
                <!--image2-->    
                <img  src="<?php echo"$srcPages"?>images/User_icon.png"> 
                <!--le formulaire-->
                <div class="mb-3">
                    <input name="userName"  type="text" class=" styled-input form-control " placeholder="Identifiant" >     
                <div class="mb-3">
                    <input name="passWord" type="password" class="styled-input form-control" placeholder="Mot de pass" >
                </div>
                <button type="submit" class="btn  btn-primary button-white">Se connecter</button>
                </form>
        </div>
        </div>
    </div>
    <script src="/application-master/src/js/bootstrap.min.js"></script>     
</body>
<script>
    closeBtn = document.querySelector('.btn-close');
    modal = document.querySelector('.modal');
    closeBtn.addEventListener("click", function(){modal.style.display='none';});
</script>
</html>
