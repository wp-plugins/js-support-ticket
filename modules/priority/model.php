<?php
if(!defined('ABSPATH')) die('Restricted Access');

class priorityModel{

	function getPriorities(){
		// Filter
		$prioritytitle = request::getVar('title');
		$inquery = '';
		if($prioritytitle != null)
			$inquery .= " WHERE priority.priority LIKE '%$prioritytitle%'";

		// Pagination
		$query = "SELECT COUNT(priority.id) FROM `".jssupportticket::$_db->prefix."js_ticket_priorities` AS priority";
		$query .= $inquery;
		$total = jssupportticket::$_db->get_var($query);
		jssupportticket::$_data[1] = pagination::getPagination($total);		
		
		// Data
		$query = "SELECT priority.*
					FROM `".jssupportticket::$_db->prefix."js_ticket_priorities` AS priority ";
		$query .= $inquery;
		$query .= " ORDER BY priority.priority DESC LIMIT ".pagination::$_offset.", ".pagination::$_limit;
		jssupportticket::$_data[0] = jssupportticket::$_db->get_results($query);
		jssupportticket::$_data['prioritytitle'] = $prioritytitle;
		if(jssupportticket::$_db->last_error  != null){
			includer::getJSModel('systemerror')->addSystemError();
		}
		return;
	}

	function getPriorityForCombobox(){
		$query = "SELECT id, priority AS text FROM `".jssupportticket::$_db->prefix."js_ticket_priorities`";
		if(!is_admin()){
			$query .= ' WHERE ispublic = 1 ';
		}
		$emails = jssupportticket::$_db->get_results($query);
		if(jssupportticket::$_db->last_error  != null){
			includer::getJSModel('systemerror')->addSystemError();
		}
		return $emails;
	}

	function getPriorityForForm($id){
		if ($id) {
			$query = "SELECT priority.*
						FROM `".jssupportticket::$_db->prefix."js_ticket_priorities` AS priority
						WHERE priority.id = ".$id;
			jssupportticket::$_data[0] = jssupportticket::$_db->get_row($query);
			if(jssupportticket::$_db->last_error  != null){
				includer::getJSModel('systemerror')->addSystemError();// if there is an error add it to system errorrs
			}
		}
		return;
	}

	function storePriority($data){
		$query_array = array('id' => $data['id'],
							'priority' => $data['priority'],
							'prioritycolour' => $data['prioritycolor'],
							'priorityurgency' => $data['priorityurgency'],
							'ispublic' => $data['ispublic'],
							'isdefault' => $data['isdefault'],
							'status' => $data['status']
							);
		jssupportticket::$_db->replace(jssupportticket::$_db->prefix.'js_ticket_priorities',$query_array);
		$id = jssupportticket::$_db->insert_id;
		if($data['isdefault'] == 1){
			$this->setDefaultPriority($id);
		}
		if(jssupportticket::$_db->last_error  == null){
			message::setMessage(__('PRIORITY_HAS_BEEN_STORED','js-support-ticket'),'updated');
		}else{
			includer::getJSModel('systemerror')->addSystemError();// if there is an error add it to system errorrs
			message::setMessage(__('PRIORITY_HAS_NOT_BEEN_STORED','js-support-ticket'),'error');
		}
		return;
	}

	function setDefaultPriority($id){
		if(!is_numeric($id)) return false;
		$query = "UPDATE `".jssupportticket::$_db->prefix."js_ticket_priorities` SET isdefault = 2";
		jssupportticket::$_db->query($query);
		$query = "UPDATE `".jssupportticket::$_db->prefix."js_ticket_priorities` SET isdefault = 1 WHERE id = ".$id;
		jssupportticket::$_db->query($query);
		return;
	}

	function removePriority($id){
		if(!is_numeric($id)) return false;
		if($this->canRemovePriority($id)){
			jssupportticket::$_db->delete( jssupportticket::$_db->prefix.'js_ticket_priorities', array( 'id' => $id ) );
			if(jssupportticket::$_db->last_error  == null){
				message::setMessage(__('PRIORITY_HAS_BEEN_DELETED','js-support-ticket'),'updated');
			}else{
				includer::getJSModel('systemerror')->addSystemError();// if there is an error add it to system errorrs
				message::setMessage(__('PRIORITY_HAS_NOT_BEEN_DELETED','js-support-ticket'),'error');
			}
		}else{
			message::setMessage(__('PRIORITY_IN_USE_CANNOT_DELETED','js-support-ticket'),'error');
		}
		return;
	}

	private function canRemovePriority($id){
		if(!is_numeric($id)) return false;
		$query = "SELECT (	(SELECT COUNT(id) FROM `".jssupportticket::$_db->prefix."js_ticket_priorities` WHERE id = ".$id." AND isdefault = 1)
					+(SELECT COUNT(id) FROM `".jssupportticket::$_db->prefix."js_ticket_email` WHERE priorityid = ".$id.")
					+(SELECT COUNT(id) FROM `".jssupportticket::$_db->prefix."js_ticket_tickets` WHERE priorityid = ".$id.")
					) AS total";
		$result = jssupportticket::$_db->get_var($query);
		if(jssupportticket::$_db->last_error  != null){
			includer::getJSModel('systemerror')->addSystemError();
		}
		if($result == 0) return true;
		else return false;
	}

	function getDefaultPriorityId(){
		$query = "SELECT id FROM `".jssupportticket::$_db->prefix."js_ticket_priorities` WHERE isdefault = 1";
		$id = jssupportticket::$_db->get_var($query);
		return $id;
	}

}

?>