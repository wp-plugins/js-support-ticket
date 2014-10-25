<?php
if(!defined('ABSPATH')) die('Restricted Access');

class attachmentController{
	
	function __construct(){
		self::handleRequest();
	}
	
	function handleRequest(){
		$task = request::getVar('task',null,'attachment_getattachments');
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
			switch($array[1]){
				case 'attachment_getattachments':
					$id = request::getVar('jssupportticket_ticketid','get',null);
					includer::getJSModel('replies')->getrepliesForForm($id);
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
	static function saveattachments(){
		$data = request::get('post');
		includer::getJSModel('attachment')->storeAttachments($data);
		if(is_admin()){
			$url = admin_url("admin.php?page=ticket_tickets&task=ticket_ticketdetail&jssupportticket_ticketid=".request::getVar('ticketid'));
		}else{
			$pageid = jssupportticket::$_db->get_var("Select id FROM `".jssupportticket::$_db->prefix."posts` WHERE post_name = 'replies_replies'");
			$url = site_url("?page_id=".$pageid."&task=replies_replies");
		}
		wp_redirect($url); exit;
	}

	static function deleteattachment(){
		$id = request::getVar('id');
		includer::getJSModel('attachment')->removeAttachment($id);
		if(is_admin()){		
			$url = admin_url("admin.php?page=ticket_tickets&task=ticket_ticketdetail&jssupportticket_ticketid=".request::getVar('ticketid'));
		}else{
			$pageid = jssupportticket::$_db->get_var("Select id FROM `".jssupportticket::$_db->prefix."posts` WHERE post_name = 'replies_replies'");
			$url = site_url("?page_id=".$pageid."&task=replies_replies");
		}
		wp_redirect($url); exit;
	}
}

$attachmentController = new attachmentController();
?>
