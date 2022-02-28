<?php

//variables
$servername = "localhost";
$username = "root";
$password = "";
$dbName ='gestion';
// connection a la bdd
$conn = new mysqli($servername, $username, $password,$dbName);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}





