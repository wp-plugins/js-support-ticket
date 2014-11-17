<?php
if(!defined('ABSPATH')) die('Restricted Access');

class emailtemplateController{
	
	function __construct(){
		self::handleRequest();
	}
	
	function handleRequest(){
		$task = request::getVar('task',null,'emailtemplate_emailtemplates');
		if(self::canaddfile()){
			$array = explode('_',$task);
			if(is_admin()){
				$action = request::getVar('action');
				$action_array = explode("_",$action);
				if($action_array[0] == 'admin'){
					emailtemplateController::$action_array[1]();
				}else{
					$array[1] = 'admin_'.$array[1];

				}				
			}
			switch($array[1]){
				case 'admin_emailtemplates':
					$tempfor = request::getVar('for',null,'tk-nw');
					jssupportticket::$_data[1] = $tempfor;
					includer::getJSModel('emailtemplate')->getTemplate($tempfor);
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

	static function saveemailtemplate(){
		$data = request::get('post');
		includer::getJSModel('emailtemplate')->storeEmailTemplate($data);
		if(is_admin()){		
			$url = admin_url("admin.php?page=emailtemplate_emailtemplates&for=".request::getVar('for'));
		}else{
			$pageid = jssupportticket::$_db->get_var("Select id FROM `".jssupportticket::$_db->prefix."posts` WHERE post_name = 'priority_priorities'");
			$url = site_url("?page_id=".$pageid."&priority_priorities");
		}
		wp_redirect($url); exit;
	}
	
}

$emailtemplateController = new emailtemplateController();
?>
