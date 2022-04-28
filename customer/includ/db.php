<?php 
//--------------------------------------------------------------------
//Database Connect
//--------------------------------------------------------------------


$servername = "localhost";
$username = "shristic_prism";
$password = "prism";
$databaseName= "shristic_ecommerce";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$databaseName", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

?>

