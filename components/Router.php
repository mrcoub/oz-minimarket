<?php

class Router
{
	private $routes;
	
	public function __construct()
	{
		$routesPath = ROOT.'/config/routes.php';
		$this->routes = include($routesPath);
	}
	
	private function getURI()
	{
		if (!empty($_SERVER['REQUEST_URI'])) {
			return trim($_SERVER['REQUEST_URI'], '/');
		}
	}
	
	public function run()
	{
		$uri = $this->getURI();
		
		foreach ($this->routes as $uriPattern => $path) {
			if (preg_match("~$uriPattern~", $uri)) {
				$internalRoute = preg_replace("~$uriPattern~", $path, $uri);
				$arSegments = explode('/', $internalRoute);
				$arController = array(
					'NAME' => ucfirst(array_shift($arSegments).'Controller'),
					'ACTION' => 'action'.ucfirst(array_shift($arSegments)),
					'PARAMETERS' => $arSegments
				);
				
				$arController['FILE'] = ROOT.'/controllers/'.$arController['NAME'].'.php';
				
				if (file_exists($arController['FILE'])) {
					include_once($arController['FILE']);
				}
				
				$obController = new $arController['NAME'];
				$res = call_user_func_array(array($obController, $arController['ACTION']), $arController['PARAMETERS']);
				
				if (!is_null($res)) {
					break;
				}
			}
		}
	}
}