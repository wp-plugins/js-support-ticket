<?php
/**
 * @package JS Support Ticket
 * @version 1.0
 */
/*
Plugin Name: JS Support Ticket
Plugin URI: http://www.joomsky.com
Description: Help Desk plugin for the wordpress
Author: Ahmed Bilal
Version: 1.0
Author URI: http://www.joomsky.com
*/

if(!defined('ABSPATH')) die('Restricted Access');

class formhandler{
	
	function __construct(){
		add_action('init',array($this,'checkFormRequest'));
		add_action('init',array($this,'checkDeleteRequest'));
	}
	
	/*
	 * Handle Form request
	 */
	function checkFormRequest(){
		$formrequest = request::getVar('form_request','post');
		if($formrequest == 'jssupportticket'){
			//handle the request
			$action = request::getVar('action','post');
			$array = explode('_',$action);
			includer::include_file($array[0]);			
			$class = $array[0]."Controller";
			$obj = new $class;
			$obj->$array[1]();
		}
	}

	/*
	 * Handle Form request
	 */
	function checkDeleteRequest(){
		$jssupportticket_action = request::getVar('action','get');
		if($jssupportticket_action == 'deleteitem'){
			//handle the request
			$action = request::getVar('task');
			$array = explode('_',$action);
			includer::include_file($array[0]);			
			$class = $array[0]."Controller";
			$obj = new $class;
			$obj->$array[1]();
		}
	}
	
}

$formhandler = new formhandler();
?>
