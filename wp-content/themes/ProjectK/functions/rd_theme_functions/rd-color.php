<?php
// Generate random string 



function rd_hex_to_rgb_array($color) 
	
	{
		if(strpos($color,'#') !== false) 
		{ 
			$color = substr($color, 1, strlen($color)); 
		}
		
		$color = str_split($color, 2);
		foreach($color as $key => $c) $color[$key] = hexdec($c);
		
		return $color;
	}

	function rd_calc_preceived_brightness($color, $compare = false) 
	{
		$rgba = rd_hex_to_rgb_array($color);
	
		$brighntess = sqrt(
	      $rgba[0] * $rgba[0] * 0.241 + 
	      $rgba[1] * $rgba[1] * 0.691 + 
	      $rgba[2] * $rgba[2] * 0.068);
		
		if($compare)
		{
			$brighntess = $brighntess < $compare ? true : false;
		}
		return $brighntess;
	}

function rd_calculate_similar_color($color, $shade, $amount) 
 	{
 	
 		//remove # from the begiining if available and make sure that it gets appended again at the end if it was found
 		$newcolor = "";
 		$prepend = "";
 		if(strpos($color,'#') !== false) 
 		{ 
 			$prepend = "#";
 			$color = substr($color, 1, strlen($color)); 
 		}
 		
 		//iterate over each character and increment or decrement it based on the passed settings
 		$nr = 0;
		while (isset($color[$nr])) 
		{
			$char = strtolower($color[$nr]);
			
			for($i = $amount; $i > 0; $i--)
			{
				if($shade == 'lighter')
				{
					switch($char)
					{
						case 9: $char = 'a'; break;
						case 'f': $char = 'f'; break;
						default: $char++;
					}
				}
				else if($shade == 'darker')
				{
					switch($char)
					{
						case 'a': $char = '9'; break;
						case '0': $char = '0'; break;
						default: $char = chr(ord($char) - 1 );
					}
				}
			}
			$nr ++;
			$newcolor.= $char;
		}
 		
		$newcolor = $prepend.$newcolor;
		return $newcolor;
	}
	

?>