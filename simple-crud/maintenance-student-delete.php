<?php
	include ('conn.php');
	if(isset($_GET['id'])) {

		$student_primary_id = $_GET['id'];
		$Student_sql = "SELECT * FROM tbl_students where ID = ".$student_primary_id."";
		$Student_query = mysqli_query($conn, $Student_sql) or die ("Error! Student SQL.");
		$Student_row = mysqli_fetch_assoc($Student_query);
?>
<center>
<h1>Do you really want to delete <b style="color:red;"><?php echo $Student_row['Last_Name']. ", ".$Student_row['First_Name']; ?>?</b></h1>

<a href="maintenance-student-deleted.php?id=<?php echo $Student_row['ID'] ?>">Yes</a>
<a href="maintenance-student.php">No</a>
</center>

<?php  
	}
 ?>

