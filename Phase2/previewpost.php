<!-- Created by and property of: Aidan Harney -->
<!-- Free use provided to: Perth's Allied Costumers -->
<!-- Said use can by revoked by said owner at any time -->

<html lang="en" xml:lang="en">
<head>
	<meta charset="UTF-8">
	<title>Perth's Allied Costumers - Admin - Previewing Post</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="shortcut icon" href="favicon.ico" />

	<meta name="DC.title" content="Perth's Allied Costumers" />
	<meta name="DC.creator" content="Aidan Harney" />
	<meta name="DC.date.created" content="28-April-2015" />
	<!--<meta name="DC.date.available" content="28-April-2015" />-->
	<meta name="DC.language" content="en" />
	
	<?php
		ini_set("display_errors", 0);
		ini_set("log_errors", 1);
		
		include "scripts/db_connect.php";
	?>

	<!--jQuery include-->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	
	<!--jQuery UI include--> <!--don't need here yet-->
	<!--<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>-->

	<!-- Images Right-Click Blocker-->
	<script type="text/javascript">
		document.oncontextmenu = function (e) {
			e = e || window.event;
			if (/^img$/i.test((e.target || e.srcElement).nodeName)) return false;
		};
	</script>

	<?php
		include 'scripts/preload.js';
		include "scripts/dateconversion.php";
		include "scripts/postIcon.php";
		include "scripts/customTagReplace.php";
	?>
</head>
<body>
		<div id="wrapper">
				<div id="body">
					<div id="main">
						<div id="pre-main">
						</div>
						<div id="main-content">
							<div id="main-inner-loading" class="main-inner-loading">
							</div>
							<div id="main-inner" class="hide-until-loaded">
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
										if($_GET['id'] == "PREVIEW")
										{
											echo "<script>history.go(-1)</script>"; //force browser to go back if this is reached by clicking a preview link, actually gives the impression it is working!
										}
										
										//todays date for display fakes
										$dateToday = date("Y-m-d");
										
										//query author details
										$author = mysqli_query($db,"SELECT display_name, role
																	FROM authors
																	WHERE name = '". $_GET['author'] . "'"
																	);
																	
										$author_item = mysqli_fetch_array($author);
										
										//if editor is present
										if(!empty($_GET['editor']))
										{
											$editor = mysqli_query($db,"SELECT display_name
																		FROM authors
																		WHERE name = '". $_GET['editor'] . "'"
																		);
																		
											$editor_item = mysqli_fetch_array($editor);
											
											//get created date of existing posts
											if(!empty($_GET['edit_id']))
											{
												$createdDate = mysqli_query($db,"SELECT created_date
																			FROM posts
																			WHERE id = '". $_GET['edit_id'] . "'"
																			);
																			
												$createdDate_item = mysqli_fetch_array($createdDate);
												
												$createdDate = $createdDate_item['created_date'];
											}
										}
										else
										{
											$createdDate = $dateToday; //fake created date for new posts
										}
										
										
										$post_item = array(
											"id" => "PREVIEW", //placeholder
											"title" => $_GET['title'],
											"type" => $_GET['type'],
											"author" => $author_item['display_name'],
											"author_role" => $author_item['role'],
											"edit_author" => $editor_item['display_name'],
											"event_singleday" => $_GET['singleDay'],
											"event_startdate" => $_GET['startDate'],
											"event_enddate" => $_GET['endDate'],
											"event_miscdate" => $_GET['miscDate'],
											"event_starttime" => $_GET['startTime'],
											"event_endtime" => $_GET['endTime'],
											"event_misctime" => $_GET['miscTime'],
											"created_date" => $createdDate, //faked
											"edited_date" => $dateToday, //faked
											"html" => $_GET['html']
										);
										include "display/newsdisplay.php";
									}
								?>
							</div>
						</div>
						<div id="post-main">
						</div>
					</div>
				</div>
		</div>
</body>
</html>