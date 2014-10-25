<?php
/**
 * @package JS_Jobs
 * @version 1.0
 */
/*
Plugin Name: JS Jobs
Plugin URI: http://www.joomsky.com
Description: Help Desk plugin for the wordpress
Author: Ahmed Bilal
Version: 1.0
Author URI: http://www.joomsky.com
*/

if(!defined('ABSPATH')) die('Restricted Access');

class priorityController{
	
	function __construct(){
		self::handleRequest();
	}
	
	function handleRequest(){
		$task = request::getVar('task',null,'priority_priorities');
		if(self::canaddfile()){
			$array = explode('_',$task);
			if(is_admin()){
				$action = request::getVar('action');
				$action_array = explode("_",$action);
				if($action_array[0] == 'admin'){
					priorityController::$action_array[1]();
				}else{
					$array[1] = 'admin_'.$array[1];

				}				
			}
			switch($array[1]){
				case 'admin_priorities':
					includer::getJSModel('priority')->getPriorities();
				break;
				case 'admin_addpriority':
					$id = request::getVar('jssupportticket_priorityid','get',null);
					includer::getJSModel('priority')->getPriorityForForm($id);
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
	static function savepriority(){
		$data = request::get('post');
		includer::getJSModel('priority')->storePriority($data);
		if(is_admin()){		
			$url = admin_url("admin.php?page=priority_priorities&task=priority_priorities");
		}else{
			$pageid = jssupportticket::$_db->get_var("Select id FROM `".jssupportticket::$_db->prefix."posts` WHERE post_name = 'priority_priorities'");
			$url = site_url("?page_id=".$pageid."&priority_priorities");
		}
		wp_redirect($url); exit;

	}

	static function deletepriority(){
		$id = request::getVar('priorityid');
		includer::getJSModel('priority')->removePriority($id);
		if(is_admin()){		
			$url = admin_url("admin.php?page=priority_priorities&task=priority_priorities");
		}else{
			$pageid = jsjobs::$_db->get_var("Select id FROM `".jsjobs::$_db->prefix."posts` WHERE post_name = 'priority_priorities'");
			$url = site_url("?page_id=".$pageid."&priority_priorities");
		}
		wp_redirect($url); exit;

	}
}

$priorityController = new priorityController();
?>
