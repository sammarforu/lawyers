<?php
	$db_host="localhost"; 
	//$db_name="fifo_db";
	$username="admin";
	$password="";
	$test="sammar";
	$conn = new PDO("mysql:host=localhost;dbname=fifo_db", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>