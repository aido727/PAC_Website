<script language="JavaScript" type="text/javascript">
/**	Created by and property of: Aidan Harney
	Free use provided to: Perth's Allied Costumers
	Said use can by revoked by said owner at any time **/
	
	function sizeup() {
		$(this).animate({fontSize: "30px"}, 80, 'linear');
	};
	function sizedown() {
		$(this).animate({fontSize: "20px"}, 80, 'linear');
	};
	function clickup() {
		$(this).animate({fontSize: "30px"}, 10, 'linear');
	};
	function clickdown() {
		$(this).animate({fontSize: "26px"}, 10, 'linear');
	};

	$(document).ready(function(){
    $(".nav-link").mouseenter(sizeup);
    $(".nav-link").mouseleave(sizedown);
	$(".nav-link").mousedown(clickdown);
	$(".nav-link").mouseup(clickup);
});
</script>