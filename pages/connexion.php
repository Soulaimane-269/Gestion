<?php require"init.php" ?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="<?php echo"$srcPages"?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo"$srcPages"?>css/connexion/style.css" rel="stylesheet">
    
</head>
<body>
    <div class="test">
        <div class="container">
            <div class="container"  >
                <img  src="<?php echo"$srcPages"?>images/logowebsite.png" alt="">
            </div>
            <div calss="container">
                <form > 
                
                <img  src="<?php echo"$srcPages"?>images/User_icon.png"> 
                
                <div class="mb-3">
                    <input  type="email" class=" styled-input form-control " placeholder="Identifiant" >
                    
                <div class="mb-3">
                    <input type="password" class="styled-input form-control" placeholder="Mot de pass" >
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
