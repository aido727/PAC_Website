<!-- Created by and property of: Aidan Harney -->
<!-- Free use provided to: Perth's Allied Costumers -->
<!-- Said use can by revoked by said owner at any time -->

<?php
	//Connection string
	$db=mysqli_connect("localhost","costume_user","readonly","costume_admin");
	//Check connection
	if (mysqli_connect_errno($db))
	{
		$connection_result = 1;
		$connection_message = "Failed to connect to database: " . mysqli_connect_error();
	}
	else
	{
		$connection_result = 0;
		$connection_message = "Database connected OK";
	}
?>