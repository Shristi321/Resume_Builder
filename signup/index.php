<?php 
include("../includes/db.php");
session_start();
?>
<?php 

$_SESSION['error']="";
$first_name = "";
$last_name="";
$username="";
$email="";
$home_address="";
$phone="";
$password="";
$re_password="";
?>

<?php 
if(isset($_POST['login'])){
	header('location: ../login/');
 }
 ?>


 <?php 
 if(isset($_SESSION['login_user_id'])){
 	$_SESSION['errorMessage']="You are already logged in! Logout to signup for a new account";
    header('location: ../inform.php');
}
 ?>


<?php 

 if(isset($_POST['signup'])){
		$first_name=$_POST['first_name'];
		$last_name=$_POST['last_name'];
		$username=$_POST['username'];
		$email=$_POST['email'];
		
		$password=$_POST['password'];
		$re_password=$_POST['re_password'];
		$hashed_password=password_hash($password, PASSWORD_DEFAULT);


		if(($_POST['password'])!=($_POST['re_password'])){
			$_SESSION['passworderror']="Passwords do not match!!";
		}else{
			$_SESSION['passworderror']="";
		}


	 	if(($_POST['first_name']=="")||($_POST['username']=="") || ($_POST['email']=="") || ($_POST['password']=="") || ($_POST['re_password']=="")){
	 		$_SESSION['error']="Required fields are not filled!!";
		}else{
			$_SESSION['error']="";

	 	}


	 	try {
			$sql =$conn->prepare("SELECT * FROM user WHERE email=:email");
			$sql->bindParam(':email', $email);
			$sql->execute();

			$result= $sql->setFetchMode(PDO::FETCH_ASSOC);
			$result= $sql->fetchAll();

			if($result){
				$_SESSION['error']="Email Already exists!";
			}

		
		} catch(PDOException $e) {
		  echo "Read failed: " . $e->getMessage();
		}





 	if(($_SESSION['error']=="") && ($_SESSION['passworderror']=="")){
		try {
			$sql =$conn->prepare("INSERT INTO user(first_name, last_name, username, email, password) VALUES (:first_name, :last_name, :username, :email, :password)");
	 
			$sql->bindParam(':first_name', $first_name);
			$sql->bindParam(':last_name', $last_name);
			$sql->bindParam(':username', $username);
			$sql->bindParam(':email', $email);
			$sql->bindParam(':password', $hashed_password);
			
			$sql->execute();

		}catch(PDOException $e) {
			echo "Insert failed: " . $e->getMessage();
		}
		
		session_destroy();
		header('location: ../login/');
		// session_destroy();
	}

  
  //Closing the database connection
  $conn=null;
 

  }





?>

<head>
	<title>Sign Up</title>
	<link href="css/styles.css" rel="stylesheet" type="text/css">

</head>

<body>


	<?php 
	include("../header.php");
	 ?>
	
	<div id = "content">
		<div id = "main-content" class="content">
			<h1>Sign Up</h1>
			<?php 
			if(isset($_SESSION['error'])){?>
				 <span style="color:red"> <?php echo($_SESSION['error']);?> </span>

			<?php  }
			 ?>
			
			

			<form id="form1" name="form1" enctype="multipart/form-data" action="" method="POST">
				<h2>General Information</h2>
				<div class="signup_form"> 
					<div class="row">
						<div class="column">
							<label id="textbox1label" class="contact_form_label" name="textbox1label" for="first_name">First Name:<span>*</span></label><br/>
							<input type="text" id="first_name" name="first_name" value="<?php echo $first_name; ?>">
						</div>

						<div class="column">
							<label id="textbox1label" class="contact_form_label" name="textbox1label" for="last_name">Last Name:</label><br/>
							<input type="text" id="last_name" name="last_name" value="<?php echo $last_name; ?>">
						</div>
					</div>

					<label id="textbox2label" class="contact_form_label" name="textbox2label" for="username">Username:<span >*</span></label><br/>
					<input type="text" id="username" name="username" value="<?php echo $username; ?>">
					<br/><br/>

					<label id="textbox3label" class="contact_form_label" name="textbox3label" for="email">Email Address:<span>*</span></label><br/>
					<input type="text" id="email" name="email" value="<?php echo $email; ?>">
					<br/><br/>



					<div class="row">
						<div class="column">
							<label id="textbox5label" class="contact_form_label" name="textbox5label" for="password">Password:<span >*</span></label><br/>
							<input type="password" id="password" name="password" value="<?php echo $password; ?>">
							<br/><br/>
						</div>

						<div class="column">
							<label id="textbox6label" class="contact_form_label" name="textbox6label" for="re_password">Re-type Password:<span >*</span></label><br/>
							<input type="password" id="re_password" name="re_password" value="<?php echo $re_password; ?>">
							<br/><br/>
						</div>
					</div>

						<?php 
			if(isset($_SESSION['passworderror'])){?>
				 <span > <?php echo($_SESSION['passworderror']);?> </span>

			<?php  }
			 ?>

				</div>

				<div class="signup_form"> 
					


					<input type="submit" id="signup" name="signup" value="Sign UP"><br /><br />

					<label for="login">Already have an account?</label>
						<!-- <a href="../login/index.php"><input type="submit" name=""> General </a> -->
					<input type="submit" id="login" name="login" value="Login">
				
					<br/>

				</div>

			
			</form>
			
		</div>
	</div>



</body>
