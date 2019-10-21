<script language="JavaScript" type="text/javascript">
/**	Created by and property of: Aidan Harney
	Free use provided to: Perth's Allied Costumers
	Said use can by revoked by said owner at any time **/
	
	$(window).bind("load", function() {
		//for each 'newspost' element...
		$('.newspost').each(function(index){
			//if height is maxed, add div
			if(parseInt($(this).css('height')) >= 300) //keep in line with style.css
			{
				$(this).append("<div class='postShowMore'><div class='postShowMoreContainer'><span class='postShowMoreText'><a href='?go=newsitem&id=" + $(this).attr("name") + "'>> Click to see full post <</a></span></div></div>");
			}
		});
	});	
</script>