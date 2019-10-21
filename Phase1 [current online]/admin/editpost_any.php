<!-- Created by and property of: Aidan Harney -->
<!-- Free use provided to: Perth's Allied Costumers -->
<!-- Said use can by revoked by said owner at any time -->

<script language="JavaScript" type="text/javascript">
	document.title = document.title + " - Edit Post";
</script>

<?php
	include "admin/create_post_data.php";
	include "scripts/customTagReplace.php";
?>
<span class="page-title">EDIT POST</span>
<?php
	$id = (!empty($_GET['id']) ? $_GET['id'] : "missing");
	$freshload = (!empty($_GET['freshload']) ? $_GET['freshload'] : "missing");
	
	if($id != "missing")
	{
		if($freshload == "Y")
		{
			//get post
			$post = mysqli_query($db,"	SELECT P.*, A.display_name author_display
										FROM posts P
										LEFT JOIN authors A
										ON P.author = A.name
										WHERE id = '". $id . "'
										AND published = '1'");
			$postCheck = $post->num_rows;
			
			if($postCheck == 1) //check if record is found
			{
				//get post values
				$post_item = mysqli_fetch_array($post);
				$title = $post_item['title'];
				$type = $post_item['type'];
				$author = $post_item['author'];
				$author_display = $post_item['author_display'];
				$singleDay = $post_item['event_singleday'];
				$startDate = reverse_convert_date($post_item['event_startdate']);
				$endDate = reverse_convert_date($post_item['event_enddate']);
				$miscDate = $post_item['event_miscdate'];
				$startTime = $post_item['event_starttime'];
				$endTime = $post_item['event_endtime'];
				$miscTime = $post_item['event_misctime'];
				$html = $post_item['html'];
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
			//need to requery author display name
			$author_db = mysqli_query($db,"SELECT display_name
										FROM authors
										WHERE name = '". $author . "'");
			$authorCheck = $author_db->num_rows;
						
			if($authorCheck == 1) //check if record is found
			{
				$author_item = mysqli_fetch_array($author_db);
				//get author display name
				$author_display = $author_item['display_name'];
			}
		}
		
		switch($type)
		{
			case "general":
				$type_value = "Announcement";
				break;
			case "news":
				$type_value = "News";
				break;
			case "event":
				$type_value = "Event";
				break;
			default:
				$typeErr = "Invalid Post Type";
				break;
		}
			
		echo "<form class='comicborder' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "?go=editpost_any&id=" . $id . "' method='POST' autocomplete='off' >";
		echo "<br/>";
		include "admin/edit_post_basefields.php";
		echo "<br/>";
		if($type == "event")
		{
			include "admin/create_post_eventfields.php";
			echo "<br/>";
		}
		include "admin/create_post_html.php";
		echo "<br/>";
		echo "<div class='center'>";
		include "admin/edit_post_buttons.php";
		echo "</div>";
		echo "<br/>";
		echo "</form>";
	}	
	else
	{
		//id missing
		$errCode = "3";
		$errTitle = "No Post Id";
		$errText = "You've given me nothing to work with!";
		
		include "display/errordisplay.php";
	}
?>
