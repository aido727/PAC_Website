<script language="JavaScript" type="text/javascript">
/**	Created by and property of: Aidan Harney
	Free use provided to: Perth's Allied Costumers
	Said use can by revoked by said owner at any time **/
	
	$(document).ready(function() {
		// check where the sidebar div is 
		var offset = $('#sidebar').offset();  
		
		$(window).scroll(function () {  
			var scrollTop = $(window).scrollTop(); // check the visible top of the browser  

			if (offset.top<scrollTop+($('#navbar').height())) $('#sidebar').addClass('fixedSidebar');
			else $('#sidebar').removeClass('fixedSidebar');  
		});  
	});	
</script>