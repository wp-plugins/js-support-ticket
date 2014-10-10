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

class emailtemplateModel{

	function getTemplate($tempfor){
		switch($tempfor){
				case 'tk-nw' : $tempatefor = 'ticket-new'; break;
				case 'sntk-tk' : $tempatefor = 'ticket-staff'; break;
				case 'ew-md' : $tempatefor = 'department-new'; break;
				case 'ew-gr' : $tempatefor = 'group-new'; break;
				case 'ew-sm' : $tempatefor = 'staff-new'; break;
				case 'ew-ht' : $tempatefor = 'helptopic-new'; break;
				case 'rs-tk' : $tempatefor = 'reassign-tk'; break;
				case 'cl-tk' : $tempatefor = 'close-tk'; break;
				case 'dl-tk' : $tempatefor = 'delete-tk'; break;
				case 'mo-tk' : $tempatefor = 'moverdue-tk'; break;
				case 'be-tk' : $tempatefor = 'banemail-tk'; break;
				case 'be-trtk' : $tempatefor = 'banemail-trtk'; break;
				case 'dt-tk' : $tempatefor = 'deptrans-tk'; break;
				case 'ebct-tk' : $tempatefor = 'banemailcloseticket-tk'; break;
				case 'ube-tk' : $tempatefor = 'unbanemail-tk'; break;
				case 'rsp-tk' : $tempatefor = 'responce-tk'; break;
				case 'rpy-tk' : $tempatefor = 'reply-tk'; break;
				case 'tk-ew-ad' : $tempatefor = 'ticket-new-admin'; break;
		}
		$query = "SELECT * FROM `".jssupportticket::$_db->prefix."js_ticket_emailtemplates` WHERE templatefor = '".$tempatefor."'" ;
		jssupportticket::$_data[0] = jssupportticket::$_db->get_row(($query));
		if(jssupportticket::$_db->last_error  != null){
			includer::getJSModel('systemerror')->addSystemError();
		}
		return jssupportticket::$_data[0];
	}

	function storeEmailTemplate($data){
		$data['body'] = stripslashes($data['body']);
		$query_array = array('id' => $data['id'],
							'templatefor' => $data['templatefor'],
							'title' => $data['title'],
							'subject' => $data['subject'],
							'body' => stripslashes($data['body']),
							'status' => $data['status']
							);
		jssupportticket::$_db->replace(jssupportticket::$_db->prefix.'js_ticket_emailtemplates',$query_array);
		if(jssupportticket::$_db->last_error  == Null){
			message::setMessage(__('EMAIL_TEMPLATE_HAS_BEEN_STORED','js-support-ticket'),'updated');
		}else{
			includer::getJSModel('systemerror')->addSystemError();// if there is an error add it to system errorrs
			message::setMessage(__('EMAIL_TEMPLATE_HAS_NOT_BEEN_STORED','js-support-ticket'),'error');
		}
		return;
	}
}

?>
