<?php
include("../includes/db.php");
session_start();
?>
<?php
//Chek to see if the field was submitted.
if(isset($_POST['divData'])){
    try {
        $sql =$conn->prepare("INSERT INTO section_items(education) VALUES (:education)");
        $sql->bindParam(':education', $education);
        $education=$_POST['divData'];
        $sql->execute();
    
        }catch(PDOException $e) {
            echo "Insert failed: " . $e->getMessage();
        }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<title>Test</title>

<script type="text/javascript">
function doSaveData(){
    sourceData = document.getElementById("useData").innerHTML;
	document.getElementById("divData").value = sourceData;//textarea
	return true;
}	
</script>
<style type="text/css">
#hiddenFormWrap{display: none;}
</style>

</head>
<body>
<form id="someForm" name="formName" method="post" onsubmit="return doSaveData();">

<?php
$sqla =$conn->prepare("SELECT * FROM section_items WHERE id=:id");
	$sqla->bindParam(':id', $id);
    $id = $conn->lastInsertId();
	$sqla->execute();

	$result= $sqla->setFetchMode(PDO::FETCH_ASSOC);
	$result= $sqla->fetchAll();

//Closing the database connection
// $conn=null;
?>
<?php 
if($result){
    ?>
    <div id="useData" contentEditable="true"><?php echo($result[0]["education"]); ?>
</div>
<?php 
}else{?>
<div id="useData" contentEditable="true">Some Data in a Div Hellooooopppp
    <p>Hello</p> <br> <hr> <p>Hello</p>
</div>
<?php }
?>
<input type="hidden" name="id" value="<?php echo $id; ?>">
<!-- <input type="submit" name="submit_resume" value="Save Div" /> -->
<button type="submit" name="submit_resume" value="<?php echo $id ?>"> Save Div </button> 
<div id="hiddenFormWrap">
<textarea id="divData" name="divData" ></textarea>
</div>
</form>
</body>
</html>
	