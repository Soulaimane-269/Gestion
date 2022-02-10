<?php
session_start();
session_destroy();
echo "Vous êtes deconnecté.....<br>n;ouguygj...";
header("refresh:2;url=connexion.php");

?>