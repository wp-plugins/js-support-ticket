<?php
if(!defined('ABSPATH')) die('Restricted Access');

class departmentModel{

	function getDepartments(){
		// Filter
		$departmentname = request::getVar('departmentname');
		$inquery = '';
		if($departmentname != null)
			$inquery .= " WHERE department.departmentname LIKE '%$departmentname%'";

		// Pagination
		$query = "SELECT COUNT(department.id) FROM `".jssupportticket::$_db->prefix."js_ticket_departments` AS department";
		$query .= $inquery;
		$total = jssupportticket::$_db->get_var($query);
		jssupportticket::$_data[1] = pagination::getPagination($total);		
		
		// Data
		$query = "SELECT department.*,email.email AS outgoingemail
					FROM `".jssupportticket::$_db->prefix."js_ticket_departments` AS department 
					JOIN `".jssupportticket::$_db->prefix."js_ticket_email` AS email ON email.id = department.emailid ";
		$query .= $inquery;
		$query .= " ORDER BY department.status ASC,department.departmentname ASC LIMIT ".pagination::$_offset.", ".pagination::$_limit;
		jssupportticket::$_data[0] = jssupportticket::$_db->get_results($query);
		jssupportticket::$_data['departmentname'] = $departmentname;
		if(jssupportticket::$_db->last_error  != null){
			includer::getJSModel('systemerror')->addSystemError();
		}
		return;
	}

	function getDepartmentForForm($id){
		if ($id){
			$query = "SELECT department.*,email.email AS outgoingemail
						FROM `".jssupportticket::$_db->prefix."js_ticket_departments` AS department 
						JOIN `".jssupportticket::$_db->prefix."js_ticket_email` AS email ON email.id = department.emailid 
						WHERE department.id = ".$id;
			jssupportticket::$_data[0] = jssupportticket::$_db->get_row($query);
			if(jssupportticket::$_db->last_error  != null){
				includer::getJSModel('systemerror')->addSystemError();// if there is an error add it to system errorrs
			}
		}
		return;
	}

	function storeDepartment($data){
		if($data['id']) $data['updated'] = date('Y-m-d H:i:s');
		else $data['created'] = date('Y-m-d H:i:s');
		$query_array = array('id' => $data['id'],
							'emailid' => $data['emailid'],
							'ispublic' => $data['ispublic'],
							'departmentname' => $data['departmentname'],
							//'departmentsignature' => $data['departmentsignature'],
							//'canappendsignature' => $data['canappendsignature'],
							'status' => $data['status'],
							'created' => $data['created'],
							'updated' => $data['updated']
							);

		jssupportticket::$_db->replace(jssupportticket::$_db->prefix.'js_ticket_departments',$query_array);
		if(jssupportticket::$_db->last_error  == null){
			message::setMessage(__('DEPARTMENT_HAS_BEEN_STORED','js-support-ticket'),'updated');
		}else{
			includer::getJSModel('systemerror')->addSystemError();// if there is an error add it to system errorrs
			message::setMessage(__('DEPARTMENT_HAS_NOT_BEEN_STORED','js-support-ticket'),'error');
		}
		return;
	}

	function removeDepartment($id){
		if(!is_numeric($id)) return false;
		if($this->canRemoveDepartment($id)){
			jssupportticket::$_db->delete( jssupportticket::$_db->prefix.'js_ticket_departments', array( 'id' => $id ) );
			if(jssupportticket::$_db->last_error  == Null){
				message::setMessage(__('DEPARTMENT_HAS_BEEN_DELETED','js-support-ticket'),'updated');
			}else{
				includer::getJSModel('systemerror')->addSystemError();
				message::setMessage(__('DEPARTMENT_HAS_NOT_BEEN_DELETED','js-support-ticket'),'error');
			}
		}else{
			message::setMessage(__('DEPARTMENT_IN_USE_CANNOT_DELETED','js-support-ticket'),'error');
		}
		return;
	}

	private function canRemoveDepartment($id){
		if(!is_numeric($id)) return false;
		$query = "SELECT (
					(SELECT COUNT(id) FROM `".jssupportticket::$_db->prefix."js_ticket_tickets` WHERE departmentid = ".$id.")
					) AS total";
		$result = jssupportticket::$_db->get_var($query);
		if(jssupportticket::$_db->last_error  != null){
			includer::getJSModel('systemerror')->addSystemError();
		}
		if($result == 0) return true;
		else return false;
	}

	function getDepartmentForCombobox(){
		$query = "SELECT id, departmentname AS text FROM `".jssupportticket::$_db->prefix."js_ticket_departments` WHERE status = 1";
		$list = jssupportticket::$_db->get_results($query);
		if(jssupportticket::$_db->last_error  != null){
			includer::getJSModel('systemerror')->addSystemError();
		}
		return $list;
	}
}

?>