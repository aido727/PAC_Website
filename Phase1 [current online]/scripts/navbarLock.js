<script language="JavaScript" type="text/javascript">
/**	Created by and property of: Aidan Harney
	Free use provided to: Perth's Allied Costumers
	Said use can by revoked by said owner at any time **/
	
	$(document).ready(function() {  
		// check where the navbar div is  
		var offset = $('#navbar').offset();  

		$(window).scroll(function () {  
			var scrollTop = $(window).scrollTop(); // check the visible top of the browser  

			if (offset.top<scrollTop)
			{
				$('#main').css('padding-top',$('#navbar').height());
				$('#navbar').addClass('fixedTop');  
			}
			else
			{
				$('#main').css('padding-top',0);
				$('#navbar').removeClass('fixedTop'); 
			}
		});  
	});  
</script>