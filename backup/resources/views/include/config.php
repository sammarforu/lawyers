<?php
	$db_host="localhost"; 
	$db_name="fifo_db";
	$username="admin";
	$password="";
	$db_con=@mysql_connect($db_host,$username,$password);
	$connection_string=@mysql_select_db($db_name);
?>