<?php 
//remove the notices
error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>
<?php 
include("includes/db.php");
session_start();
?>

<head>
	<title>Resume Builder</title>
    <link rel="stylesheet" href="styles/style.css" media="all"/>
</head>
<body>
<div class="header">
    <a href = "https://resume.shristichapagain.com/"> <img id="logo" src="img/logo.png"/></a>
    <p id="logo_desc">Next step to your dream job...</p>
  
</div>

<div class="menubar">
    <ul id="menu">
        <li><a href="https://resume.shristichapagain.com/">Home</a></li>
        <li><a href="https://resume.shristichapagain.com/choose-template.php">Templates</a></li>
        <?php 
 if(isset($_SESSION['login_user_id'])){?>
    <li><a href="https://resume.shristichapagain.com/logout.php">Logout</a></li>
<?php
}else{?>
<li><a href="https://resume.shristichapagain.com/login/">Signup/Login</a></li>
<?php
}
?>
        
        <li><a href="https://resume.shristichapagain.com/my_resume.php">My Resumes</a></li>
         <li><a href="https://resume.shristichapagain.com/customer/general.php">My Account</a></li>

    </ul>

</div>


