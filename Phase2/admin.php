<!-- Created by and property of: Aidan Harney -->
<!-- Free use provided to: Perth's Allied Costumers -->
<!-- Said use can by revoked by said owner at any time -->

<html lang="en" xml:lang="en">
<head>
	<meta charset="UTF-8">
	<title>Perth's Allied Costumers - Admin</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="shortcut icon" href="favicon.ico" />

	<meta name="DC.title" content="Perth's Allied Costumers - Admin" />
	<meta name="DC.creator" content="Aidan Harney" />
	<meta name="DC.date.created" content="19-November-2015" />
	<!--<meta name="DC.date.available" content="28-April-2014" />-->
	<meta name="DC.language" content="en" />

	<!--Facebook tags--> <!--points to the main page, admin page should never be shared!-->
	<meta property="og:title" content="Perth's Allied Costumers" />
	<meta property="og:url" content="http://perthsalliedcostumers.org/" />
	<meta property="og:description" content="Perth's Allied Costumers - Charity, Promotion, Fun!" />
	<meta property="og:image" content="http://perthsalliedcostumers.org/images/PAClogo.png" />

	<?php
		ini_set("display_errors", 0);
		ini_set("log_errors", 1);
			
		include "admin/db_connect_posts.php";
	?>

	<!--jQuery include-->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	
	<!--jQuery UI include-->
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	
	<!--Timepicker include-->
	<link rel="stylesheet" href="scripts/jquery.ptTimeSelect.css">
	<script src="scripts/jquery.ptTimeSelect.js"></script>

	<?php
		include 'scripts/preload.js';
		include "scripts/headerScroll.php";
		include "scripts/dateconversion.php";
		include "scripts/postIcon.php";
	?>
</head>
<body>
	<?php include_once("scripts/analyticstracking.php") ?>
	<div id="header">
		<!-- removed from "wrapper" so it can extend the entire width of the browser-->
		<?php include "display/header.php";?>
	</div>
	<?php include 'scripts/headerScroll.js';?>
	<div id="wrapper">
		<div id="footer">
			<div id="admin-header" class="orangecomicborder popupshadow">
				<span class="comiccapital">DO NOT SHARE THIS PAGE!</span><br/><span> PAC ADMINS ONLY. <a href="https://www.facebook.com/aido727">Facebook</a> message or <a href="mailto:aido727@gmail.com">email</a> Aidan for any help or questions.</span>
			</div>
		</div>
		<div id="menubutton">
			<?php include "admin/menubutton.php";?>
		</div>
		<div id="homebutton">
			<?php include "admin/homebutton.php";?>
		</div>
		<div id="body">
			<?php
				if ($connection_result == 1)
				{
					//database is NOT connected
					$errCode = "1";
					$errTitle = "Database Load Error";
					$errText = $connection_message;
										
					include "display/errordisplay.php";
				}
				else
				{
					//database is connected
					$go = (!empty($_GET['go']) ? $_GET['go'] : null);
					if($go == "")
					{
						$page = "admin/menu.php";
						include $page;
					}
					else
					{
						$page = "admin/" . $_GET['go'] . ".php";
						if (file_exists($page))
						{
							include $page;
						}
						else
						{
								include "display/404.php";
						}
					}
				}
			?>
		</div>
		<div id="version-stub">
			<?php include "display/version-stub.php";?>
		</div>
	</div>
</body>
</html>