<?php 
session_start();
include("../includes/db.php");
?>
<?php
include("printpdfbutton.php");
?>


<?php

// echo($_SESSION['edit_resume_id']);
//Check to see if the eucation field was submitted.
if(isset($_POST['divData'])){//always true so removing other firlds from the condition
	// echo($_SESSION['edit_resume_id']);
    try {
        $sql =$conn->prepare("UPDATE section_items   
								SET heading_info = :heading_info,
								education = :education,
								work_experience = :work_experience,
								projects = :projects,
								skills = :skills,
								leadership = :leadership,
								certificates = :certificates
								WHERE id=:id");

        $sql->bindParam(':heading_info', $heading_info, PDO::PARAM_STR);
        $sql->bindParam(':education', $education, PDO::PARAM_STR);
		$sql->bindParam(':work_experience', $work_experience, PDO::PARAM_STR);
		$sql->bindParam(':projects', $projects, PDO::PARAM_STR);
		$sql->bindParam(':skills', $skills, PDO::PARAM_STR);
		$sql->bindParam(':leadership', $leadership, PDO::PARAM_STR);
		$sql->bindParam(':certificates', $certificates, PDO::PARAM_STR);
		$sql->bindParam(':id', $id);


		$id=$_SESSION['edit_resume_id'];
		$heading_info=$_POST['heading_infoData'];
        $education=$_POST['divData'];
		$work_experience= $_POST['experienceData'];
		$projects=$_POST['projectsData'];
		$skills= $_POST['skillsData'];
		$leadership=$_POST['leadershipData'];
		$certificates= $_POST['certificatesData'];
		
        $sql->execute();
    
        }catch(PDOException $e) {
            echo "Update failed: " . $e->getMessage();
        }
		header('location: ../my_resume.php');


}


?>

<?php 
 if(!isset($_SESSION['login_user_id'])){
    header('location: ../login/');
}
?>

<html>
<head>
	<title>Resume Builder</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	
</head>

<script type="text/javascript">
function doSaveData(){
	headingData = document.getElementById("headData").innerHTML;
	document.getElementById("heading_infoData").value = headingData;//textarea

    sourceData = document.getElementById("useData").innerHTML;
	document.getElementById("divData").value = sourceData;//textarea

	experData = document.getElementById("expData").innerHTML;
	document.getElementById("experienceData").value = experData;

	proData = document.getElementById("projData").innerHTML;
	document.getElementById("projectsData").value = proData;

	skiData = document.getElementById("skilData").innerHTML;
	document.getElementById("skillsData").value = skiData;

	leaderData = document.getElementById("leadData").innerHTML;
	document.getElementById("leadershipData").value = leaderData;

	certiData = document.getElementById("certData").innerHTML;
	document.getElementById("certificatesData").value = certiData;
	
	return true;
}	
</script>
<style type="text/css">
#hiddenFormWrap{display: none;}
</style>

<body>


<div class="container-fluid">
	<div class="row">
		<div class="">
			<div id="page" class="droid">
				<div class="row" style="margin-bottom:10px;">
					<div class="col-sm-12">

						<?php 



 ?>

 	<form method="POST" id="" name="" onsubmit="return doSaveData();" >
	 
		<?php
		
		$sqla =$conn->prepare("SELECT * FROM section_items WHERE id=:id");
		$sqla->bindParam(':id', $id);
		$id = $_SESSION['edit_resume_id'];
		
		$sqla->execute();

		$result= $sqla->setFetchMode(PDO::FETCH_ASSOC);
		$result= $sqla->fetchAll();
	

	//Closing the database connection
	// $conn=null;
	?>
	<?php 
	if($result){
		// echo"heyyyyyyyyyy!!!"
		?>
	<div id="headData" contentEditable="true"><?php echo($result[0]["heading_info"]); ?></div>
	<div id="useData" contentEditable="true"><?php echo($result[0]["education"]); ?></div>
	<div id="expData" contentEditable="true"><?php echo($result[0]["work_experience"]); ?></div>
	<div id="projData" contentEditable="true"><?php echo($result[0]["projects"]); ?></div>
	<div id="skilData" contentEditable="true"><?php echo($result[0]["skills"]); ?></div>
	<div id="leadData" contentEditable="true"><?php echo($result[0]["leadership"]); ?></div>
	<div id="certData" contentEditable="true"><?php echo($result[0]["certificates"]); ?></div>
	<?php 
	}
	?>
			</div>

		</div>
	</div>

</div>

<input type="hidden" name="id" value="<?php echo $id; ?>">
<button style="width: 150px;" class="btn btn-block btn-success" type="submit" name="update_resume" value="<?php echo $id ?>"> Update Resume </button> 
<div id="hiddenFormWrap">
<input type="hidden" name="resume_id" value="<?php echo $id; ?>">
<textarea id="heading_infoData" name="heading_infoData" ></textarea>
<textarea id="divData" name="divData" ></textarea>
<textarea id="experienceData" name="experienceData" ></textarea>
<textarea id="projectsData" name="projectsData" ></textarea>
<textarea id="skillsData" name="skillsData" ></textarea>
<textarea id="leadershipData" name="leadershipData" ></textarea>
<textarea id="certificatesData" name="certificatesData" ></textarea>
</div>


</form>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript" src="js/header.js"></script>

</body>

</html>
