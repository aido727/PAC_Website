<!-- Created by and property of: Aidan Harney -->
<!-- Free use provided to: Perth's Allied Costumers -->
<!-- Said use can by revoked by said owner at any time -->

<?php	
	//before post
	echo "<div class='table post-table'>";
	echo "<div class='table-row post-row-top'>";
	
	//post icon
	echo "<div class='table-cell post-icon-cell'>";
	if(is_null($post_item['icon_img']))
	{
		//echo "<a class='post-title-link' href='?go=newsitem&id=" . $post_item['id'] . "'><img class='post-icon' src='" . postIcon($post_item['type'],"N") . "'/></a>";
		echo "<a class='post-title-link' href='?go=newsitem&id=" . $post_item['id'] . "'><img class='post-icon post-icon-" . $post_item['type'] . "' src='images/blank-pixel.png'/></a>";
	}
	else
	{
		//NOT YET IMPLEMENTED - return default icon instead
		echo "<a class='post-title-link' href='?go=newsitem&id=" . $post_item['id'] . "'><img class='post-icon post-icon-generic' src='images/blank-pixel.png'/></a>";
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
	echo "<div class='table-cell post-title'><a class='post-title-link' href='?go=newsitem&id=" . $post_item['id'] . "'>" . $typeText . apostrapheFix($post_item['title']) . "</a></div></div>";
	echo "</div>";
	
	//post event sub-title
	if($post_item['type'] == "event")
	{
		if($post_item['event_singleday'] == "1") //single day event (do not use end date or "miscdate")
		{
			echo "<div class='post-stamp-event'>Date: " . convertDate($post_item['event_startdate']);
			echo "<br/>Time: " . convertTime($post_item['event_starttime']);
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
			echo "<div class='post-stamp-event'>Dates: " . convertDate($post_item['event_startdate']) . " - " . convertDate($post_item['event_enddate']);
			if(!empty($post_item['event_miscdate']))
			{
				echo" (" . $post_item['event_miscdate'] . ")";
			}
			if(!empty($post_item['event_misctime']))
			{
				echo"</br>Times: " . $post_item['event_misctime'];
			}
		}
		echo "</div>";	
	}
	
	//post sub-title
	echo "<div class='post-stamp'>Posted: " . convertDate($post_item['created_date']) . " by " . $post_item['author'] . " (" . $post_item['author_role'] . ")";
	if(!empty($post_item['edit_author']))
	{
		echo "<br/>Last Edited: " . convertDate($post_item['edited_date']) . " by " . $post_item['edit_author'];
	}
	echo "</div>";
	
	
	//post content
	echo "<div class='post-content'>" . customTagReplace(htmlspecialchars_decode($post_item['html'])) . "</div>";
	
	//after post
?>