<?php require"../init.php" ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="<?php echo"$srcAdminTech"?>css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo"$srcAdminTech"?>css/tech-elec-overview/tech-elec-overview.css" rel="stylesheet">
        
    </head>
    <body>
        <div>
            <form action="">
                <div class="compteur">
                    <label for="">compteur</label>
                    <input type="number">
                </div>
                <hr>
                <div class="rendez-vous">
                    <label for="">rendez-vous</label>
                    <input type="number">
                </div>
                <hr>
                <div class="accesible">
                    <label for="">accesible</label>
                    <input type="number">
                </div>
                <hr>
                <div class="Grip">
                    <label for="">Grip</label>
                    <input type="number">
                </div>
                <hr>
                <div class="submit">
                    <button class="btn btn-primary" type="submit">Submit form</button>
                </div>
            </form>
        </div>
    </body>
</html>        