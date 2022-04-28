<?php 
session_start();
include("includes/db.php");
?>

<?php
    include("header.php");
    ?>

<?php 
 if(!isset($_SESSION['login_user_id'])){

    header('location: login/');
}

if(isset($_POST['edit'])){
	// echo $obj["resume_id"];
 	$_SESSION['edit_resume_id']= $_POST['edit'];
 	echo($_SESSION['edit_resume_id']);

	header('location: 4/update_resume.php');
}


if(isset($_POST['delete'])){
	 try {
	// echo $obj["resume_id"];
 	$del= $conn->prepare("DELETE FROM section_items WHERE id=:id");

 	 $del->bindParam(':id', $id, PDO::PARAM_INT);
 	 $id=$_POST['delete'];

	$del->execute();




 }catch(PDOException $e) {
            echo "Update failed: " . $e->getMessage();
        }
    }
?>


<?php

$user_id=$_SESSION['login_user_email'];
echo"$user_id";

if($user_id=="admin@aa.com"){
	$res_results = $conn->prepare("SELECT *
	 FROM section_items 
	 JOIN resume
	 ON section_items.id=resume.resume_id 
	 order by section_items.resume_time desc;
	 ");

}else{

	$res_results = $conn->prepare("SELECT *
	 FROM section_items 
	  JOIN resume
	 ON section_items.id=resume.resume_id 
	 WHERE resume.user_id='$user_id'
	 order by section_items.resume_time desc;
	 ");
}

// $res_results = $conn->prepare("SELECT *
//  FROM section_items ");

$res_results->execute();

$resumes= $res_results->setFetchMode(PDO::FETCH_ASSOC);
$resumes= $res_results->fetchAll();
?>

<style>
table, td, th {
  border: 1px solid;
}

table {
  width: 100%;
  border-collapse: collapse;
}
</style>

        

<div class=content>
<!-- <form method="post" action=""> -->
<form method="post" action="">
				<table>	
				<?php 
                // var_dump($resumes); 
				foreach ($resumes as $obj){
                    // var_dump($resumes);
                    
                    ?>
                

				<tr>
					<td colspan="2">

<div style=" border: 1px solid; height:250px; overflow:auto;">
	<div id="headData" contentEditable="true"><?php echo($obj["heading_info"]); ?></div>
	<div id="useData" contentEditable="trsue"><?php echo($obj["education"]); ?></div>
	<div id="expData" contentEditable="true"><?php echo($obj["work_experience"]); ?></div>
	<div id="projData" contentEditable="true"><?php echo($obj["projects"]); ?></div>
	<div id="skilData" contentEditable="true"><?php echo($obj["skills"]); ?></div>
	<div id="leadData" contentEditable="true"><?php echo($obj["leadership"]); ?></div>
	<div id="certData" contentEditable="true"><?php echo($obj["certificates"]); ?></div>


<div>

				</td><!-- prints out the title from each obj of the results array -->


					<?php 
					

					// if($user_id=="aa@aa"){?>

					<td><a><button style="cursor: pointer;" id="edit" name="edit" value= "<?php echo $obj["resume_id"]; ?>">Edit</button></a></td>
					<!-- name is used to call if some functions is to be added to that button and value here is used to get the project id which can be used later to track -->
					
					<td><a><button style="cursor: pointer;" id="delete" name="delete" value= "<?php echo $obj["resume_id"]; ?>">Delete</button></a></td>

					<td><?php echo $obj["resume_time"]; ?></td>
					
						
						<?php  
					// } 
				
					?>
				</tr>
				<?php }?>

			</table>
		</form>

            </div>