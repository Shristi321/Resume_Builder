<!DOCTYPE html>
<html>
<head>
	<title>Resume Builder</title>
    <link rel="stylesheet" href="styles/style.css" media="all"/>
</head>
<body>
    <?php
    include("header.php");
    ?>

<div class="main_content main_gradient">
    <div class="content">
        <p id="main_content_title">Build the Best Resume</p>
        <p id="main_content_desc">
            Our resume builder will help you make your prefect resume with options to change templates for free.<br><br> Est, tristique molestie commodo dignissim rutrum natoque lacinia iaculis amet elementum etiam phasellus lacus parturient donec sed sit justo parturient malesuada porta placerat habitant dolor senectus senectus est arcu tincidunt.
        </p>
       
        <div class="button_center">
            <a href="choose-template.php"> <button class="button" id="build_resume_button">Build my Resume</button></a>
        </div>
        
    </div>
    <div class="content_2">
        <img id="resume_1" src="img/resume_1.jpeg"/>
    </div>
</div>

<?php
    include("footer.php");
?>



</body>
</html>