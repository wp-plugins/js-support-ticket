<?php
if(!defined('ABSPATH')) die('Restricted Access');

class includer{
	
	function __construct(){
	}
	
	/*
	 * Includes files
	 */
	public static function include_file($filename,$module_name = null){
		if($module_name != null){
			include_once jssupportticket::$_path.'modules/'.$module_name.'/tpls/'.$filename.'.php';
		}else{
			include_once jssupportticket::$_path.'modules/'.$filename.'/controller.php';
		}
		return;
	}
	
	/*
	 * Static function to handle the page slugs
	 */
	public static function include_slug($page_slug){
		include_once jssupportticket::$_path.'modules/js-support-ticket-controller.php';
	}
	
	/*
	 * Static function for the model object
	 */
	public static function getJSModel($modelname){
		include_once jssupportticket::$_path.'modules/'.$modelname.'/model.php';
		$classname = $modelname.'Model';
		$obj = new $classname();
		return $obj;
	}
	
}

$includer = new includer();
?>
