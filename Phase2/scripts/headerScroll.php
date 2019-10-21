<!-- Created by and property of: Aidan Harney -->
<!-- Free use provided to: Perth's Allied Costumers -->
<!-- Said use can by revoked by said owner at any time -->

<?php
	function getHeaderScrollImgs()
	{
		$dir = "images/header-scroll";
		if(is_dir($dir))
		{
			if($dd = opendir($dir))
			{
				while (($f = readdir($dd)) !== false)
				{
					if($f != "." && $f != "..")
					{
						$files[] = $f;
					}
				}
				closedir($dd);
			} 
		 
			$headerimglist = "";
			for($i = 0; $i < count($files); $i++)
			{
				$headerimglist = $headerimglist.$files[$i].';';
			}
		}
		
		return $headerimglist;
	}
?>