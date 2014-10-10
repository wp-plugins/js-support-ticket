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

class emailController{
	
	function __construct(){
		self::handleRequest();
	}
	
	function handleRequest(){
		$task = request::getVar('task',null,'email_emails');
		if(self::canaddfile()){
			$array = explode('_',$task);
			if(is_admin()){
				$action = request::getVar('action');
				$action_array = explode("_",$action);
				if($action_array[0] == 'admin'){
					emailController::$action_array[1]();
				}else{
					$array[1] = 'admin_'.$array[1];

				}				
			}
			switch($array[1]){
				case 'admin_emails':
					includer::getJSModel('email')->getEmails();
				break;
				
				case 'admin_addemail':
					$id = request::getVar('jssupportticket_emailid','get');
					includer::getJSModel('email')->getEmailForForm($id);
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
	static function saveemail(){
		$data = request::get('post');
		includer::getJSModel('email')->storeEmail($data);
		if(is_admin()){		
			$url = admin_url("admin.php?page=email_emails&task=email_emails");
		}else{
			$pageid = jssupportticket::$_db->get_var("Select id FROM `".jssupportticket::$_db->prefix."posts` WHERE post_name = 'email_emails'");
			$url = site_url("?page_id=".$pageid."&task=email_emails");
		}
		wp_redirect($url); exit;

	}

	static function deleteemail(){
		$id = request::getVar('emailid');
		includer::getJSModel('email')->removeEmail($id);
		if(is_admin()){		
			$url = admin_url("admin.php?page=email_emails&task=email_emails");
		}else{
			$pageid = jssupportticket::$_db->get_var("Select id FROM `".jssupportticket::$_db->prefix."posts` WHERE post_name = 'email_emails'");
			$url = site_url("?page_id=".$pageid."&task=email_emails");
		}
		wp_redirect($url); exit;

	}
}

$emailController = new emailController();
?>
