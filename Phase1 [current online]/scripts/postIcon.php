<!-- Created by and property of: Aidan Harney -->
<!-- Free use provided to: Perth's Allied Costumers -->
<!-- Said use can by revoked by said owner at any time -->

<?php
	function postIcon($type, $mini)
	{
		$imgsrc = "";
		switch($type)
		{
			case "general":
				$imgsrc = "images/post-icons/default-generic";
				//display default event icon
				break;
			case "news":
				$imgsrc = "images/post-icons/default-news";
				//display default news icon
				break;
			case "event":
				$imgsrc = "images/post-icons/default-event";
				//display default event icon
				break;
			default:
				$imgsrc = "images/post-icons/default-generic";
				//display default generic icon
				break;
		}
		
		if($mini == "Y")
		{
			$imgsrc = $imgsrc . "-mini";
		}
		
		$imgsrc = $imgsrc . ".png";
		
		return $imgsrc;
	}
?>