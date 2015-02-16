<?php

namespace Lud\Utils {
	function toUTF8 ($str) {
		return iconv(mb_detect_encoding($str, mb_detect_order(), true), "UTF-8", $str);
	}
}

namespace {
	/**
	 * Returns an environment variable, throws if the variable is not defined
	 * @param  string $key           The environment key for the value
	 * @param  array  $allowedValues An optional array of allowed values for the key
	 * @return any                The environment value
	 */
	function renv($key,$allowedValues=array()) {
		Dotenv::required($key,$allowedValues);
		return (env($key));
	}
}
