<?php
	include ('conn.php');
	if(isset($_GET['id'])) {
		$student_primary_id = $_GET['id'];
		$Student_sql = "DELETE FROM `tbl_students` WHERE ID = ".$student_primary_id."";
		$Student_query = mysqli_query($conn, $Student_sql) or die ("Error! Student SQL.");
		header("location:maintenance-student.php?delete=1");
	}
 ?>

