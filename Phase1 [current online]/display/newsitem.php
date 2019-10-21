<!-- Created by and property of: Aidan Harney -->
<!-- Free use provided to: Perth's Allied Costumers -->
<!-- Said use can by revoked by said owner at any time -->

<?php
	$id = (!empty($_GET['id']) ? $_GET['id'] : "missing");
	
	if($id != "missing") //check if Id is given
	{
		//get post to display
		$post = mysqli_query($db,"	SELECT P.*, A.display_name author, E.display_name edit_author
									FROM posts P
									LEFT JOIN authors A
									ON P.author = A.name
									LEFT JOIN authors E
									ON P.edit_author = E.name
									WHERE id = '". $id . "'
									AND published = '1'");
		$postCheck = $post->num_rows;
		
		if($postCheck == 1) //check if record is found
		{
			//get post values
			$post_item = mysqli_fetch_array($post);
			
			//update title of page
			echo "<script language='JavaScript' type='text/javascript'>document.title = document.title + ' - " . $post_item['title'] . "';</script>";
			
			//display post
			include "display/newsitemnav.php"; //display nav buttons
			echo "<hr/>";
			include "display/newsdisplay.php";
			echo "<hr/>";
			include "display/newsitemnav.php"; //display nav buttons
		}
		else
		{
			$errCode = "2";
			$errTitle = "Post Id Not Found";
			$errText = "Now you're just making things up...";
			
			include "display/errordisplay.php";
		}
	}
	else
	{
		$errCode = "3";
		$errTitle = "No Post Id";
		$errText = "You've given me nothing to work with!";
		
		include "display/errordisplay.php";
	}
?>