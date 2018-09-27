<?php

if(!function_exists('extract_list')) {
	
	function extract_list($array, &$list =[], $temp = []) {
		
		if (count($temp) > 0 && ! in_array($temp, $list))
			$list[] = $temp;
		
		for($i = 0; $i < sizeof($array); $i ++) {			
			$copy = $array;
			$elem = array_splice($copy, $i, 1);
			
			if (sizeof($copy) > 0) {
				$add = array_merge($temp, array($elem[0]));
				sort($add);				
				extract_list($copy, $list, $add);
			} else {
				$add = array_merge($temp, array($elem[0]));
				sort($add);				
				if (! in_array($temp, $list)) {
					$list[] = $add;					
				}
			}			
		}
		
		return $list;		
	}
	
}

