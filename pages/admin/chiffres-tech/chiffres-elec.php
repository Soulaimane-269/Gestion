<?php require"../../init.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS files -->
    <link rel="stylesheet" href="<?php echo"$srcGestionChiffres"?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo"$srcGestionChiffres"?>css/main.css">
    <link rel="stylesheet" href="<?php echo"$srcGestionChiffres"?>css/chiffres/chiffres.css">
    <title>Chiffres Eléctricité</title>
</head>
<body>
    <div class="container">
        <!-- header -->
        <div class="head">
        <div><button class="btn btn-outline-success"><</button></div><h4>Janvier</h4><div><button class="btn btn-outline-success">></button></div>
        </div>
        <!-- Main Table -->
        <table class="table table-striped">
        <div class="flex">
        <button class="btn  btn-lg col-5">Tous</button>
        <button class="btn  btn-lg col-5">Chiffre par technicien</button>
        </div>
            <tbody>
                <tr>
                <th scope="row">Totale des Compteures</th>
                <td>451</td>
                </tr>
                <tr>
                <th scope="row">Avec rendez-vous</th>
                <td>319</td>
                </tr>
                <tr>
                <th scope="row">Grip</th>
                <td >23</td>
                </tr>
                <tr>
                <th scope="row">Accessible</th>
                <td >2</td>
                </tr>
            </tbody>
            <!-- Tbody Tech -->
            <tbody >
                <tr>
                <th scope="row" colspan="2"><button class="btn ">Tech 1</button></th>
                </tr>
                <tr>
                <th scope="row" colspan="2"><button class="btn">Tech 2</button></th>
                </tr>
                <tr>
                <th scope="row" colspan="2"><button class="btn">Tech 3</button></th>
                </tr>
                <tr>
                <th scope="row" colspan="2"><button class="btn">Tech 4</button></th>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>