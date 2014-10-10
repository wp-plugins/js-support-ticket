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

class systemerrorModel{

	function getSystemErrors(){
		// Filter
		$error = request::getVar('error');
		$inquery = '';
		if($error != null)
			$email .= " WHERE systemerror.error LIKE '%$error%'";

		// Pagination
		$query = "SELECT COUNT(`id`) FROM `".jssupportticket::$_db->prefix."js_ticket_system_errors`";
		$query .= $inquery;
		$total = jssupportticket::$_db->get_var($query);
		jssupportticket::$_data[1] = pagination::getPagination($total);		
		
		// Data
		$query = " SELECT systemerror.*
					FROM `".jssupportticket::$_db->prefix."js_ticket_system_errors` AS systemerror ";
		$query .= $inquery;
		$query .= " ORDER BY systemerror.created DESC LIMIT ".pagination::$_offset.", ".pagination::$_limit;
		jssupportticket::$_data[0] = jssupportticket::$_db->get_results($query);
		jssupportticket::$_data['error'] = $error;
		if(jssupportticket::$_db->last_error  != null){
			$this->addSystemError();
		}
		return;
	}

	function addSystemError(){
		$data['error'] = jssupportticket::$_db->last_error;
		$data['created'] = date('Y-m-d H:i:s');
		$query_array = array('error' => $data['error'],
							'uid' =>  get_current_user_id(),
							'isview' => 0,
							'created' => $data['created']
							);
		jssupportticket::$_db->replace(jssupportticket::$_db->prefix.'js_ticket_system_errors',$query_array);
		if(jssupportticket::$_db->last_error  != null){
			$this->addSystemError();
		}
		return;
	}
	
	function updateIsView($id){
		if(!is_numeric($id)) return False;
		$query = "UPDATE ".jssupportticket::$_db->prefix."`js_ticket_system_errors` set isview = 1 WHERE id = ".$id;
		jssupportticket::$_db->Query($query);
		if(jssupportticket::$_db->last_error  != null){
			$this->addSystemError();
		}
	}

	
}

?>
