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

class request{
	
	/*
	 * Check Request from both the Get and post method
	 */
	static function getVar($variable_name,$method = null,$defaultvalue = null,$typecast = null){
		$value = null;
		if($method == null){
			if(isset($_GET[$variable_name])){
				$value = $_GET[$variable_name];
			}elseif(isset($_POST[$variable_name])){
				$value = $_POST[$variable_name];
			}elseif(get_query_var($variable_name)){
				$value = get_query_var($variable_name);
			}
		}else{
			$method = strtolower($method);
			switch ($method) {
				case 'post':
				if(isset($_POST[$variable_name]))
					$value = $_POST[$variable_name];
				break;
				case 'get':
				if(isset($_GET[$variable_name]))
					$value = $_GET[$variable_name];
				break;
			}
		}
		if($typecast != null){
			$typecast = strtolower($typecast);
			switch($typecast){
				case "int":
					$value = (int)$value;
				break;
				case "string":
					$value = (string)$value;
				break;
			}			
		}
		if($value == null) $value = $defaultvalue;
		return $value;
	}

	/*
	 * Check Request from both the Get and post method
	 */
	static function get($method = null){
		$array = null;
		if($method != null){
			$method = strtolower($method);
			switch ($method) {
				case 'post':
				$array = $_POST;
				break;
				case 'get':
				$array = $_GET;
				break;
			}
		}
		return $array;
	}
	
}
?>
