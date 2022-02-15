<?php require"../../init.php" ;
      require"../../header.php";
      //connection de la base de données 
      require"../../connexiondb.php";
      
    //id
    $id=$_GET["id"];

    if(isset($_POST["submit"])){
        $req ="DELETE FROM users WHERE id = ".$id."";
        $res = mysqli_query($conn,$req);
        header("refresh:2;url=gestion.php");
        echo 'succes';
    }
    ?>
 <form method="post" >
    <button name="submit" type="submit">confirmer</button>   
</form>   