<!-- Created by and property of: Aidan Harney -->
<!-- Free use provided to: Perth's Allied Costumers -->
<!-- Said use can by revoked by said owner at any time -->

<script language="JavaScript" type="text/javascript">
	document.title = document.title + " - Edit/Delete Posts";
	
	//delete confirm script
	$(document).ready(function() {
		$(".delete_button").click(function(event) {
			if( !confirm("Are you sure you want to delete this post?\n\"" + $(this).attr("title") + "\""))
				event.preventDefault();
		});
	});
</script>

<?php
	include "scripts/customTagReplace.php";
	
	//get highest and lowest Ids
	$high_post_id_query = mysqli_query($db,"SELECT id
											FROM posts
											WHERE published = '1'
											ORDER BY id DESC
											LIMIT 1");
	$high_post_id_item = mysqli_fetch_array($high_post_id_query);
	$high_post_id = $high_post_id_item['id'];
	
	$low_post_id_query = mysqli_query($db,"SELECT id
											FROM posts
											WHERE published = '1'
											ORDER BY id ASC
											LIMIT 1");
	$low_post_id_item = mysqli_fetch_array($low_post_id_query);
	$low_post_id = $low_post_id_item['id'];
	
	//get buttons
	for($i = $low_post_id;$i<=$high_post_id;$i++)
	{
		if(!empty($_POST["edit_button_" . $i]))
		{
			$edit = $i;
		}
		
		if(!empty($_POST["delete_button_" . $i]))
		{
			$delete = $i;
		}
	}
	
	//process and validate inputs
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		//setup output display
		echo "<div class='comicborder center'>";
		
		//handle delete request
		if(!empty($delete))
		{
			$sql = "UPDATE posts 
					SET published=0
					WHERE id=" . $delete;
					
			if ($db->query($sql) === TRUE)
			{
				//Success
				echo "<b>Post Deleted!</b><br/>";
			}
			else
			{
				//DB errors
				echo "<span class='input-subtext-red'><b>Delete Failed!</b></span><br/>";
				echo "Error: " . $sql . "<br>" . $db->error;
			}
		} else {		
			//handle edit request
			if(!empty($edit))
			{
				echo "<script>window.location = 'http://perthsalliedcostumers.org" . htmlspecialchars($_SERVER['PHP_SELF']) . "?go=editpost_any&id=" . $edit . "&freshload=Y'</script>";
			}
		}
		echo "</div>";
	}
	
	//get posts to display
	$posts = mysqli_query($db,"	SELECT P.*, A.display_name author, E.display_name edit_author
								FROM posts P
								LEFT JOIN authors A
								ON P.author = A.name
								LEFT JOIN authors E
								ON P.edit_author = E.name
								WHERE published = '1'
								ORDER BY created_date DESC");
	$postsCount = $posts->num_rows; //count for checking later
	
	//get post values
	while($posts_values = mysqli_fetch_array($posts))
	{
		$post_items[] = array(	"id" => $posts_values['id'],
								"title" => $posts_values['title'],
								"type" => $posts_values['type'],
								"icon_img" => $posts_values['icon_img'],
								"event_singleday" => $posts_values['event_singleday'],
								"event_startdate" => $posts_values['event_startdate'],
								"event_enddate" => $posts_values['event_enddate'],
								"event_miscdate" => $posts_values['event_miscdate'],
								"event_starttime" => $posts_values['event_starttime'],
								"event_endtime" => $posts_values['event_endtime'],
								"event_misctime" => $posts_values['event_misctime'],
								"html" => $posts_values['html'],
								"created_date" => $posts_values['created_date'],
								"edited_date" => $posts_values['edited_date'],
								"author_role" => $posts_values['author_role'],
								//joined-overwritten
								"author" => $posts_values['author'],
								"edit_author" => $posts_values['edit_author']
								);
	}
	
	
	
	//display start of page
	echo "<span class='page-title'>EDIT/DELETE POSTS</span>";
	echo "<form class='comicborder' action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "?go=modifypost_list' method='POST' autocomplete='off' >";
	echo "<div class='post-stamp center' style='max-width:100% !important'>Click the post titles to see the post (opens in a new tab/window).<br/>Post edits are PERMANENT so be careful!<br/>Deletes can be undone: contact <a href='mailto:aido727@gmail.com'>Aidan</a><br/><span class='input-subtext-red'>Do NOT refresh this page!</span> Go back to the Admin Menu and then come back here again instead.</div>";
	
	//display each post
	if($postsCount > 0)
	{
		echo "<hr/>";
		foreach($post_items as $post_item)
		{
			if($post_item['id'] != $delete)
			{
				echo "<div class='table' style='width:996px;'>";
				echo "<div class='table-row'>";
				echo "<div class='table-cell' style='width:811px;'>";
					//before post
					echo "<div class='table post-table'>";
					echo "<div class='table-row post-list-row-top'>";
					
					//post icon
					echo "<div class='table-cell post-list-icon-cell'>";
					if(is_null($post_item['icon_img']))
					{
						echo "<a class='post-title-link' href='index.php?go=newsitem&id=" . $post_item['id'] . "' target='_blank''><img class='post-icon-mini' src='" . postIcon($post_item['type'],"Y") . "'/></a>";
					}
					else
					{
						//NOT YET IMPLEMENTED - return default icon instead
						echo "<a class='post-title-link' href='index.php?go=newsitem&id=" . $post_item['id'] . "' target='_blank''><img class='post-icon-mini' src='generic'/></a>";
						//display specific icon image
					}
					echo "</div>";
					
					//post title
					$typeText = "";
					switch($post_item['type'])
					{
						case "general":
							$typeText = "<span class='post-title-announcement'>ANNOUNCEMENT: </span>";
							break;
						case "news":
							$typeText = "<span class='post-title-news'>NEWS: </span>";
							break;
						case "event":
							$typeText = "<span class='post-title-event'>EVENT: </span>";
							break;
					}
					echo "<div class='table-cell post-title'><a class='post-title-link' href='index.php?go=newsitem&id=" . $post_item['id'] . "' target='_blank'>" . $typeText . apostrapheFix($post_item['title']) . "</a></div></div>";
					echo "</div>";
					
					//post event sub-title
					if($post_item['type'] == "event")
					{
						if($post_item['event_singleday'] == "1") //single day event (do not use end date or "miscdate")
						{
							echo "<div class='post-stamp-event post-list-stamp'>Date: " . convertDate($post_item['event_startdate']);
							echo " | Time: " . convertTime($post_item['event_starttime']);
							if($post_item['event_endtime'] != "00:00:00")
							{
								echo " - " . convertTime($post_item['event_endtime']);
							}
							if(!empty($post_item['event_misctime']))
							{
								echo" (" . $post_item['event_misctime'] . ")";
							}
						}
						else //multi-day event (do not use start or end time fields, remind user to enter them into "misctime")
						{
							echo "<div class='post-stamp-event post-list-stamp'>Dates: " . convertDate($post_item['event_startdate']) . " - " . convertDate($post_item['event_enddate']);
							if(!empty($post_item['event_miscdate']))
							{
								echo" (" . $post_item['event_miscdate'] . ")";
							}
							if(!empty($post_item['event_misctime']))
							{
								echo" | Times: " . $post_item['event_misctime'];
							}
						}
						echo "</div>";	
					}
					
					//post sub-title
					echo "<div class='post-stamp post-list-stamp'>Posted: " . convertDate($post_item['created_date']) . " by " . $post_item['author'] . " (" . $post_item['author_role'] . ")";
					if(!empty($post_item['edit_author']))
					{
						echo " | Last Edited: " . convertDate($post_item['edited_date']) . " by " . $post_item['edit_author'];
					}
					echo "</div>";
				echo "</div>";
				echo "<div class='table-cell center' style='vertical-align:middle; width:85px;'><input class='edit_button' title='" . apostrapheFix($post_item['title']) . "' type='submit' name='edit_button_" . $post_item['id'] . "' value='Edit Post'/></div>";
				echo "<div class='table-cell center' style='vertical-align:middle; width:100px;'><input class='delete_button' title='" . apostrapheFix($post_item['title']) . "' type='submit' name='delete_button_" . $post_item['id'] . "' value='Delete Post'/></div>";
				echo "</div></div>";
				echo "<hr/>";
			}
		}
	}
	else
	{
		$errCode = "4";
		$errTitle = "No Posts on Page";
		$errText = "You've taken things too far!";
		
		include "display/errordisplay.php";
	}
	
	//display end of page
	echo "</form><br/>";
?>