<!-- Created by and property of: Aidan Harney -->
<!-- Free use provided to: Perth's Allied Costumers -->
<!-- Said use can by revoked by said owner at any time -->

<script>
	$(function() {
		$.datepicker.setDefaults({
			dateFormat: "dd/mm/yy",
			showOptions: { direction: "up" }
		});
		$(".datepicker").datepicker();
		$('.timepicker').ptTimeSelect();
	});
 </script>
 <!-- http://api.jqueryui.com/datepicker/ -->
<?php
	require_once "scripts/htmlpurifier/library/HTMLPurifier.auto.php";
	
	$config = HTMLPurifier_Config::createDefault();
	$purifier = new HTMLPurifier($config);
	
	$timePattern = "/^(1[0-2]|0?[1-9]):[0-5][0-9]\s(am|pm|AM|PM)$/";

	function clean_input($data)
	{
		$purifier = new HTMLPurifier($config);
		//clean and make inputs safe
		$data = $purifier->purify($data);
		$data = trim($data);
		$data = stripslashes($data);
		$purifier = null; //clean up object
		
		//correct apostraphe issue
		$data = str_replace("'","[apostraphe]",$data);
		
		return $data;
	}
	
	function compare_times($time1,$time2)
	{
		$time1 = new DateTime($time1);
		$time1 = (String)$time1->format('gia');
		$time2 = new DateTime($time2);
		$time2 = (String)$time2->format('gia');
				
		if($time1 < $time2)
		{
			return "1";
		}
		else
		{
			if($time1 == $time2)
			{
				return "equal";
			}
			else
			{
				return "2";
			}
		}
	}
	
	//get authors
	$authors = mysqli_query($db,"	SELECT *
									FROM authors
									WHERE allowed = '1'");
									
	while($authors_values = mysqli_fetch_array($authors))
	{
		$authors_items[] = array(	"name" => $authors_values['name'],
									"display_name" => $authors_values['display_name']
								);
	}
	
	//get buttons
	$preview = $_POST["preview_button"];
	$preview_edit = $_POST["preview_edit_button"];
	$edit = $_POST["edit_button"];
	$submit = $_POST["submit_button"];
	
	//setup input variables
	$title = "";
	$type = "";
	$author = "";
	$editor = "";
	$singleDay = "";
	$startDate = "";
	$endDate = "";
	$miscDate = "";
	$startTime = "";
	$endTime = "";
	$miscTime = "";
	$html = "";
	
	//setup error variables
	$titleErr = "";
	$typeErr = "";
	$authorErr = "";
	$editorErr = "";
	$startDateErr = "";
	$endDateErr = "";
	$miscDateErr = "";
	$startTimeErr = "";
	$endTimeErr = "";
	$miscTimeErr = "";
	$htmlErr = "";
	
	//process and validate inputs
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if(empty($_POST["title"]))
		{
			$titleErr = "Title is required";
		}
		else
		{
			$title = $_POST["title"];
			
			//forcefully strip pointy brackets
			$title = str_replace("<","",$title); 
			$title = str_replace(">","",$title);
			
			$title = clean_input($title);
		}
		
		if(empty($_POST["type"]))
		{
			$typeErr = "Type is required";
		}
		else
		{
			$type = clean_input($_POST["type"]);
			switch($type)
			{
				case "Announcement":
					$type = "general";
					break;
				case "News":
					$type = "news";
					break;
				case "Event":
					$type = "event";
					break;
				default:
					$typeErr = "Invalid Type";
					break;
			}
		}
		
		if(empty($_POST["author"]))
		{
			$authorErr = "Author is required";
		}
		else
		{
			$author = $_POST["author"];
		}
		
		if(empty($_POST["html"]) || $_POST["html"] == "<br>" || $_POST["html"] == "<br/>")
		{
			$htmlErr = "HTML is required";
		}
		else
		{
			$html = clean_input($_POST["html"]);
			if($html == "")
			{
				$htmlErr = "HTML is required";
			}
		}
		
		if($preview_edit != "" || $edit != "")
		{
			if(empty($_POST["editor"]))
			{
				$editorErr = "Editor is required";
			}
			else
			{
				$editor = $_POST["editor"];
			}
			
			if(!empty($_POST["edit_id"]))
			{
				$edit_id = $_POST["edit_id"];
			}
			else
			{
				$errCode = "5";
				$errTitle = "No Edit Id";
				$errText = "You cannot change what has yet to be created!";
				
				include "display/errordisplay.php";
			}
		}
		
		if($type == "event")
		{
			$singleDay = $_POST["singleDay"];
			if($singleDay != "1")
			{
				$singleDay = "0";
			}

			if(empty($_POST["startDate"]))
			{
				$startDateErr = "Start Date is required";
			}
			else
			{
				$startDate = clean_input($_POST["startDate"]);
			}
			
			if(!empty($_POST["miscTime"]))
			{
				$miscTime = clean_input($_POST["miscTime"]);
			}
			
			if($singleDay == "1")
			{
				if(empty($_POST["startTime"]))
				{
					$startTimeErr = "Start Time is required";
				}
				else
				{
					$startTime = clean_input($_POST["startTime"]);
					if (!preg_match($timePattern, $startTime))
					{
						$startTimeErr = "Invalid Start Time";
					}
				}
				
				if(!empty($_POST["endTime"]))
				{
					$endTime = clean_input($_POST["endTime"]);
					if (!preg_match($timePattern, $endTime))
					{
						$endTimeErr = "Invalid End Time";
					}
				}
			}
			else
			{
				if(empty($_POST["endDate"]))
				{
					$endDateErr = "End Date is required";
				}
				else
				{
					$endDate = clean_input($_POST["endDate"]);
				}
				
				if(!empty($_POST["miscDate"]))
				{
					$miscDate = clean_input($_POST["miscDate"]);
				}
			}
			
			//validate start against end date
			if($startDate != "" && $endDate != "")
			{
				$date1 = date_create(convert_date($startDate));
				$date2 = date_create(convert_date($endDate));
				$diff = date_diff($date1,$date2);
				$iDiff = (int)$diff->format("%R%a");
				if($iDiff < 1)
				{
					$endDateErr = "End Date must come after Start Date";
				}
			}
			
			//validate start against end time
			if($startTime != "" && $endTime != "" && $startTimeErr == "" && $endTimeErr == "")
			{
				$timeDiff = compare_times($startTime,$endTime);
				if($timeDiff != "1")
				{
					$endTimeErr = "End Time must come after Start Time";
				}
			}
		}
		
		//display output
		echo "<div class='comicborder center'>";
		if($titleErr == "" && $typeErr == "" && $authorErr == "" && $editorErr == "" && $htmlErr == "" && $startDateErr == "" && $endDateErr == "" && $startTimeErr == "" && $endTimeErr == "")
		{
			if($submit != "")
			{
				//create database record
				if($type == "event")
				{
					if($singleDay == "1")
					{
						//single day event
						$sql = "INSERT INTO posts (title, type, author, html, published, event_singleday, event_startdate, event_starttime, event_endtime, event_misctime)
						VALUES ('" . $title . "', '" . $type . "', '" . $author . "', '" . $html . "', '1','" . $singleDay . "', '" . convert_date($startDate) . "', '" . $startTime . "', '" . $endTime . "', '" . $miscTime . "')";
					}
					else
					{
						//multi day event
						$sql = "INSERT INTO posts (title, type, author, html, published, event_singleday, event_startdate, event_enddate, event_miscdate, event_misctime) 
						VALUES ('" . $title . "', '" . $type . "', '" . $author . "', '" . $html . "', '1','" . $singleDay . "', '" . convert_date($startDate) . "', '" . convert_date($endDate) . "', '" . $miscDate . "', '" . $miscTime . "')";
					}
				}
				else
				{
					//not an event
					$sql = "INSERT INTO posts (title, type, author, html, published)
					VALUES ('" . $title . "', '" . $type . "', '" . $author . "', '" . $html . "', '1')";
				}
				
				if ($db->query($sql) === TRUE)
				{
					//Success
					$last_id = $db->insert_id;
					echo "<b>Post Successful!</b><br/>";
					echo "<a href='http://perthsalliedcostumers.org/?go=newsitem&id=" . $last_id . "'>> Click here to see your new post <</a>";
					
					//clear inputs
					$title = "";
					$type = "";
					$author = "";
					$singleDay = "";
					$startDate = "";
					$endDate = "";
					$miscDate = "";
					$startTime = "";
					$endTime = "";
					$miscTime = "";
					$html = "";
				}
				else
				{
					//DB errors
					echo "<span class='input-subtext-red'><b>Post Failed!</b></span><br/>";
					echo "Error: " . $sql . "<br>" . $db->error;
				}
			}
			else
			{
				if($edit != "")
				{
					//update database record
					if($type == "event")
					{
						if($singleDay == "1")
						{
							//single day event
							$sql = "UPDATE posts
							SET title = '". $title . "', html = '" . $html . "', edit_author = '" . $editor . "', event_singleday = '" . $singleDay . "', event_startdate = '" . convert_date($startDate) . "', event_misctime = '" . $miscTime . "', event_starttime = '" . $startTime . "', event_endtime = '" . $endTime . "'
							WHERE id = " . $edit_id;
						}
						else
						{
							//multi day event
							$sql = "UPDATE posts
							SET title = '". $title . "', html = '" . $html . "', edit_author = '" . $editor . "', event_singleday = '" . $singleDay . "', event_startdate = '" . convert_date($startDate) . "', event_misctime = '" . $miscTime . "', event_enddate = '" . convert_date($endDate) . "', event_miscdate = '" . $miscDate . "'
							WHERE id = " . $edit_id;
						}
					}
					else
					{
						//not an event
						$sql = "UPDATE posts
						SET title = '". $title . "', html = '" . $html . "', edit_author = '" . $editor . "'
						WHERE id = " . $edit_id;
					}
					
					if ($db->query($sql) === TRUE)
					{
						//Success
						$last_id = $db->insert_id;
						echo "<b>Update Successful!</b><br/>";
						echo "<a href='http://perthsalliedcostumers.org/?go=newsitem&id=" . $edit_id . "'>> Click here to see your updated post <</a>";
					}
					else
					{
						//DB errors
						echo "<span class='input-subtext-red'><b>Update Failed!</b></span><br/>";
						echo "Error: " . $sql . "<br>" . $db->error;
					}
				}
				else
				{
					if($preview != "" || $preview_edit != "")
					{
						echo "<span><b>Preview Created!</b></span><br/>";
						echo "<script>window.open('http://perthsalliedcostumers.org/previewpost.php?edit_id=" . $edit_id . "&title=" . $title . "&type=" . $type . "&author=" . $author . "&editor=" . $editor . "&singleDay=" . $singleDay . "&startDate=" . convert_date($startDate) . "&endDate=" . convert_date($endDate) . "&miscDate=" . $miscDate . "&startTime=" . $startTime . "&endTime=" . $endTime . "&miscTime=" . $miscTime . "&html=" . $html . "','_blank')</script>";
					}
				}
			}
			
			//clear errors
			$titleErr = "";
			$typeErr = "";
			$authorErr = "";
			$startDateErr = "";
			$endDateErr = "";
			$miscDateErr = "";
			$startTimeErr = "";
			$endTimeErr = "";
			$miscTimeErr = "";
			$htmlErr = "";
		}
		else
		{
			//input errors
			echo "<span class='input-subtext-red'><b>Errors in input!</b></span><br/>Please correct the errors below.";
		}
		echo "</div>";
	}	
?>
</div>