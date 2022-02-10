<?php
//requiered files
 require"init.php" ;
 require"connectionbd.php";
 //
 session_start(); 

 if (!empty($_POST['userName']) && !empty($_POST['passWord'])){

    //les variables
    $userName=$_POST['userName'];
    $passWord=$_POST['passWord'];
    //crypter le password
    // $passWord="123".sha1($passWord);
    //type
    $type = $id->query("SELECT type FROM users WHERE userName='".$userName . "'");
    if (mysqli_num_rows($type) > 0) {
        while($rowData = mysqli_fetch_array($type)){
              $typeStr=$rowData["type"];
        }

    }

    //connection
    $req = "select * from users where userName = '".$userName."' and passWord ='".$passWord."'";
    $res = mysqli_query($id, $req);
     if(mysqli_num_rows($res)>0){
         if($typeStr=='admin'){
             //admin
             $_SESSION["userName"] = $userName;
             header("location:admin/index.php");
           }
           //tech
           elseif($typeStr=='gaz' or $typeStr=='electricite'){
            header("location:tech/index.php");
           }
        }else{
            echo "Erreur de pseudo ou de mot de passe.";
          
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
    <link rel="stylesheet" href="<?php echo"$srcPages"?>css/main.css">
    <link href="<?php echo"$srcPages"?>css/connexion/style.css" rel="stylesheet">
    
</head>
<body>
    <div class="test">
        <div class="container">
            <!--image1-->  
            <div class="container"  >
                <img  src="<?php echo"$srcPages"?>images/logowebsite.png" alt="">
            </div>
            <div calss="container">
                <form method='post' action='connexion.php' > 
                <!--image2-->    
                <img  src="<?php echo"$srcPages"?>images/User_icon.png"> 
                <!--le formulaire-->
                <div class="mb-3">
                    <input name="userName"  type="text" class=" styled-input form-control " placeholder="Identifiant" >     
                <div class="mb-3">
                    <input name="passWord" type="password" class="styled-input form-control" placeholder="Mot de pass" >
                </div>
                <div class="mb-3 form-check" id="input3">
                    <input id="input3" type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1 text-lowercase"> Se souvener de moi</label>
                </div>
                <button id="button" type="submit" class="btn  mx-auto d-block">Se connecter</button>
                </form>
            </div>
        </div> 
    </div>
    <script src="/application-master/src/js/bootstrap.min.js"></script>     
</body>

</html>
