<?php
if(!defined('ABSPATH')) die('Restricted Access');

class configurationController{
	
	function __construct(){
		self::handleRequest();
	}
	
	function handleRequest(){
		$task = request::getVar('task',null,'configuration_configurations');
		if(self::canaddfile()){
			$array = explode('_',$task);
			if(is_admin()){
				$action = request::getVar('action');
				$action_array = explode("_",$action);
				if($action_array[0] == 'admin'){
					configurationController::$action_array[1]();
				}else{
					$array[1] = 'admin_'.$array[1];

				}				
			}
			switch($array[1]){
				case 'admin_configurations':
					includer::getJSModel('configuration')->getConfigurations();
				break;
			}
			includer::include_file($array[1],$array[0]);
		}
	}
	function canaddfile(){
		if(isset($_POST['form_request']) && $_POST['form_request'] == 'jssupportticket')
			return false;
		elseif(isset($_GET['action']) && $_GET['action'] == 'deleteitem')
			return false;
		else
			return true;
	}
	static function saveconfiguration(){
		$data = request::get('post');
		includer::getJSModel('configuration')->storeConfiguration($data);
		if(is_admin()){		
			$url = admin_url("admin.php?page=configuration_configurations&task=configuration_configurations");
		}else{
			$pageid = jssupportticket::$_db->get_var("Select id FROM `".jssupportticket::$_db->prefix."posts` WHERE post_name = 'configuration_configurations'");
			$url = site_url("?page_id=".$pageid."&task=configuration_configurations");
		}
		wp_redirect($url); exit;

	}
}

$configurationController = new configurationController();
?>
