<!-- Created by and property of: Aidan Harney -->
<!-- Free use provided to: Perth's Allied Costumers -->
<!-- Said use can by revoked by said owner at any time -->

<?php
	if(!empty($errCode))
	{
		$errTitle =  $errCode . " - " . $errTitle;
	}
	
	//update page title
	echo "<script language='JavaScript' type='text/javascript'>document.title = document.title + ' - " . $errTitle . "';</script>"; 
	echo "<div class='page-title error-title'>ERROR: " . $errTitle . "</div>";
	echo "<div class='page-subtitle center'>" . $errText . "</div>";
?>
<p class="error-contact center">If you feel like this shouldn't have happened, please let me know how you got here: <a href="mailto:aido727@gmail.com">Contact the Web Admin</a>