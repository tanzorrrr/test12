<?php
namespace app\controllers;

class PostsNew{
	public  function  indexAction(){
		echo 'ndndex::__construct';
	}
	
	public  function  testAction(){
		echo 'test::';
	}
	public  function  testPageAction(){
		echo 'testPage';
	}
	
	public  function  before(){
		echo 'before';
	}
}

?>