<?php
//requiered files
 require"init.php" ;
 require"connexiondb.php";
 
 //type user
 $type = $conn->query("SELECT type FROM users WHERE userName='".$_SESSION["userName"] . "'");
    if (mysqli_num_rows($type) > 0) {
        while($rowData = mysqli_fetch_array($type)){
              $typeStr=$rowData["type"];
        }
      }
  // condition to check URL 
  function linkCheck( $section ,$link){
   if($_SERVER['REQUEST_URI']==='/'.$section.'/'.$link) echo "activeLink";
  };
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
              <li><a href="index.php" class="<?php if($_SERVER['REQUEST_URI']==='/admin/index.php'or $_SERVER['REQUEST_URI']==='/tech/index.php') echo "activeLink"; ?>">Accueil</a> </li>
              <?php 
              // dynamic nav bar with dynamic active links
                    if($typeStr ==='admin'){
                    echo' <li><a class="' ;
                    echo linkCheck('admin','chiffres-gaz.php').'" href="chiffres-gaz.php" >Gaz</a> </li>
                    <li><a class="'; echo linkCheck('admin','chiffres-elec.php').' " href="chiffres-elec.php">Électricité</a></li>
                    <li><a class="'; echo linkCheck('admin','gestion.php').' " href="gestion.php">Gérer les profils</a></li>';
                    }else{
                    echo' <li><a class="'; echo linkCheck('tech','shift.php').' " href="shift.php">Mon shift</a> </li>
                    <li><a class="'; echo linkCheck('tech','journal.php').'"  href="journal.php">Mon journal</a></li>
                    <li><a class="'; echo linkCheck('tech','chiffres-mois.php').' " href="chiffres-mois.php">Mes chiffres</a></li>';
                    } 
                    ?>
                    <li><a class=" btn btn-primary button-white" href="../deconnexion.php">Déconnexion</a></li>
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



