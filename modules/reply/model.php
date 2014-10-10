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

class replyModel{

	function getReplies($id){
		if(!is_numeric($id)) return false;
		// Data
		$query = "SELECT replies.*,replies.id AS replyid,tickets.id 
					FROM `".jssupportticket::$_db->prefix."js_ticket_replies` AS replies 
					JOIN `".jssupportticket::$_db->prefix."js_ticket_tickets` AS tickets ON  replies.ticketid = tickets.id 
					WHERE tickets.id = ".$id;
		jssupportticket::$_data[4] = jssupportticket::$_db->get_results($query);
		if(jssupportticket::$_db->last_error  != null){
			includer::getJSModel('systemerror')->addSystemError();
		}
		$attachmentmodel = includer::getJSModel('attachment');
		foreach(jssupportticket::$_data[4] AS $reply){
			$reply->attachments = $attachmentmodel->getAttachmentForReply($reply->id,$reply->replyid);
		}
		return;
	}

	function getTicketNameForReplies(){
		$query = "SELECT id, ticketid AS text FROM `".jssupportticket::$_db->prefix."js_ticket_tickets`";
		$list = jssupportticket::$_db->get_results($query);
		if(jssupportticket::$_db->last_error  != null){
			includer::getJSModel('systemerror')->addSystemError();
		}
		return $list;
	}

	function getRepliesForForm($id){
		if ($id) {
			$query = "SELECT replies.*,tickets.id 
						FROM `".jssupportticket::$_db->prefix."js_ticket_replies` AS replies 
						JOIN `".jssupportticket::$_db->prefix."js_ticket_tickets` AS tickets ON  replies.ticketid = tickets.id 
						WHERE replies.id = ".$id;
			jssupportticket::$_data[0] = jssupportticket::$_db->get_row($query);
			if(jssupportticket::$_db->last_error  != null){
				includer::getJSModel('systemerror')->addSystemError();// if there is an error add it to system errorrs
			}
		}
		return;
	}
	function storeReplies($data){
		$sendEmail = true;
		$data['created'] = date('Y-m-d H:i:s');
		$current_user = wp_get_current_user();
		$currentUserName = $current_user->display_name;
		$query_array = array('id' => $data['id'],
							'uid' => $data['uid'],
							'ticketid' => $data['ticketid'],
							'name' => $currentUserName,
							'message' => $data['message'],
							'status' => $data['status'],
							'created' => $data['created']
							);
		jssupportticket::$_db->replace(jssupportticket::$_db->prefix.'js_ticket_replies',$query_array);
		$replyid = jssupportticket::$_db->insert_id;
		if(jssupportticket::$_db->last_error == null){
			//tickets attachments store
			$data['replyattachmentid'] = jssupportticket::$_db->insert_id;
			includer::getJSModel('attachment')->storeAttachments($data);
			//reply stored change action		
			if(is_admin()) includer::getJSModel('ticket')->setStatus(3,$data['ticketid']); // 3 -> waiting for customer reply
			else includer::getJSModel('ticket')->setStatus(1,$data['ticketid']); // 1 -> waiting for admin/staff reply
			includer::getJSModel('ticket')->updateLastReply($data['ticketid']);
			message::setMessage(__('REPLY_HAS_BEEN_STORED','js-support-ticket'),'updated');
			$messagetype = __('SUCCESSFULLY','js-support-ticket');
		}else{
			includer::getJSModel('systemerror')->addSystemError();// if there is an error add it to system errorrs
			message::setMessage(__('REPLY_HAS_NOT_BEEN_STORED','js-support-ticket'),'error');
			$messagetype = __('ERROR','js-support-ticket');
			$sendEmail = false;			
		}

		/* for activity log */
		$ticketid = $data['ticketid'];// get the ticket id
		$current_user = wp_get_current_user();// to get current user name
		$currentUserName = $current_user->display_name;
		$eventtype = 'REPLIED_TICKET';
		$message = __('TICKET_IS_REPLIED_BY','js-support-ticket')." ( ".$currentUserName." ) ";
		includer::getJSModel('activitylog')->addActivityLog( $ticketid , 1 , $eventtype , $message , $messagetype );

		// Send Emails
		if($sendEmail == true){
			if(is_admin()){
				includer::getJSModel('email')->sendMail(1,4,$ticketid);// Mailfor, Reply Ticket
			}else{
				includer::getJSModel('email')->sendMail(1,5,$ticketid);// Mailfor, Reply Ticket
			}
			$ticketreplyobject = jssupportticket::$_db->get_row("SELECT * FROM `".jssupportticket::$_db->prefix."js_ticket_replies` WHERE id = ".$replyid);
			do_action('jsst-ticketreply',$ticketreplyobject);
		}

		return;
	}

	function removeReplies($id){
		if(!is_numeric($id)) return false;
		jssupportticket::$_db->delete( jssupportticket::$_db->prefix.'js_ticket_replies', array( 'id' => $id ) );
		if(jssupportticket::$_db->last_error  == null){
			message::setMessage(__('REPLY_HAS_BEEN_DELETED','js-support-ticket'),'updated');
		}else{
			includer::getJSModel('systemerror')->addSystemError();// if there is an error add it to system errorrs
			message::setMessage(__('REPLY_HAS_NOT_BEEN_DELETED','js-support-ticket'),'error');
		}
		return;
	}
}

?>
