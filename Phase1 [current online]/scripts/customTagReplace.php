<!-- Created by and property of: Aidan Harney -->
<!-- Free use provided to: Perth's Allied Costumers -->
<!-- Said use can by revoked by said owner at any time -->

<?php
	/*triggers all tag replacements*/
	function customTagReplace($html)
	{
		//ensure all tags can be found
		$html = str_replace("<IMG","<img",$html);
		$html = str_replace("SRC=","src=",$html);
		$html = str_replace("ALT=","alt=",$html);
		$html = str_replace("<SPAN","<span",$html);

		$html = replaceIMG($html); //CSS format img tags
		$html = youtubeEmbed($html); //custom include youtube embeds
		$html = apostrapheFix($html); //apostraphe fix for sql INSERT statements
		return $html;
	}

	/*takes IMG tags and styles them to the website + caption*/
	function replaceIMG($html)
	{
		$iStart = stripos($html,"<img");
		while((string)$iStart != null) //string typecast to handle "0" which equates to FALSE in PHP...
		{
			//get entire IMG tag
			$iEnd = stripos($html,">",$iStart)+1;
			$imgTag = substr($html,$iStart,($iEnd-$iStart));
			
			//get src
			$iSrcStart = stripos($imgTag,"src=");
			if(substr($imgTag,($iSrcStart+4),1) == "'")
			{
				//single quote
				$iSrcEnd = stripos($imgTag,"'",$iSrcStart+5);
			}
			else
			{
				//double quote
				$iSrcEnd = stripos($imgTag,'"',$iSrcStart+5);
			}
			$imgSrc = substr($imgTag,$iSrcStart+5,($iSrcEnd-($iSrcStart+5)));
			
			//get alt
			$iAltStart = stripos($imgTag,"alt=");
			if($iAltStart != null)
			{
				if(substr($imgTag,($iAltStart+4),1) == "'")
				{
					//single quote
					$iAltEnd = stripos($imgTag,"'",$iAltStart+5);
				}
				else
				{
					//double quote
					$iAltEnd = stripos($imgTag,'"',$iAltStart+5);
				}
				$imgAlt = substr($imgTag,$iAltStart+5,($iAltEnd-($iAltStart+5)));
			}
			
			//replace HTML
			if((string)stripos($imgSrc,"scripts/CLEditor/images/icons/") == null) //exclude icons from rich text editor
			{
				$replacementHTML = "<div class='table comicborder popupshadow-margin'><div class='table-row'><div class='table-cell'><a href='" . $imgSrc . "'>" . $imgTag . "</a></div></div>";
				if($iAltStart != null)
				{
					$replacementHTML = $replacementHTML . "<div class='table-row'><div class='table-cell comicimagecaption'>" . $imgAlt . "</div></div>";
				}
				$replacementHTML = $replacementHTML . "</div>";
				$html = substr_replace($html,$replacementHTML,$iStart,($iEnd-$iStart));
				
				//prep next loop
				$iStart = stripos($html,"<img",($iStart+strlen($replacementHTML)));
			}
			else
			{
				//prep next loop
				$iStart = stripos($html,"<img",($iStart+strlen($imgTag)));
			}
		}

		return $html;
	}
		
	/*safely embed youtube videos*/
	function youtubeEmbed($html)
{
		$iStart = stripos($html,"[youtube");
		while((string)$iStart != null)
		{
			$ytid = "";
			$height = "";
			$width = "";
			
			//get entire YOUTUBE tag
			$iEnd = stripos($html,"/]",$iStart)+2;
			$ytTag = substr($html,$iStart,($iEnd-$iStart));
			
			//get ytid
			$iIdStart = stripos($ytTag,"id=");
			if($iIdStart != null)
			{
				$iIdEnd = stripos($ytTag,'"',$iIdStart+4);
				$ytid = substr($ytTag,$iIdStart+4,($iIdEnd-($iIdStart+4)));
			}
			
			//get height
			$iIdStart = stripos($ytTag,"height=");
			if($iIdStart != null)
			{
				$iIdEnd = stripos($ytTag,'"',$iIdStart+8);
				$height = substr($ytTag,$iIdStart+8,($iIdEnd-($iIdStart+8)));
			}
			
			//get width
			$iIdStart = stripos($ytTag,"width=");
			if($iIdStart != null)
			{
				$iIdEnd = stripos($ytTag,'"',$iIdStart+7);
				$width = substr($ytTag,$iIdStart+7,($iIdEnd-($iIdStart+7)));
			}
			
			//replace HTML
			if($height == "")
			{
				$height = "315";
			}
			
			if($width == "")
			{
				$width = "560";
			}
			
			$replacementHTML = "<iframe width='" . $width . "' height='" . $height . "' src='https://www.youtube.com/embed/" . $ytid . "' frameborder='0' allowfullscreen></iframe>";
			$html = substr_replace($html,$replacementHTML,$iStart,($iEnd-$iStart));
			
			if($ytid != "")
			{
				//prep next loop
				$iStart = stripos($html,"[youtube",($iStart+strlen($replacementHTML)));
			}
			else
			{
				$iStart = stripos($html,"[youtube",($iEnd-$iStart));
			}
		}
		
		return $html;
	}
	
	/*fix apostraphe issue with sql INSERTS*/
	function apostrapheFix($html)
	{
		$iStart = stripos($html,"[apostraphe]");
		while((string)$iStart != null)
		{
			
			//get entire apostraphe tag
			$iEnd = $iStart+12;
			
			//replace HTML
			$replacementHTML = "'";
			$html = substr_replace($html,$replacementHTML,$iStart,($iEnd-$iStart));
			
			//prep next loop
			$iStart = stripos($html,"[apostraphe]");
		}
		
		return $html;
	}
?>