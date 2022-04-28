<?php 
session_start();
include("../includes/db.php");
?>

<?php
// $con = mysql_connect("localhost","root","resume");
// if (!$con)
//   {
//   die('Could not connect: ' . mysql_error());
//   }

// mysql_select_db("resume", $con);

$sql="INSERT INTO section_items (education)
VALUES
('$_POST[edu_content]')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "1 record added";

mysql_close($con)
?>