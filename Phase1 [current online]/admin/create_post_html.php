<!-- Created by and property of: Aidan Harney -->
<!-- Free use provided to: Perth's Allied Costumers -->
<!-- Said use can by revoked by said owner at any time -->

<!-- include rich text editor-->
<link rel="stylesheet" href="scripts/CLEditor/jquery.cleditor.css" />
<script src="scripts/CLEditor/jquery.cleditor.min.js"></script>
<script src="scripts/CLEditor/jquery.cleditor.table.min.js"></script>
<script src="scripts/CLEditor/jquery.cleditor.icon.js"></script>
<script src="scripts/CLEditor/jquery.cleditor.AHimage.js"></script>
<script src="scripts/CLEditor/jquery.cleditor.AHyoutube.js"></script>
<script>
	$(document).ready(function () {
		$(".richtext").cleditor({
			height:500,
			width:662,
			controls: // controls to add to the toolbar
                    "bold italic underline strikethrough subscript superscript | " +
                    "color highlight removeformat | bullets numbering | outdent " +
                    "indent | alignleft center alignright justify | undo redo | " +
                    "table AHimage AHyoutube link unlink icon | cut copy paste pastetext | source",
			bodyStyle: "margin:4px; font:14px Verdana, Geneva, Arial, sans-serif; cursor:text; background-color:white; background-image:none;"
		});
	});
</script>
<!--http://premiumsoftware.net/cleditor/gettingstarted-->
	
<div class="create-post-table">
	<div class="table-row">
		<div class="table-cell">
			HTML:<span class="input-subtext-red"> * <?php echo $htmlErr;?></span>
			<span class="post-stamp">Please do NOT paste any embedding code (such as Youtube) unless you want to break the website...<br/>Also, do NOT use "<" or ">", it will not work and can cause issues!</span>
			<textarea class="richtext" name="html"><?php echo apostrapheFix($html);?></textarea>
		</div>
	</div>
</div>