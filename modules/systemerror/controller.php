<?php
if(!defined('ABSPATH')) die('Restricted Access');

class systemerrorController{
	
	function __construct(){
		self::handleRequest();
	}
	
	function handleRequest(){
		$task = request::getVar('task',null,'systemerror_systemerrors');
		if(self::canaddfile()){
			$array = explode('_',$task);
			if(is_admin()){
				$action = request::getVar('action');
				$action_array = explode("_",$action);
				if($action_array[0] == 'admin'){
					systemerrorController::$action_array[1]();
				}else{
					$array[1] = 'admin_'.$array[1];

				}				
			}
			switch($array[1]){
				case 'admin_systemerrors':
					includer::getJSModel('systemerror')->getSystemErrors();
				break;
				
				case 'admin_addsystemerror':
					$id = $_GET['jssupportticket_systemerrorid'];
					includer::getJSModel('systemerror')->getsystemerrorForForm($id);
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
	static function savesystemerror(){
		$data = request::get('post');
		includer::getJSModel('systemerror')->storesystemerror($data);
		if(is_admin()){		
			$url = admin_url("admin.php?page=systemerror_systemerrors&task=systemerror_systemerrors");
		}else{
			$pageid = jssupportticket::$_db->get_var("Select id FROM `".jssupportticket::$_db->prefix."posts` WHERE post_name = 'systemerror_systemerrors'");
			$url = site_url("?page_id=".$pageid."&systemerror_systemerrors");
		}
		wp_redirect($url); exit;

	}

	static function deletesystemerror(){
		$id = request::getVar('systemerrorid');
		includer::getJSModel('systemerror')->removesystemerror($id);
		if(is_admin()){		
			$url = admin_url("admin.php?page=systemerror_systemerrors&task=systemerror_systemerrors");
		}else{
			$pageid = jssupportticket::$_db->get_var("Select id FROM `".jssupportticket::$_db->prefix."posts` WHERE post_name = 'systemerror_systemerrors'");
			$url = site_url("?page_id=".$pageid."&task=systemerror_systemerrors");
		}
		wp_redirect($url); exit;

	}
}

$systemerrorController = new systemerrorController();
?>
