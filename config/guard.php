<?php 
	session_start();

	$isvalid =  $_SESSION['Is_Valid'];
	if ($isvalid == false) {
		header('Location:index.php');
	}
	// else
	// {
	// 	header('Location:dashboard.php');
	// }
// 	if (!$isvalid)  
// 	else
		
 ?>