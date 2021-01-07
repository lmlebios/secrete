<!DOCTYPE html>
<html>
<head>
	<title>Simple-Crud</title>
</head>
<body>

<?php

	include ('conn.php');

	$student_primary_id ;
	$First_Name = "";
	$Middle_Name = "";
	$Last_Name = "";
	$Adviser_ID = 0;
	$ID_No = "";

	if(isset($_GET['id'])){

		$student_primary_id = $_GET['id'];
		$Student_sql = "SELECT * FROM tbl_students where ID = ".$student_primary_id."";
		$Student_query = mysqli_query($conn, $Student_sql) or die ("Error! Student SQL.");
		$Student_row = mysqli_fetch_assoc($Student_query);

		$First_Name = $Student_row['First_Name'];
		$Middle_Name = $Student_row['Middle_Name'];
		$Last_Name = $Student_row['Last_Name'];
		$Adviser_ID = $Student_row['Adviser_ID'];
		$ID_No = $Student_row['Document_Number'];

	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {


		$First_Name = $_POST['First_Name'];
		$Middle_Name = $_POST['Middle_Name'];
		$Last_Name = $_POST['Last_Name'];
		$Adviser_ID = $_POST['Adviser_ID'];
		$ID_No = $_POST['ID_No'];

		$Student_ID_No_validition_sql = "SELECT * FROM `tbl_students` WHERE Document_Number = '".$ID_No."' and ID != ".$student_primary_id."";
		$Student_ID_No_validition_query = mysqli_query($conn, $Student_ID_No_validition_sql) ; 
		$Student_ID_No_validition_count = mysqli_num_rows($Student_ID_No_validition_query);

		if($Student_ID_No_validition_count < 1) {

			$student_update_sql = "UPDATE `tbl_students` SET 
				 `First_Name`= '".$First_Name."'
				,`Middle_Name`= '".$Middle_Name."'
				,`Last_Name`= '".$Last_Name."'
				,`Adviser_ID`= ".$Adviser_ID."
				,`Document_Number`= '".$ID_No."'
				WHERE ID = ".$student_primary_id."";


			$Adviser_query = mysqli_query($conn, $student_update_sql) ; 

			if($Adviser_query){
				header("location:maintenance-student.php?update=1");
			}else{
				echo "Error! Update SQL.";
			}

		} else {
			echo "Student ID No, Already Exists.";
		}


	}

?>

<form method="POST" action="">

<label>Student ID No.</label>
<br>
<input type ="text" name = "ID_No" required="true" value = "<?php echo $ID_No ?>">
<br>

<label>First Name</label>
<br>
<input type ="text" name = "First_Name" required="true" value = "<?php echo $First_Name ?>">

<br>
<label>Middle Name (Optional)</label>
<br>
<input type ="text" name = "Middle_Name" value = "<?php echo $Middle_Name ?>">

<br>
<label>Last Name</label>
<br>
<input type ="text" name = "Last_Name"  required="true" value = "<?php echo $Last_Name ?>">
<br>
<label>Adviser</label>
<br>
<select name = "Adviser_ID"  required="true">
<?php

include ('conn.php');

$Adviser_sql = "SELECT * FROM tbl_advisers";

if($Adviser_ID > 0){
	$Adviser_sql = "SELECT * FROM tbl_advisers where id = ".$Adviser_ID." UNION SELECT * FROM tbl_advisers";
}

$Adviser_query = mysqli_query($conn, $Adviser_sql) or die ("Error! Student SQL.");

while($Adviser_row = mysqli_fetch_assoc($Adviser_query)){
?>

	<option value="<?php echo $Adviser_row['ID'] ?>">
		<?php echo $Adviser_row['Document_Number'] . " - " . $Adviser_row['Last_Name'] . ", " . $Adviser_row['First_Name'] ?>
	</option>

<?php
}

?>
</select>

<hr></hr>
<a href="maintenance-student.php">Cancel</a>
<button type = "submit">Save</button>

</form>

</body>
</html>