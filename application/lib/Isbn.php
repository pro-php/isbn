<?php

namespace application\lib;


class Isbn {

	public function cleanIsbn($str) 
	{
		return preg_replace("/[\D]/", '', $str);
	}

	public function getIsbn($str) 
	{ 
		$regex = '/([0-9]*[\.,-^%$#@!|]*)+/';
		$arr = array();
		if (preg_match_all($regex, $str, $matches)) 
		{ 
			foreach ($matches[0] as $value)
			{
				$nums = strlen($this->cleanIsbn($value));
				if ($nums==10 || $nums==13)
					$arr[] = $value;
			}
			if (!empty($arr))
				return $arr;		
		} 
		return false;
	}

	public function isValidIsbn10($isbn) 
	{ 
		$check = 0; 
		for ($i = 0; $i < 10; $i++) 
		{ 
			if ('x' === strtolower($isbn[$i])) 
			{ 
				$check += 10 * (10 - $i); 
			} 
			elseif (is_numeric($isbn[$i])) 
			{ 
				$check += (int)$isbn[$i] * (10 - $i); 
			} 
			else 
			{ 
				return false; 
			} 
		} 
	
		return (0 === ($check % 11)) ? true : false; 
	}
 
	public function isValidIsbn13($isbn, $check=false) 
	{ 
		$check = 0;
		for ($i = 0; $i < 12; $i += 2) 
		{ 
			$check += (int)$isbn[$i]; 
		} 

		for ($i = 1; $i < 12; $i += 2) 
		{ 
			$check += 3 * $isbn[$i]; 
		} 

		$div = $check % 10;

		if ($check)
		{		
			$num = 10 - $div;
			if ($num==10) $num = 0;

			if ($isbn[12]==$num)
				return true;
			else
				return $num;
		}

		return (0 === $div) ? true : false; 
	} 

	public function addLog($log, $value) {
		if ($log=='')
			return $value;
		else
			return $log.','.$value;
	}

}