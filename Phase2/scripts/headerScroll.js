<script language="JavaScript" type="text/javascript">
/**	Created by and property of: Aidan Harney
	Free use provided to: Perth's Allied Costumers
	Said use can by revoked by said owner at any time **/
	
	//get a list of all images from PHP
	var sHeaderImgList = <?php echo json_encode(getHeaderScrollImgs()); ?>;
	var aHeaderImgList = sHeaderImgList.split(";");
	aHeaderImgList.sort(); 
	
	//this adds the images into the div
	var sListOfImgsHTML = '<ul>';
	for(var i=1;i<(aHeaderImgList.length);i++) //start at 1 because 0 is always null
	{
		var sListOfImgsHTML = sListOfImgsHTML.concat('<li><img class ="header-scroll-img" src="images/header-scroll/' + encodeURIComponent(aHeaderImgList[i].trim()) + '"/></li>');
	}
	var sListOfImgsHTML = sListOfImgsHTML.concat('</ul>');
	$('.innerScrollArea').append(sListOfImgsHTML);
	
	//this sets up the scroller
	$(document).ready(function(){
        var scroller = $('#header-scroll div.innerScrollArea');
        var scrollerContent = scroller.children('ul');
        scrollerContent.children().clone().appendTo(scrollerContent);
        var curX = 0;
        scrollerContent.children().each(function(){
            var $this = $(this);
            $this.css('left', curX);
            curX += $this.outerWidth(true);
        });
        var fullW = curX / 2;
        var viewportW = scroller.width

        // Scrolling speed management
        var controller = {curSpeed:0, fullSpeed:1};
        var $controller = $(controller);
        var tweenToNewSpeed = function(newSpeed, duration)
        {
            if (duration === undefined)
                duration = 600;
            $controller.stop(true).animate({curSpeed:newSpeed}, duration);
        };

        // Scrolling management; start the automatical scrolling
        var doScroll = function()
        {
            var curX = scroller.scrollLeft();
            var newX = curX + controller.curSpeed;
            //if (newX > fullW*2 - viewportW) //doesn't work and not sure why, something related to the inability to scroll past the end of the div
            if (newX > fullW) //works but only when the window is shorter than 1 set of images
                newX -= fullW;
			scroller.scrollLeft(newX);
        };
        setInterval(doScroll, 20);
        tweenToNewSpeed(controller.fullSpeed);
    });
</script>