<?php

/**
 * @author Dejan
 * @since  Sep 19, 2018
 */

if ( !function_exists('encrypt_string') ) {
	function encrypt_string($string) {
		$j = 0;
		$hash = '';

	    $key = sha1(config('app.key'));
	    $strLen = strlen($string);
	    $keyLen = strlen($key);
	    for ( $i = 0; $i < $strLen; $i++ ) {
	        $ordStr = ord(substr($string, $i, 1));
	        if ($j == $keyLen) {
	        	$j = 0;
	        }

	        $ordKey = ord(substr($key, $j, 1));

	        $j++;
	        $hash .= strrev(base_convert(dechex($ordStr + $ordKey), 16, 36));
	    }

	    return base64_encode($hash);
	}
}

if ( !function_exists('decrypt_string') ) {
	function decrypt_string($string) {
		$j = 0;
		$hash = '';

		$string = base64_decode($string);

		$key = sha1(config('app.key'));
		$strLen = strlen($string);
		$keyLen = strlen($key);
		for ( $i = 0; $i < $strLen; $i+=2 ) {
		    $ordStr = hexdec(base_convert(strrev(substr($string,$i,2)), 36, 16));
		    if ($j == $keyLen) {
		    	$j = 0;
		    }

		    $ordKey = ord(substr($key, $j, 1));
		    $j++;
		    $hash .= chr($ordStr - $ordKey);
		}

		return $hash;
	}
}

if ( !function_exists('explode_bracket') ) {
	function explode_bracket($str) {
		preg_match_all("/(\\[[0-9]+\\])/", $str, $matches);

		$array = [];
		foreach ($matches[0] as $val) {
			$array[] = substr($val, 1, strlen($val) - 2);
		}

		return $array;
	}
}

if ( !function_exists('implode_bracket') ) {
	function implode_bracket($array) {
		$str = '';

		if ($array) {
			foreach ($array as $a) {
				$str .= "[$a]";
			}
		}

		return $str;
	}
}