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
    <br>
    <!-- <label> <strong>First Name</strong></label><br>
	<input type="text" id= "firstname" name= "firstname" value="" placeholder="First Name"><br><br> -->
    <form action="">
        <label for="fname">First Name</label><br>
        <input type="text" id="fname" name="firstname" placeholder="Your name.." value="">

        <label for="lname">Last Name</label>
        <input type="text" id="lname" name="lastname" placeholder="Your last name.." value="">
       
        
    </form>

    </div>


    <?php
        include("resume_update.php");
    ?>

   
</div>

<?php
    include("../footer.php");
?>

</body>
</html>