<!-- Created by and property of: Aidan Harney -->
<!-- Free use provided to: Perth's Allied Costumers -->
<!-- Said use can by revoked by said owner at any time -->

<html lang="en" xml:lang="en">
<head>
	<meta charset="UTF-8">
	<title>Perth's Allied Costumers</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="shortcut icon" href="favicon.ico" />

	<!--Google tags-->
	<meta name="description" content="Perth's Allied Costumers - Charity, Promotion, Fun!" />
	<meta name="robots" content="..., ..." />
	
	<!--Dublin Core tags-->
	<meta name="DC.title" content="Perth's Allied Costumers" />
	<meta name="DC.creator" content="Aidan Harney" />
	<meta name="DC.date.created" content="28-April-2015" />
	<meta name="DC.date.available" content="30-January-2016" />
	<meta name="DC.language" content="en" />

	<!--Facebook tags-->
	<meta property="og:title" content="Perth's Allied Costumers" />
	<meta property="og:type" content="website"/>
	<!--<meta property="og:url" content="http://perthsalliedcostumers.org/" /> //to allow linking within the site, disable this-->
	<meta property="og:description" content="Perth's Allied Costumers - Charity, Promotion, Fun!" />
	<meta property="og:image" content="http://perthsalliedcostumers.org/images/PACLogo.png" />
	
	<!--Twitter tags-->
	<meta name="twitter:title" content="Perth's Allied Costumers">
	<meta name="twitter:description" content="Perth's Allied Costumers - Charity, Promotion, Fun!">
	<meta name="twitter:image" content="http://perthsalliedcostumers.org/images/PACLogo.png">

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

	<!--YouTube API-->
	<script src="https://apis.google.com/js/platform.js"></script>

	<!-- Images Right-Click Blocker-->
	<script type="text/javascript">
		document.oncontextmenu = function (e) {
			e = e || window.event;
			if (/^img$/i.test((e.target || e.srcElement).nodeName)) return false;
		};
	</script>

	<?php
		include 'scripts/preload.js';
		include "scripts/headerScroll.php";
		include "scripts/dateconversion.php";
		include "scripts/postIcon.php";
		include "scripts/customTagReplace.php";
	?>
</head>
<body>
	<?php include_once("scripts/analyticstracking.php") ?>
	<!--Start Facebook SDK-->
	<div id="fb-root"></div>
	<script>
		(function (d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s);
			js.id = id;
			js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.3";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
	<!--End FB SDK-->
	<div id="header">
		<!-- removed from "wrapper" so it can extend the entire width of the browser-->
		<?php include "display/header.php";?>
	</div>
	<?php include 'scripts/headerScroll.js';?>
		<div id="wrapper">
			<div id="navbar">
				<?php include "display/navbar.php";?>
			</div>
			<?php include 'scripts/navbarLock.js';?>
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
										$go = (!empty($_GET['go']) ? $_GET['go'] : null);
										if($go == "")
										{
											$page = "display/news.php";
											include $page;
										}
										else
										{
											$page = "display/" . $_GET['go'] . ".php";
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
						</div>
						<div id="post-main">
						</div>
					</div>
					<div id="sidebar">
						<?php include "display/sidebar.php";?>
					</div>
					<?php
						include 'scripts/sidebarHeight.js';
						include 'scripts/sidebarLock.js';
					?>
					<div class="clear"></div>
				</div>
				<div id="footer">
					<?php include "display/footer.php";?>
				</div>
				<div id="version-stub">
					<?php include "display/version-stub.php";?>
				</div>
		</div>
</body>
</html>