<?php
if(!defined('ABSPATH')) die('Restricted Access');

class jssupportticketController{
	
	function __construct(){
		self::handleRequest();
	}
	
	function handleRequest(){
		$task = request::getVar('task',null,'jssupportticket_controlpanel');
		$array = explode('_',$task);
		includer::include_file($array[0]);
	}
	
}

$jssupportticketController = new jssupportticketController();
?>
