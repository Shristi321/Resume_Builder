<?php 
//remove the notices
error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>
<?php 
session_start();
include("../includes/db.php");
?>
<?php
if(isset($_POST['submit_education'])){
    try {
		$sql =$conn->prepare("INSERT INTO user_education(resume_id, user_id, school_name, degree, major, minor, start_dates, end_date, gpa, coursework) VALUES (1,1, :school_name, :degree, :major, :minor, :start_dates, :end_date, :gpa, :coursework)");
    
		
        $sql->bindParam(':school_name', $school_name);
		$sql->bindParam(':degree', $degree);
        $sql->bindParam(':major', $major);
        $sql->bindParam(':minor', $minor);
        $sql->bindParam(':start_dates', $start_dates);
        $sql->bindParam(':end_date', $end_date);
        $sql->bindParam(':gpa', $gpa);
        $sql->bindParam(':coursework', $coursework);


		$school_name=$_POST['school_name'];
		$school_location=$_POST['school_location'];
        $degree=$_POST['degree'];
		$major=$_POST['major'];
        $minor=$_POST['minor'];
        $start_dates=$_POST['start_dates'];
		$end_date=$_POST['end_date'];
        $gpa=$_POST['gpa'];
		$coursework=$_POST['coursework'];

		$sql->execute();

        $last_insert_id = $conn->lastInsertId();
        $_SESSION['last_insert_id']= $last_insert_id;
        

		
	}catch(PDOException $e) {
		echo "Insert failed: " . $e->getMessage();
	}
    header('location: work-history.php');
  
  //Closing the database connection
  $conn=null;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Resume Builder</title>
    <link rel="stylesheet" href="../styles/style.css" media="all"/>
</head>
<body>
    <?php
    include("../header.php");
    ?>
<div class="main_content">
  
  <?php
      include("progress_nav.php");
  ?>

  <div class="content">
  <br><br><br>

  <form name="form1" enctype="multipart/form-data" action="" method="POST">
      <div class="row">
       
          <div class="column">
              
              <label for="degree">Degree </label><br>
                <select style="width:200px; height: 40px;" class="small_text" id="degree" name="degree">
                    <option value="" selected="selected" disabled="disabled">-- select one --</option>
                    <option value="Secondary education">Secondary education or high school</option>
                    <option value="Bachelor's degree">Bachelor's degree</option>
                    <option value="Master's degree">Master's degree</option>
                    <option value="Doctorate or higher">Doctorate or higher</option>
                </select>
              
          </div>

          <div class="column">
              <label for="school_name">College Name</label><br>
              <input class="small_text" type="text" id="school_name" name="school_name" placeholder="Name of the institution" value="">
          </div>
      </div>

      <div class="row">
      
          <div class="column">
         
              <label for="degree">Major </label><br>
              <input class="small_text" type="text" id="major" name="major" placeholder="Your major" value="">
          </div>

          <div class="column">
              <label for="lname">Minor</label><br>
              <input class="small_text" type="text" id="minor" name="minor" placeholder="Your minor" value="">
          </div>
      </div>

      <div class="row">
          <br>
          <div class="column">

              <label for="start_dates">Start Date</label><br>
              <input style="width:200px; height: 40px;" class="small_text" type="date" id="start_dates" name="start_dates" placeholder="Start date" value="" min="2015-01-01" max="2024-12-31">
          </div>

          <div class="column">
              <label for="phone">End date</label><br>
              
              <input style="width:200px; height: 40px;" class="small_text" type="date" id="end_date" name="end_date" placeholder="End date" value="" min="2015-01-01" max="2024-12-31">
          </div>
     
          <br>
          <label for="linkedin_link">GPA  </label>
          <input style="width:30%" class="small_text" type="text" id="gpa" name="gpa" placeholder="Your GPA" value="">
          
          <br>
          <label for="github_link">Relevent Coursework:</label><br>
          <textarea id="coursework" name="coursework" rows="5" cols="60" placeholder="Courses you have taken relevant to the job description" value=""></textarea>
          
      </div>

      <div class="savebutton">
      <br><br>
      <!-- <button id="prevnext_button" type="submit">Previous</button>
      <button id="prevnext_button" type="submit" formaction="../work-history.php">Nexxt</button> -->
      <button class="prevnext_button" type="submit">Previous</button>
      <button type="submit" class="prevnext_button" id="submit" name="submit_education">Save and Continue</button>
     
      </div>
  </form>

  </div>

  <div class="content_2 resume_pic">
      <?php 
      include("../4/index.php");
      ?>
  </div>

</div>

<?php
    include("../footer.php");
?>

</body>
</html>