<?php 
	require 'config/db.php';

	$id = $_GET['id'];

	$query = mysqli_query($connect, "SELECT * FROM user WHERE id = $id");
	$result = mysqli_fetch_array($query);

	$newStatus = ($result['status'] == "Deactive") ? 'Active' : 'Deactive';\

	mysqli_query($connect, "UPDATE user SET status = '$newStatus' WHERE id = $id");

	header('Location:view_customer.php');

 ?>