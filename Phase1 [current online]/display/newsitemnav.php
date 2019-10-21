<!-- Created by and property of: Aidan Harney -->
<!-- Free use provided to: Perth's Allied Costumers -->
<!-- Said use can by revoked by said owner at any time -->

<div id="newsitemnav" class="table comicborder popupshadow">
	<div class="table-row">
		<?php
			//look for previous news item
			$prevPost = mysqli_query($db,"	SELECT id, type, title, icon_img
											FROM posts
											WHERE id < " . $post_item['id'] . "
											AND published = '1'
											ORDER BY id DESC");
			$prevPostCheck = $prevPost->num_rows;
			
			echo "<div class='table-cell newsitemnavcell ";
			if($prevPostCheck > 0) 
			{
				//get post values
				$prev_post_item = mysqli_fetch_array($prevPost);
				
				$prevTypeText = "";
				switch($prev_post_item['type'])
				{
					case "general":
						$prevTypeText = "Announcement: ";
						break;
					case "news":
						$prevTypeText = "News: ";
						break;
					case "event":
						$prevTypeText = "Event: ";
						break;
				}
				
				//previous
				echo "newsitemnavcell-b newsitemnavcell-back-b-full'><a href='?go=newsitem&id=" . $prev_post_item['id'] . "' title='" . $prevTypeText . apostrapheFix($prev_post_item['title']) . "'><div class='newsitemnavcell-b-text-left'>";
				if(is_null($prev_post_item['icon_img']))
				{
					echo "<img class='post-icon-mini' src='" . postIcon($prev_post_item['type'],"Y") . "'/>";
				}
				echo $prev_post_item['title'] . "</div></a>";
			}
			else
			{
				echo "newsitemnavcell-blank'>";
			}
			
			echo "</div><div class='table-cell newsitemnavcell'>|</div><div class='table-cell newsitemnavcell ";
			
			//look for previous news item
			$nextPost = mysqli_query($db,"	SELECT *
											FROM posts
											WHERE id > " . $post_item['id'] . "
											AND published = '1'
											ORDER BY id ASC");
			$nextPostCheck = $nextPost->num_rows;
			
			if($nextPostCheck > 0) 
			{
				//get post values
				$next_post_item = mysqli_fetch_array($nextPost);
				
				$nextTypeText = "";
				switch($next_post_item['type'])
				{
					case "general":
						$nextTypeText = "Announcement";
						break;
					case "news":
						$nextTypeText = "News";
						break;
					case "event":
						$nextTypeText = "Event";
						break;
				}
				
				//next
				echo "newsitemnavcell-b newsitemnavcell-next-b-full'><a href='?go=newsitem&id=" . $next_post_item['id'] . "' title='" . $nextTypeText . ": " . apostrapheFix($next_post_item['title']) . "'><div class='newsitemnavcell-b-text-right'>";
				if(is_null($next_post_item['icon_img']))
				{
					echo "<img class='post-icon-mini' src='" . postIcon($next_post_item['type'],"Y") . "'/>";
				}
				echo $next_post_item['title'] . "</div></a>";
			}
			else
			{
				echo "newsitemnavcell-blank'>";
			}
			echo "</div>";
		?>
	</div>
</div>