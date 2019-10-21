<!-- Created by and property of: Aidan Harney -->
<!-- Free use provided to: Perth's Allied Costumers -->
<!-- Said use can by revoked by said owner at any time -->

<?php include 'admin/event_fields.js';?>
<div class="table table-fixed create-post-table">
	<div class="table-row">
		<div class="table-cell">
			Single Day Event: 
			<?php
				echo "<input type='checkbox' name='singleDay' value='1'";
				if($singleDay == "1")
				{
					echo " checked";
				}
				echo "/>";
			?>
		</div>
	</div>
</div>
<br/>
<div class="table table-fixed create-post-table">
	<div class="table-row">
		<div class="table-cell" style="width:85px;">
			Start Date:
		</div>
		<div class="table-cell" style="width:102px;">
			<input type="text" name="startDate" class="datepicker" value="<?php echo $startDate;?>" style="width:70px;"/><span class="input-subtext-red" name="startDateStar"> *</span>
		</div>
		<div class="table-cell" style="width:76px;">
			End Date:
		</div>
		<div class="table-cell" style="width:102px;">
			<input type="text" name="endDate" class="datepicker" value="<?php echo $endDate;?>" style="width:70px;" disabled/><span class="input-subtext-red" name="endDateStar"></span>
		</div>
		<div class="table-cell" style="width:78px;">
			Misc Date:
		</div>
		<div class="table-cell">
			<input type="text" name="miscDate" value="<?php echo $miscDate;?>" style="width:224px;" disabled/><span class="input-subtext-red" name="miscDateStar"></span>
		</div>
	</div>
</div>
<div class="table table-fixed create-post-table" style="height:20px;">
	<div class="table-row">
		<div class="table-cell" style="width:185px;">
			<span class="input-subtext-red" name="startDateError"><?php echo $startDateErr;?></span>
		</div>
		<div class="table-cell" style="width:176px;">
			<span class="input-subtext-red" name="endDateError"><?php echo $endDateErr;?></span>
		</div>
		<div class="table-cell" style="width:306px;">
			<span class="input-subtext-red" name="miscDateError"><?php echo $miscDateErr;?></span>
		</div>
	</div>
</div>
<div class="table table-fixed create-post-table">
	<div class="table-row">
		<div class="table-cell" style="width:85px;">
			Start Time:
		</div>
		<div class="table-cell" style="width:102px;">
			<input type="text" name="startTime" class="timepicker" value="<?php echo $startTime;?>" style="width:70px;" disabled/><span class="input-subtext-red" name="startTimeStar"></span>
		</div>
		<div class="table-cell" style="width:76px;">
			End Time:
		</div>
		<div class="table-cell" style="width:102px;">
			<input type="text" name="endTime" class="timepicker" value="<?php echo $endTime;?>" style="width:70px;" disabled/><span class="input-subtext-red" name="endTimeStar"></span>
		</div>
		<div class="table-cell" style="width:78px;">
			Misc Time:
		</div>
		<div class="table-cell">
			<input type="text" name="miscTime" value="<?php echo $miscTime;?>" style="width:224px;"/><span class="input-subtext-red" name="miscTimeStar"></span>
		</div>
	</div>
</div>
<div class="table table-fixed create-post-table">
	<div class="table-row">
		<div class="table-cell" style="width:185px;">
			<span class="input-subtext-red" name="startTimeError"><?php echo $startTimeErr;?></span>
		</div>
		<div class="table-cell" style="width:176px;">
			<span class="input-subtext-red" name="endTimeError"><?php echo $endTimeErr;?></span>
		</div>
		<div class="table-cell" style="width:306px;">
			<span class="input-subtext-red" name="miscTimeError"><?php echo $miscTimeErr;?></span>
		</div>
	</div>
</div>