
<?php 
session_start();
include("../includes/db.php");
?>
<?php 
//remove the notices
error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>
<?php
include("printpdfbutton.php");
?>


<?php
//Check to see if the eucation field was submitted.
if(isset($_POST['divData'])){//always true so removing other firlds from the condition
    try {
        $sql =$conn->prepare("INSERT INTO section_items(heading_info, education, work_experience, projects, skills, leadership, certificates) VALUES (:heading_info, :education, :work_experience, :projects, :skills, :leadership, :certificates)");

        $sql->bindParam(':heading_info', $heading_info);
        $sql->bindParam(':education', $education);
		$sql->bindParam(':work_experience', $work_experience);
		$sql->bindParam(':projects', $projects);
		$sql->bindParam(':skills', $skills);
		$sql->bindParam(':leadership', $leadership);
		$sql->bindParam(':certificates', $certificates);
		
		$heading_info=$_POST['heading_infoData'];
        $education=$_POST['divData'];
		$work_experience= $_POST['experienceData'];
		$projects=$_POST['projectsData'];
		$skills= $_POST['skillsData'];
		$leadership=$_POST['leadershipData'];
		$certificates= $_POST['certificatesData'];
		
        $sql->execute();
    
        }catch(PDOException $e) {
            echo "Insert failed: " . $e->getMessage();
        }

        try {
        $sql =$conn->prepare("INSERT INTO resume(user_id, resume_id) VALUES (:user_id, :resume_id)");
        $sql->bindParam(':user_id', $user_id);
		$sql->bindParam(':resume_id', $resume_id);

        $user_id=$_SESSION['login_user_email'];
        $resume_id= $conn->lastInsertId();

        $sql->execute();
    
        }catch(PDOException $e) {
            echo "Insert failed: " . $e->getMessage();
        }

        // var_dump($_SESSION);
        // var_dump($_POST);
		
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



<?php
// if(isset($_POST['sectionEducation'])){
//     try {
// 	$sql =$conn->prepare("INSERT INTO section_items(education) VALUES (:education)");
// 	$sql->bindParam(':education', $education);
// 	// $sql->bindParam(':work_experience', $work_experience);

// 	$education=$_POST['sectionEducation'];
// 	// $work_experience=$_POST['work_experience'];

// 	$sql->execute();

// 	}catch(PDOException $e) {
// 		echo "Insert failed: " . $e->getMessage();
// 	}
// // header('location: work-history.php');

// // Closing the database connection
// $conn=null;
// }
?> 

<div class="container-fluid">
	<div class="row">
		<div class="">
			<div id="page" class="droid">
				<div class="row" style="margin-bottom:10px;">
					<div class="col-sm-12">

						<?php 
//--------------------------------------------------------------------
//Fetch Heading values
//--------------------------------------------------------------------
// ---------???????Uncomment
	// $sqla =$conn->prepare("SELECT * FROM user_heading WHERE id=:id");
	// $sqla->bindParam(':id', $id);
	// $id=$_SESSION['last_insert_id'];// from heading.php
	// $id=get_id_session($_SESSION['user']);
	// $sqla->execute();---------???????Uncomment

	// $result= $sqla->setFetchMode(PDO::FETCH_ASSOC);
	// $result= $sqla->fetchAll();

// Closing the database connection
// $conn=null;


 ?>


<?php
    // echo("hello");
    // echo( $_SESSION['last_insert_id']);
    ?>
	<form method="post" id="my_form" >
					

				<?php 
//--------------------------------------------------------------------
//Fetch Education values
//--------------------------------------------------------------------
// --Uncomment
// 	$sql_edu =$conn->prepare("SELECT * FROM user_education WHERE id=:id");
// 	$sql_edu->bindParam(':id', $id);
// 	$id=$_SESSION['last_insert_id'];// from education.php
// 	// $id=get_id_session($_SESSION['user']);
// 	$sql_edu->execute();

// 	$edu_result= $sql_edu->setFetchMode(PDO::FETCH_ASSOC);
// 	$edu_result= $sql_edu->fetchAll();

// // Closing the database connection
// $conn=null;


 ?>
 </form>



 	<form method="POST" id="" name="" onsubmit="return doSaveData();" >
	 
		<?php
		if(isset($_POST['divData'])){
		$sqla =$conn->prepare("SELECT * FROM section_items WHERE id=:id");
		$sqla->bindParam(':id', $id);
		$id = $resume_id;
		
		$sqla->execute();

		$result= $sqla->setFetchMode(PDO::FETCH_ASSOC);
		$result= $sqla->fetchAll();
	

	//Closing the database connection
	// $conn=null;
	?>
	<?php 
	if($result){
		echo"heyyyyyyyyyy!!!"
		?>
	<div id="headData" contentEditable="true"><?php echo($result[0]["heading_info"]); ?></div>
	<div id="useData" contentEditable="true"><?php echo($result[0]["education"]); ?></div>
	<div id="expData" contentEditable="true"><?php echo($result[0]["work_experience"]); ?></div>
	<div id="projData" contentEditable="true"><?php echo($result[0]["projects"]); ?></div>
	<div id="skilData" contentEditable="true"><?php echo($result[0]["skills"]); ?></div>
	<div id="leadData" contentEditable="true"><?php echo($result[0]["leadership"]); ?></div>
	<div id="certData" contentEditable="true"><?php echo($result[0]["certificates"]); ?></div>
	<?php 
	}}else{?>

	<div id="headData" contentEditable="true">
			<div id="info" style="text-align: center; padding-top:40px; padding-bottom: 15px;">
					<p id="contentName" style="font-family: 'Amarante'; font-size: 60px;">Shristi Chapagain</p>
			</div>

						
			 <div id="contact">
					<p><a href=""> http://shristichapagain.com/</a> |  https://www.linkedin.com/in/shristi-chapagain/  |  https://github.com/shristi321 <br>
							schapaga@cord.edu  |  123-456-7890 </p>
						</div> 
					</div>



	<div id="useData" contentEditable="true">
		<div class="section mine" id="sectionEducation" name="sectionEducation" contentEditable="true">
					<div class="section-title ruled rule-above">
						<hr class="hr-above">
						<h4><strong>Education</strong></h4>
						<hr class="hr-below">
					</div>
					<ul class="nobullet">
					<li>
						<div class="time right"><strong>Expected May, 2020</strong></div>
						<div class="text"><strong>Bachelor of Arts</strong> Concordia College</div>
						<div class="text">Computer Science w/minor in Data Analytics </div>
						<ul>
							<li><div class="text"> <strong>GPA: 3.6/4</strong></div></li>
							<li><div class="text"> <strong>Relevent Coursework:</strong> Fundamental Structures, Software Engineering, Web Design and Programming, Introduction to Database Management, Computer Network</div></li>
						</ul>
					</li>
					</ul>
				</div>
	</div>

	<div id="expData" contentEditable="true">
				<div class="section mine" id="sectionExperience" name="sectionExperience" contentEditable="true">
					<div class="section-title ruled rule-above">
						<hr class="hr-above">
						<h4><strong> Work Experience</strong></h4>
						<hr class="hr-below">
					</div>
					<ul>
					<li>
						<div>
						<div class="title">Software Engineer Intern</div>
						<div class="time right">May 2019 - Dec 2020</div>
						</div>
						<div>
						<ul>
							<li>
								<div class="text">Developed and implemented web applications into Sitecore systems using SCRUM Agile methods.</div>
							</li>
							<li>
								<div class="text">Conducted testing & validation to ensure web pages conform to government regulations and policy.</div>
							</li>
							<li>
								<div class="text">Performed validations on Web Forms using .NET Validation Controls and JavaScript.</div>
							</li>
						</ul>
						
						</div>
					</li>
					<li>
						<div>
						<div class="title">Computer Science Tutor</div>
						<div class="time right">Jan 2020-Jan 2021</div>
						</div>
						<div>
							<ul>
								<li>
									<div class="text">Worked with students both one on one and in small groups to give further assistance in learning mathematical subject matter.</div>
								</li>
								<li>
									<div class="text">Organize tutoring environment to promote learning</div>
								</li>
							</ul>
						
						</div>
					</li>
					</ul>
				</div>

	</div>

	<div id="projData" contentEditable="true">
		<div class="section" id="sectionProjects">
					<div class="section-title ruled rule-above">
						<hr class="hr-above">
						<h4><strong>Projects</strong></h4>
						<hr class="hr-below">
					</div>
				<ul>
					<li>
						<div>
						<div class="title">Resume Builder</div>
						<div class="time right">Feb 2021- Ongoing</div>
						</div>
						<div>
						<div class="tab">Language used: Java, PHP, JavaScript, HTML, CSS, SQL</div>
						<div class="link right">resume.abcxyz.com</div>
						</div>
						<div>
						<div class="text">Help people make a professional resume</div>
						</div>
					</li>
					<li>
						<div>
						<div class="title">Project title</div>
						<div class="time right">Jan 2020 - Dec 2020</div>
						</div>
						<div>
						<div class="tab">Language used:</div>
						<div class="link right">project.abcxyz.com</div>
						</div>
						<div>
						<div class="text">Description</div>
						</div>
					</li>
					
				</ul>
			</div>
	
	</div>



	<div id="skilData" contentEditable="true">
				<div class="section" id="sectionSkills" contentEditable="true" >
					<div class="section-title ruled rule-above">
						<hr class="hr-above">
						<h4><strong>Technical skills</strong></h4>
						<hr class="hr-below">
					</div>
					<ul>
					<li>
						<strong><span class="skillCategory">Programming languages</span> :</strong>
						Java, C#, C++
					</li>
					<li>
						<strong><span class="skillCategory">Web technologies</span> :</strong>
						HTML, CSS, Javascript, React, PHP, Ajax
					</li>
					<li>
						<strong><span class="skillCategory">Database management</span> :</strong>
						SQL
					</li>
					<li>
						<strong><span class="skillCategory">Miscellaneous</span> :</strong>
						WordPress, Godot
					</li>
					</ul>
				</div>	
	
	</div>




	<div id="leadData" contentEditable="true">
				<div class="section" id="sectionResponsibility">
					<div class="section-title ruled rule-above">
						<hr class="hr-above">
						<h4><strong>Leadership Exeperience</strong></h4>
						<hr class="hr-below">
					</div>
					<ul>
						<div class="time right">Jan 2019 - Dec 2020</div>
						<li>Student Ambassador, XYZ College</li>
						<div class="time right">Jan 2020 - Dec 2020</div>
						<li>Treasurer, ABC Club, XYZ College</li>
					</ul>
				</div>
	
	</div>




	<div id="certData" contentEditable="true">
				<div class="section" id="sectionlinks">
                    <div class="section-title ruled rule-above">
                        <hr class="hr-above">
                        <h4><strong>Certificates</strong></h4>
                        <hr class="hr-below">
                    </div>
                    <ul>
                    <div class="row">
                            <li>Data Structures and Algorithms</li>
                            <li>HTML, CSS, and JavaScript for Web Developers</li>
                    </div>
                    </ul>
                </div>
	
	</div>



	<?php }
	?>

   

			</div>

		</div>
	</div>

</div>

<?php 
// $resumeIdData=$id;
?>

<input type="hidden" name="id" value="<?php echo $id; ?>">
<!-- <input type="submit" name="submit_resume" value="Save Div" /> -->
<button style="width: 150px;" class="btn btn-block btn-success" type="submit" name="submit_resume" value="<?php echo $id ?>"> Save Resume </button> 
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






<!-- <input type="button" value="Save" name="save_editable"> -->
<!-- <button type="submit" class="prevnext_button" id="submit" name="save_editable">Save</button> -->

<!-- <script type="text/javascript">
    $(document).ready(function(){
        $("#saveBtn").click(function(){
            data = $("#education_form").html();
            $("#useDataField").val(data);
            $("#someForm").submit();
        });
    });
</script> -->

<!-- <input type="submit" id="hahaha" value="submit11" name="submit_e" onclick="$.ajax" /> -->
</form>
<!-- <input type="button" id="saveBtn" value="Save Div" /> -->

<!-- 
<div id="hiddenFormWrap">
    <form id="someForm" method="post">
		
        <input type="hidden" name="divData" id="useDataField" />
    </form>
</div> -->

<!-- <script type="text/javascript">
$(document).ready(function() {
    $('#hahaha').click(function() {
        var edu_content = $('#sectionEducation').html();
        $.ajax({
            url: 'saveToDb.php',
            type: 'POST',
            data: {
                edu_content: edu_content
            }
        });
    });
}); -->

<!-- 
$(document).ready(function(){
   $("#education_form").on("submit_e", function () {
        var hvalue = $('.mine').text();
        $(this).append("<input ype="hidden" name='sectionEducation' value=' " + hvalue + " '/>");
    });
});
</script> -->

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript" src="js/header.js"></script>

</body>

</html>
