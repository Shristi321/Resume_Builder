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
              
              <label for="fname">First Name</label><br>
              <input class="small_text" type="text" id="fname" name="firstname" placeholder="Your first name" value="">
          </div>

          <div class="column">
              <label for="lname">Last Name</label><br>
              <input class="small_text" type="text" id="lname" name="lastname" placeholder="Your last name" value="">
          </div>
      </div>

      <div class="row">
          <br>
          <div class="column">
              
              <label for="email">Email</label><br>
              <input class="small_text" type="text" id="email" name="email" placeholder="Your email" value="">
          </div>

          <div class="column">
              <label for="phone">Phone</label><br>
              <input class="small_text" type="text" id="phone" name="phone" placeholder="Your phone number" value="">
          </div>
     
          <br>
          <label for="github_link">Github Link</label>
          <input class="small_text" type="text" id="github_link" name="github_link" placeholder="Your Github link" value="">
          
          <br>
          <label for="linkedin_link">LinkedIn Link</label>
          <input class="small_text" type="text" id="linkedin_link" name="linkedin_link" placeholder="Your LinkedIn Link" value="">
          
          <br>
          <label for="website_link">Website Link</label>
          <input class="small_text" type="text" id="website_link" name="website_link" placeholder="Your Website Link" value="">

      </div>

      <div class="savebutton">
      <br><br>
      <!-- <button id="prevnext_button" type="submit">Previous</button>
      <button id="prevnext_button" type="submit" formaction="../work-history.php">Nexxt</button> -->
      <button class="prevnext_button" type="submit">Previous</button>
      <button type="submit" class="prevnext_button" id="submit" name="submit">Save and Continue</button>
     
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