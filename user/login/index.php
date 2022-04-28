<?php 
include("../../includes/db.php");
session_start();
?>
<?php 
$email="";
$password="";
 ?>
<?php 

?>


<?php 
if(isset($_POST['login'])){

	if(($_POST['email'])==""){
		$_SESSION['error']="Enter the email";

	}else{
		$_SESSION['error']="";
		$email=$_POST['email'];
		$password=$_POST['password'];

		try {
			$sqla =$conn->prepare("SELECT * FROM user WHERE email=:email");
			$sqla->bindParam(':email', $email);
			$sqla->execute();

			$result= $sqla->setFetchMode(PDO::FETCH_ASSOC);
			$result= $sqla->fetchAll();

			if($result){
				$user_id = $result[0]["id"];
				$inserted_password=$result[0]["password"];

				if(password_verify($password, $inserted_password)){
					$_SESSION['login_error']="";
					$_SESSION['login_user_id'] = $result[0]["id"];
					$_SESSION['login_user_email'] = $result[0]["email"];
					header('location: ../../4/');
				} else{
					$_SESSION['login_error']="Incorrect password";
				}
			}
			else{
				$_SESSION['error']="Email doesn't exist";
			}

			
			
		} catch(PDOException $e) {
		  echo "Read failed: " . $e->getMessage();
		}

	 }
}

?>






<?php  
if(isset($_POST['signup'])){
	header('location: ../signup/');
}
?>

	<link href="css/styles.css" rel="stylesheet" type="text/css">

	
	<?php 
	include("../../header.php");
	 ?>
	
	
	<div id = "content">
		
		<div id = "main-content">
			<h1>Login</h1>
			<?php 
			if(isset($_SESSION['error'])){?>
				 <span style="color:red"> <?php echo($_SESSION['error']);?> </span>

			<?php  }
			 ?>

			<form id="form1" name="form1" enctype="multipart/form-data" action="" method="POST">
				
				<div class="login"> 
					<label id="textbox1label" class="contact_form_label" name="textbox1label" for="email">Email Address:</label><br/>
					<input type="text" id="email" name="email" value="<?php echo $email; ?>">
					<br/><br/>

					<label id="textbox2label" class="contact_form_label" name="textbox2label" for="password">Password:</label><br/>
					<input type="password" id="password" name="password"><br/><br/>



					<?php 
			if(isset($_SESSION['login_error'])){?>
				 <span style="color: red;" > <?php echo($_SESSION['login_error']);?> </span><br>

			<?php  }?>

					<input type="submit" id="login" name="login" value="Login">
					
					<br/><br/>

					<label for="signup">Don't have an account?</label>
					<input type="submit" id="signup" name="signup" value="Sign up">
				</div>

			
			</form>
			
		</div>
	</div>
