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

class replyController{
	
	function __construct(){
		self::handleRequest();
	}
	
	function handleRequest(){
		$task = request::getVar('task',null,'replies_replies');
		if(self::canaddfile()){
			$array = explode('_',$task);
			if(is_admin()){
				$action = request::getVar('action');
				$action_array = explode("_",$action);
				if($action_array[0] == 'admin'){
					replyController::$action_array[1]();
				}else{
					$array[1] = 'admin_'.$array[1];

				}				
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

	static function savereply(){
		$data = request::get('post');
		includer::getJSModel('reply')->storeReplies($data);
		if(is_admin()){
			$url = admin_url("admin.php?page=ticket_tickets&task=ticket_ticketdetail&jssupportticket_ticketid=".request::getVar('ticketid'));
		}else{
			jssupportticket::$_pageid = jssupportticket::$_db->get_var("Select id FROM `".jssupportticket::$_db->prefix."posts` WHERE post_name = 'js-support-ticket-controlpanel'");
			$url = site_url("?page_id=".jssupportticket::$_pageid."&task=ticket_ticketdetail&jssupportticket_ticketid=".request::getVar('ticketid'));
		}
		wp_redirect($url); exit;
	}

}

$replyController = new replyController();
?>
