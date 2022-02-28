<?php
//requiered files
 require"init.php" ;
 require"connexiondb.php";
 //type user
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="<?php echo"$srcAdminTech"?>css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo"$srcAdminTech"?>css/main/main.css">
    <link href="<?php echo"$srcAdminTech"?>css/header/header.css" rel="stylesheet">   
</head>
<body>
    <div class="container1">
        <div class="home">
            <a href="index.php"><i class="fa-solid fa-house-chimney"></i></a>
        </div>
        <div class="menu">
        <i class="fa-solid fa-bars"></i>
        </div>
        <nav class="navBar hideNav">
            <span class='close' ><i class="fa-solid fa-xmark"></i></span>
                <ul>
                    <li><a href="index.php">Accueil</a> </li>
                    <li><a href="gestion.php">Gestion</a> </li>
                    <li><a href="chiffres-gaz.php">Chiffres Gaz</a></li>
                    <li><a href="chiffres-elec.php">Chiffres Electricité</a></li>
                    <li><a href="../deconnexion.php">Déconnexion</a></li>
                </ul>
            </nav>
    </div>
</body>
<script src="https://kit.fontawesome.com/d08bc40f73.js" crossorigin="anonymous"></script>
<script>
  const menu=  document.querySelector('.menu');
  const close= document.querySelector('.close i');
  const navBar= document.querySelector('.navBar');
  menu.addEventListener('click',function(){
    navBar.classList.add("showNav");
    navBar.classList.remove("hideNav");
  });
  close.addEventListener('click',function(){
    navBar.classList.add("hideNav");
    navBar.classList.remove("showNav");
  })  
</script>
</html>



