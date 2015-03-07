<?php

namespace Lud\Utils {

	use DateTime;

	function toUTF8 ($str) {
		return iconv(mb_detect_encoding($str, mb_detect_order(), true), "UTF-8", $str);
	}

	/**
	 * Returns the age of a person
	 * @param  string $birthDate a string date yyyy-mm-dd
	 * @return integer
	 */
	function age ($birthDate) {
		return intval((new DateTime($birthDate))->diff(new DateTime('now'))->y);
	}

}


namespace {

	/**
	 * returns the value returned from the call of the passed function, except
	 * if the passed variable is a simple value. in this case, just return it
	 * @param  any $value a value
	 * @return any
	 */
	function get_value($value) {
		return is_callable($value) ? call_user_func($value) : $value;
	}

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

	/**
	 * Takes a key and a value, returns true if the value is different from the
	 * previous call with the same key
	 * @param  string $key   The key for mnemoization
	 * @param  any $callable Closure | function name | any value. The function to call for check the difference. Can also be a simple value
	 * @return bool true if the values differs
	 */
	function mnemo($key,$callable) {
		static $store;
		$value = get_value($callable);
		if (!isset($store[$key]) || $store[$key] !== $value) {
			$store[$key] = $value;
			return true; // the value differs since it was not evaled
		}
		return false;
	}
}
