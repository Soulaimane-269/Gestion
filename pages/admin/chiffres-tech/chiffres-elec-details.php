<?php require"../../init.php";  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS files -->
    <link rel="stylesheet" href="<?php echo"$srcGestionChiffres"?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo"$srcGestionChiffres"?>css/main.css">
    <link rel="stylesheet" href="<?php echo"$srcGestionChiffres"?>css/chiffres-details/chiffres-details.css">
    <title>Chiffres en détails</title>
</head>
<body>
    <!-- header -->
    <div class="container">
        <div class="head">
            <div><button class="btn btn-outline-success"><</button></div><h4>Janvier</h4><div><button class="btn btn-outline-success">></button></div>
        </div>
        <div class="body-wrapper">
            <div class="container">
                <h1>Tech Nom</h1>
                <div class="oval oval-1">
                    <div class="fs-2 text">369</div>
                    <h6>Compteurs</h6>
                </div>
                <div class="oval oval-2">
                    <div>19.3</div>
                    <h6>par jours</h6>
                </div>
            </div>
        </div>
    </div>
</body>
</html>