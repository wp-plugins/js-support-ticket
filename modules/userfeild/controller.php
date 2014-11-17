<?php
if(!defined('ABSPATH')) die('Restricted Access');

class userfeildController{
	
	function __construct(){
		self::handleRequest();
	}
	
	function handleRequest(){
		$task = request::getVar('task',null,'userfeild_userfeilds');
		if(self::canaddfile()){
			$array = explode('_',$task);
			if(is_admin()){
				$action = request::getVar('action');
				$action_array = explode("_",$action);
				if($action_array[0] == 'admin'){
					userfeildController::$action_array[1]();
				}else{
					$array[1] = 'admin_'.$array[1];

				}				
			}
			switch($array[1]){
				case 'admin_userfeilds':
					includer::getJSModel('userfeild')->getUserFields(1);
				break;
				
				case 'admin_adduserfeild':
					$id = request::getVar('jssupportticket_userfeildid','get');
					includer::getJSModel('userfeild')->getUserFieldbyId($id);
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
	static function saveuserfeild() {
		$data = request::get('post');
		includer::getJSModel('userfeild')->storeUserFeild($data);
		if(is_admin()){		
			$url = admin_url("admin.php?page=userfeild_userfeilds&task=userfeild_userfeilds");
		}else{
			$pageid = jssupportticket::$_db->get_var("Select id FROM `".jssupportticket::$_db->prefix."posts` WHERE post_name = 'userfeild_userfeilds'");
			$url = site_url("?page_id=".$pageid."&task=userfeild_userfeilds");
		}
		wp_redirect($url); exit;

	}
	static function deleteuserfeild() {
		$id = request::getVar('userfeildid');
		includer::getJSModel('userfeild')->removeUserFeild($id);
		if(is_admin()){		
			$url = admin_url("admin.php?page=userfeild_userfeilds&task=userfeild_userfeilds");
		}else{
			$pageid = jssupportticket::$_db->get_var("Select id FROM `".jssupportticket::$_db->prefix."posts` WHERE post_name = 'userfeild_userfeilds'");
			$url = site_url("?page_id=".$pageid."&task=userfeild_userfeilds");
		}
		wp_redirect($url); exit;

	}

	
}

$userfeildController = new userfeildController();
?>
