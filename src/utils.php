<?php namespace Lud\Utils;

function toUTF8 ($str) {
	return iconv(mb_detect_encoding($str, mb_detect_order(), true), "UTF-8", $str);
}
