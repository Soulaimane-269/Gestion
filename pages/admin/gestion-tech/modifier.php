<?php require"../../init.php" ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="<?php echo "$srcGestionChiffres"?>css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo "$srcGestionChiffres"?>css/modifier/modifier.css" rel="stylesheet">
        
    </head>
    <body>
        <form class="row g-3 needs-validation" novalidate>
            <div class="">
                <label for="validationCustom01" class="form-label">Nom</label>
                <input type="text" class="form-control" id="validationCustom01" value="" required>
            </div>
            <div class="">
                <label for="validationCustom02" class="form-label">prenom</label>
                <input type="text" class="form-control" id="validationCustom02" value="" required>
            </div>
            <div class="">
                <label for="validationCustom04" class="form-label">Secteur</label>
                <select class="form-select" id="validationCustom04" required>
                    <option selected disabled value="">Gaz</option>
                    <option>Electricite</option>
                </select>

            </div>
            <div class="">
                <label for="validationCustomUsername" class="form-label">Identifiant</label>
                <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend">@</span>
                <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
                </div>
            </div>
            <div class="">
                <label for="validationCustom02" class="form-label">mot de passe</label>
                <input type="text" class="form-control" id="validationCustom02" value="" required>
            </div>

            <div class="col-12">
                <button class="btn btn-primary" type="submit">Enregister</button>
            </div>
    </form>
    </body>    
</html>    