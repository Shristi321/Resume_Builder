<?php 
//--------------------------------------------------------------------
//Database Connect
//--------------------------------------------------------------------

$servername = "localhost";
$username = "root";
$password = "";
$databaseName= "resume";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$databaseName", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>

<?php
if(isset($_POST['save_editable'])){
    try {
	$sql =$conn->prepare("INSERT INTO section_items(education, work_experience) VALUES (:education, :work_experience)");
	$sql->bindParam(':education', $education);
	$sql->bindParam(':work_experience', $work_experience);


	$education=$_POST['education'];
	$work_experience=$_POST['work_experience'];
	$sql->execute();
	}catch(PDOException $e) {
		echo "Insert failed: " . $e->getMessage();
	}
// header('location: work-history.php');

//Closing the database connection
$conn=null;
}
 ?> 

?>

