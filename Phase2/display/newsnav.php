<!-- Created by and property of: Aidan Harney -->
<!-- Free use provided to: Perth's Allied Costumers -->
<!-- Said use can by revoked by said owner at any time -->

<div id="newsnav" class="table comicborder popupshadow">
	<div class="table-row">
		<?php
			if($page > 1)
			{
				echo "<div class='table-cell newsnavcell newsnavcell-b newsnavcell-first-b-full'><a href='?go=news&page=1'><img src='images/blank-pixel.png' alt='First' title='First Page'></a></div>";
			}
			else
			{
				echo "<div class='table-cell newsnavcell'></div>";
			}
			
			if($page > 1)
			{
				echo "<div class='table-cell newsnavcell newsnavcell-b newsnavcell-back-b-full'><a href='?go=news&page=" . ($page-1) . "'><img src='images/blank-pixel.png' alt='Previous' title='Previous Page'></a></div>";
			}
			else
			{
				echo "<div class='table-cell newsnavcell'></div>";
			}
		?>
		<div class="table-cell newsnavcell">
			<?php
				echo $page;
			?>
		</div>
		<?php
			if($page < $maxPage)
			{
				echo "<div class='table-cell newsnavcell newsnavcell-b newsnavcell-next-b-full'><a href='?go=news&page=" . ($page+1) . "'><img src='images/blank-pixel.png' alt='Next' title='Next Page'></a></div>";
			}
			else
			{
				echo "<div class='table-cell newsnavcell'></div>";
			}

			if($page < $maxPage)
			{
				echo "<div class='table-cell newsnavcell newsnavcell-b newsnavcell-last-b-full'><a href='?go=news&page=" . $maxPage . "'><img src='images/blank-pixel.png' alt='Last' title='Last Page'></a></div>";
			}
			else
			{
				echo "<div class='table-cell newsnavcell'></div>";
			}
		?>
	</div>
</div>