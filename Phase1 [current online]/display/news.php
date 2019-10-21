<!-- Created by and property of: Aidan Harney -->
<!-- Free use provided to: Perth's Allied Costumers -->
<!-- Said use can by revoked by said owner at any time -->

<script language="JavaScript" type="text/javascript">
	document.title = document.title + " - PAC News";
</script>

<span class="page-title">WHAT'S NEW IN PAC?</span>
<?php
	$postsPerPage = 5; //change this to effect all script below
	
	//"page" input from URL, tells us which page is being viewed
	$page = (!empty($_GET['page']) ? $_GET['page'] : 1);
	$count = ($page*$postsPerPage)-$postsPerPage; //number of posts on past pages, subtract one page worth to counter 0 indexing

	//get total count of posts in query
	$totalCount_array = mysqli_fetch_array(mysqli_query($db,"SELECT COUNT(id) as COUNT FROM posts WHERE published = '1'"));
	$totalCount = $totalCount_array['COUNT'];
	
	//calculate maximum number of pages to show all posts
	$maxPage = ceil($totalCount/$postsPerPage);
	
	//display page buttons at top
	include "display/newsnav.php";
	
	//get posts to display, currently a max of 5
	$posts = mysqli_query($db,"	SELECT P.*, A.display_name author, E.display_name edit_author
								FROM posts P
								LEFT JOIN authors A
								ON P.author = A.name
								LEFT JOIN authors E
								ON P.edit_author = E.name
								WHERE published = '1'
								ORDER BY created_date DESC
								LIMIT " . $count . "," . $postsPerPage);
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
	
	//display each post
	if($postsCount > 0)
	{
		echo "<hr/>";
		foreach($post_items as $post_item)
		{
			echo "<div class='newspost' name='" . $post_item['id'] . "'>";
			include "display/newsdisplay.php";
			echo "</div><hr/>";
		}
		include "scripts/postShowMore.js";
	}
	else
	{
		$errCode = "4";
		$errTitle = "No Posts on Page";
		$errText = "You've taken things too far!";
		
		include "display/errordisplay.php";
	}
	
	//display page buttons at bottom
	include "display/newsnav.php";
?>