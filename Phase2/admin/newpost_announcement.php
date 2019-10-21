<!-- Created by and property of: Aidan Harney -->
<!-- Free use provided to: Perth's Allied Costumers -->
<!-- Said use can by revoked by said owner at any time -->

<script language="JavaScript" type="text/javascript">
	document.title = document.title + " - Create New Announcement Post";
</script>

<?php
	include "admin/create_post_data.php";
	include "scripts/customTagReplace.php";
?>

<span class="page-title">CREATE NEW ANNOUNCEMENT POST</span>
<form class="comicborder" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?go=newpost_announcement" method="POST" autocomplete="off" >
	<br/>
		<?php 
			$type_value = "Announcement"; //hard code post type
			include "admin/create_post_basefields.php"
		?>
	<br/>
		<?php 
			include "admin/create_post_html.php"
		?>
	<br/>
	<div class="center">
		<?php 
			include "admin/create_post_buttons.php"
		?>
	</div>
	<br/>
</form>