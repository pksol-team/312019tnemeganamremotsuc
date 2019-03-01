<?php 
	require 'config/db.php';

	$id = $_GET['id'];

	mysqli_query($connect, "DELETE FROM purchase WHERE id = $id ");
	
	header('Location:purchase_view.php');
 ?>