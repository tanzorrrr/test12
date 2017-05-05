<?php
error_reporting(-1);

use vendor\core\Router;  

echo $query =  rtrim($_SERVER['REQUEST_URI'],'/');

define('WWW',__DIR__);
define('CORE',dirname(__DIR__).'vendor/core');
define('ROOT',dirname(__DIR__));
define('APP',dirname(__DIR__).'/app');   

//require '../vendor/core/Router.php';
require '../vendor/libs/functions.php';
//require '../app/controllers/Main.php';
//require '../app/controllers/Posts.php';
//require '../app/controllers/PostsNew/.php';
//$router = new Router();

spl_autoload_register(function($class){
	//debug($class); 
	$file =ROOT.'/'.str_replace('\\','/',$class).'.php';
		if(is_file($file))
		 require($file);
	  //echo $file;     
});

  
Router::add('^page/?(?P<action>[a-z-]+)?$)',['controller'=>'Posts']);
  
//default roots
Router::add('^$',['controller'=>'Main','action'=>'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

  
debug(Router::getRoutes());  

 

Router::dispatch($query);

  



