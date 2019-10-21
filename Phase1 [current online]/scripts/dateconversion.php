<!-- Created by and property of: Aidan Harney -->
<!-- Free use provided to: Perth's Allied Costumers -->
<!-- Said use can by revoked by said owner at any time -->

<?php
	function convertTimeStamp($timestamp)
	{
		if(!empty($timestamp))
		{
			$timestamp = new DateTime($timestamp);
			$result = $timestamp->format('l, jS F Y, g:ia');
		}
		else
		{
			$result = "TIMESTAMP MISSING";
		}
		return $result;
	}
	
	function convertDate($date)
	{
		if(!empty($date))
		{
			$date = new DateTime($date);
			$result = $date->format('l, jS F Y');
		}
		else
		{
			$result = "DATE MISSING";
		}
		return $result;
	}
	
	function convertTime($time)
	{
		if(!empty($time))
		{
			$time = new DateTime($time);
			$result = $time->format('g:ia');
		}
		else
		{
			$result = "TIME MISSING";
		}
		return $result;
	}
	
	function convert_date($date)
	{
		if($date != "")
		{
			$date = substr($date,6,4) . "-" . substr($date,3,2) . "-" . substr($date,0,2); 
		}
		return $date;
	}
	
	function reverse_convert_date($date)
	{
		if($date != "")
		{
			$date = substr($date,8,2) . "/" . substr($date,5,2) . "/" . substr($date,0,4); 
		}
		return $date;
	}
?>