
<?php
	$db_host = 'localhost';
	$db_user_name = 'root';
	$db_password = '';
	$db_name = 'simple-crud';

	$conn = mysqli_connect($db_host
						, $db_user_name
						, $db_password
						, $db_name) or die("Error! Database Connection.");
?>