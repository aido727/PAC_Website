<script language="JavaScript" type="text/javascript">
/**	Created by and property of: Aidan Harney
	Free use provided to: Perth's Allied Costumers
	Said use can by revoked by said owner at any time **/
	
	$(document).ready(function() {
		//initial resize
		//resize sidebar to prevent it going off the bottom of the window view
		var preMainHeight = parseInt($('#pre-main').css('height'));
		var mainMinHeight = parseInt($('#main-content').css('min-height'))
		var postMainHeight = parseInt($('#post-main').css('height'));
		var sidebarMaxHeight = preMainHeight+mainMinHeight+postMainHeight;
		var footerTop = $('#footer').offset().top - $(window).scrollTop()-window.innerHeight;
		var adjustedHeight;
		if(footerTop<0)
		{
			adjustedHeight = window.innerHeight-$('#navbar').outerHeight()+footerTop;
			//$('#sidebar').height(window.innerHeight-$('#navbar').outerHeight()+footerTop);
		}
		else
		{
			adjustedHeight = window.innerHeight-$('#navbar').outerHeight();
			//$('#sidebar').height(window.innerHeight-$('#navbar').outerHeight());
		}
		
		//never overextend past the actual content requirements
		if(adjustedHeight<sidebarMaxHeight)
		{
			$('#sidebar').height(adjustedHeight);
		}
		else
		{
			$('#sidebar').height(sidebarMaxHeight);
		}
		
		//change on resize
		$(window).on('resize', function(){
			var footerTop = $('#footer').offset().top - $(window).scrollTop()-window.innerHeight;
			if(footerTop<0)
			{
				adjustedHeight = window.innerHeight-$('#navbar').outerHeight()+footerTop;
				//$('#sidebar').height(window.innerHeight-$('#navbar').outerHeight()+footerTop);
			}
			else
			{
				adjustedHeight = window.innerHeight-$('#navbar').outerHeight();
				//$('#sidebar').height(window.innerHeight-$('#navbar').outerHeight());
			}
			
			if(adjustedHeight<sidebarMaxHeight)
			{
				$('#sidebar').height(adjustedHeight);
			}
			else
			{
				$('#sidebar').height(sidebarMaxHeight);
			}
		});
		
		//change on scroll
		$(window).scroll(function () {  
			var footerTop = $('#footer').offset().top - $(window).scrollTop()-window.innerHeight;
			if(footerTop<0)
			{
				adjustedHeight = window.innerHeight-$('#navbar').outerHeight()+footerTop;
				//$('#sidebar').height(window.innerHeight-$('#navbar').outerHeight()+footerTop);
			}
			else
			{
				adjustedHeight = window.innerHeight-$('#navbar').outerHeight();
				//$('#sidebar').height(window.innerHeight-$('#navbar').outerHeight());
			}
			
			if(adjustedHeight<sidebarMaxHeight)
			{
				$('#sidebar').height(adjustedHeight);
			}
			else
			{
				$('#sidebar').height(sidebarMaxHeight);
			}
		}); 
	});	
</script>