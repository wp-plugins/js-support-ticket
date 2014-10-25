<?php
if(!defined('ABSPATH')) die('Restricted Access');

class controlpanelController{
	
	function __construct(){
		self::handleRequest();
	}
	
	function handleRequest(){
		$task = request::getVar('task',null,'jssupportticket_controlpanel');
		if(self::canaddfile()){
			$array = explode('_',$task);
			if(is_admin()){
				$action = request::getVar('action');
				$action_array = explode("_",$action);
				if($action_array[0] == 'admin'){
					controlpanelController::$action_array[1]();
				}else{
					$array[1] = 'admin_'.$array[1];

				}				
			}
			switch($array[1]){
				case 'admin_controlpanel':
					includer::getJSModel('jssupportticket')->getControlPanelData();
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
}

$controlpanelController = new controlpanelController();
?>
