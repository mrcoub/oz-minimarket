<?php

function __autoload($className)
{
	$arPaths = array(
		'/models/',
        '/components/',
        '/controllers/',
	);
	
	foreach ($arPaths as $path) {
		$path = ROOT.$path.$className.'.php';
		
		if(is_file($path)) {
			include_once($path);
		}
	}
}