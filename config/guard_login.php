<?php 
	session_start();
	$isvalid =  $_SESSION;

	if (!empty($_SESSION['id'])) {
		header('Location:dashboard.php');
	}

?>