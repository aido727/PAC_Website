<!-- Created by and property of: Aidan Harney -->
<!-- Free use provided to: Perth's Allied Costumers -->
<!-- Said use can by revoked by said owner at any time -->
<input type="hidden" name="edit_id" value="<?php echo $id;?>"/>
<div class="center" style="width=100%;"><span class="input-subtext-red">*</span> = required field</div>
<div class="post-stamp center" style="max-width:100% !important; width=100%;">The post can (and often does) look different than it does in here.<br/>Try the "Preview Post" button to see what it REALLY looks like before actually updating the post!</div>
<br/>
<div class="table table-fixed create-post-table">
	<div class="table-row">
		<div class="table-cell" style="width:60px;">
			Title:
		</div>
		<div class="table-cell">
			<input type="text" name="title" value="<?php echo $title;?>" style="width:477px;"/><span class="input-subtext-red"> * <?php echo $titleErr;?></span>
		</div>
	</div>
	<br/>
	<div class="table-row">
		<!--hard coded type-->
		<div class="table-cell">
			Type:
		</div>
		<div class="table-cell">
			<input type="text" name="type" value="<?php echo $type_value;?>" style="width:110px;" disabled/><input type="hidden" name="type" value="<?php echo $type_value;?>" style="width:110px;"/><span class="input-subtext-red"> * <?php echo $typeErr;?></span>
		</div>
	</div>
	<br/>
	<div class="table-row">
		<div class="table-cell">
			Author:
			</div>
		<div class="table-cell">
			<input type="text" name="author_display" value="<?php echo $author_display;?>" style="width:150px;" disabled/><input type="hidden" name="author" value="<?php echo $author;?>" style="width:110px;"/>
			<span class="input-subtext-red"> * <?php echo $authorErr;?></span>
		</div>
	</div>
	<br/>
	<div class="table-row">
		<div class="table-cell">
			Editor:
			</div>
		<div class="table-cell">
			<select name="editor" style="width:150px;">
				<option value="">Please select...</option>
				<?php			
					foreach($authors_items as $author_item)
					{
						if($editor == $author_item['name'])
						{
							echo "<option value='" . $author_item['name'] . "' selected>" . $author_item['display_name'] . "</option>";
						}
						else
						{
							echo "<option value='" . $author_item['name'] . "'>" . $author_item['display_name'] . "</option>";
						}
					}
				?>
			</select>
			<span class="input-subtext-red"> * <?php echo $editorErr;?></span>
		</div>
	</div>
</div>