<?php 
	define('hostname', 'localhost');
	define('user', 'root');
	define('password', '');
	define('databaseName', 'customermanagement');

	global $connect;
	$connect = new mysqli(hostname, user, password, databaseName);
	$connect->set_charset("utf8");
	if (mysqli_connect_errno()) 
		echo "Failed to Connect Database" . mysqli_connect_error();
	
?>