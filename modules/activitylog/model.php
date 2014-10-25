<?php
if(!defined('ABSPATH')) die('Restricted Access');

class activitylogModel{

	function getactivitylogs(){
		// Filter
		$event = request::getVar('event');
		$inquery = '';
		if($event != null)
			$inquery .= " WHERE activitylog.event LIKE '%$event%'";

		// Pagination
		$query = "SELECT COUNT(`id`) FROM `".jssupportticket::$_db->prefix."js_ticket_activity_log`";
		$query .= $inquery;
		$total = jssupportticket::$_db->get_var($query);
		jssupportticket::$_data[1] = pagination::getPagination($total);		
		
		// Data
		$query = "SELECT activitylog.*
				FROM `".jssupportticket::$_db->prefix."js_ticket_activity_log` AS activitylog ";
		$query .= $inquery;
		$query .= " ORDER BY activitylog.id DESC LIMIT ".pagination::$_offset.", ".pagination::$_limit;
		jssupportticket::$_data[0] = jssupportticket::$_db->get_results($query);
		if(jssupportticket::$_db->last_error  != null){
			includer::getJSModel('systemerror')->addSystemError();
		}
		return;
	}
	
	function addActivityLog($referenceid , $eventfor , $eventtype , $message , $messagetype){
		if(is_admin()){
			$level = 3 ;// 3 for admin 
		}else{
			$level = 1 ;// 1 for other activities
		}
		switch ($eventfor) {
			case 1:
				$event = __('TICKET','js-support-ticket');
				break;
		}
		$data['datetime'] = date('Y-m-d H:i:s');
		jssupportticket::$_db->replace(
			jssupportticket::$_db->prefix.'js_ticket_activity_log', //table
			array('uid' =>  get_current_user_id(),
				'referenceid' => $referenceid,
				'level' => $level,
				'eventfor' => $eventfor,
				'event' => $event,
				'eventtype' => $eventtype,
				'message' => $message,
				'messagetype' => $messagetype,
				'datetime' => $data['datetime']
					));
		if(jssupportticket::$_db->last_error  != null){
			message::setMessage(__('ACTIVITY_LOG_HAS_NOT_BEEN_UPDATED','js-support-ticket'),'error');
		}
		return;
	}

	
}

?>
