<script language="JavaScript" type="text/javascript">
/**	Created by and property of: Aidan Harney
	Free use provided to: Perth's Allied Costumers
	Said use can by revoked by said owner at any time **/
	
	$(window).bind("load", function() {
		//on load check
		if ($('input[name="singleDay"]').is(':checked')){
			checked()
		} else {
			unchecked()
		}
		
		//recheck on change
		$('input[name="singleDay"]').change(function() {
			if(this.checked) {
				checked()
			} else {
				unchecked()
			}
		});
		
		function checked()
		{
			$('input[name="startTime"]').removeAttr("disabled");
			$('span[name="startTimeStar"]').text(" * ");
			$('span[name="startTimeError"]').text($('span[name="startTimeError"]').text());
			$('input[name="endTime"]').removeAttr("disabled");
			
			$('input[name="endDate"]').val("");
			$('input[name="endDate"]').attr("disabled", true);
			$('span[name="endDateError"]').text("");
			$('span[name="endDateStar"]').text("");
			$('input[name="miscDate"]').val("");
			$('input[name="miscDate"]').attr("disabled", true);
		}
		
		function unchecked()
		{
			$('input[name="endDate"]').removeAttr("disabled");
			$('span[name="endDateStar"]').text(" * ");
			$('span[name="endDateError"]').text($('span[name="endDateError"]').text());
			$('input[name="miscDate"]').removeAttr("disabled");
			
			$('input[name="startTime"]').val("");
			$('input[name="startTime"]').attr("disabled", true);
			$('span[name="startTimeError"]').text("");
			$('span[name="startTimeStar"]').text("");
			$('input[name="endTime"]').val("");
			$('input[name="endTime"]').attr("disabled", true);
		}
	});	
</script>