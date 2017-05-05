<?php
namespace vendor\core;

class Router{
	
	
	protected static $routes =[];
	protected static $route =[];
	
	public static function add($regexp, $route=[]){
		self::$routes[$regexp] = $route;
	}
	
	public static function getRoutes(){
		return self::$routes;
	}
	
	public static function getRoute(){
		return self::$route;
	}
	/*
	Find URL in marshryts tyble
	@param string $url shows URL
	@return boolean
	*/
	public static function matchRoute($url){ 
		foreach(self::$routes as $pattern=>$route){
			if(preg_match("#$pattern#i",$url,$matches)){
				debug($matches);
				foreach($matches as $k=>$v){
					if(is_string($k)){
						$route[$k]=$v;
					}
				}
				if(!isset($route['action'])){
					$route['action']= 'index';
				}
				$route['controller']=self::upperCamelCase($route['controller']);
				self::$route = $route;
				debug($route);
				return true;
			}
		}
		return false;
	}
	
	public static function dispatch($url){
		if(self::matchRoute($url)){
			$controller ="app\controllers\\".self::upperCamelCase(self::$route['controller']);  
			if(class_exists($controller)){
				$cObj =new $controller(self::$route);
				$action = self::lowerCamelCase(self::$route['action']).'Action';
				if(method_exists($cObj, $action)){
					$cObj->$action();
				}else{
					echo "Method <b>.$controller,$action.</b>not found";
				}
			}else{
				echo "Kontroller <b>.$controller.</b> not faund";
			}
		}else{
			http_response_code(404);
			include '404.html';
		}
		
		
	}
	protected static   function upperCamelCase($name){
			return $name = str_replace(' ', '',ucwords(str_replace('-',' ', $name)));
			//debug($name);
		}
		
		protected static function lowerCamelCase($name){
			return lcfirst(self::upperCamelCase($name));
			debug($name);
		}
}