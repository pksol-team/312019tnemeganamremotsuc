<?php 
	require 'config/db.php';
	
	$id = $_GET['id'];

	mysqli_query($connect, "DELETE FROM user WHERE id = $id ");

	header("Location:view_customer.php");

?>