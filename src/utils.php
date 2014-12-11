<?php

function r($x) {
	$trace = debug_backtrace(null,1);
	$idx = strpos($trace[0]['file'], 'utils.php') ? 1 : 0;
	$src = (object)$trace[$idx];
	echo "<pre>call r() at {$src->file} line {$src->line}</pre>";
	dump_r($x);
	return $x;
}
