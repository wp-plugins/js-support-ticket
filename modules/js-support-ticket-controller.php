<?php
if(!defined('ABSPATH')) die('Restricted Access');

class jssupportticketController{
	
	function __construct(){
		self::handleRequest();
	}
	
	function handleRequest(){
		$module = JSSTrequest::getVar('module',null,'jssupportticket');
		JSSTincluder::include_file($module);
	}
	
}

$jssupportticketController = new jssupportticketController();
?>
