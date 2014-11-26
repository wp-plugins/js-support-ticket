<?php
if(!defined('ABSPATH')) die('Restricted Access');

class userfeildModel{

	function getUserFields($fieldfor){
		if(!is_numeric($fieldfor)) return false;
		// Filter
		$fieldname = request::getVar('fieldname');
		$inquery = '';
		if($fieldname != null)
			$inquery .= " AND field.name LIKE '%$fieldname%'";

		$query = "SELECT field.* FROM `".jssupportticket::$_db->prefix."js_ticket_userfields` AS field WHERE fieldfor = '". $fieldfor."'";
		$query .= $inquery;
		$query .= " ORDER BY field.id";
		jssupportticket::$_data[0] = jssupportticket::$_db->get_results($query);
		jssupportticket::$_data['fieldname'] = $fieldname;
		if(jssupportticket::$_db->last_error  != null){
			includer::getJSModel('systemerror')->addSystemError();
		}
		return;
	}

	function  getUserFieldbyId($id){
		if($id){ // edit case
			$query = "SELECT * FROM `".jssupportticket::$_db->prefix."js_ticket_userfields` WHERE id = ".$id;
			jssupportticket::$_data[0] = jssupportticket::$_db->get_results($query);
			if(jssupportticket::$_db->last_error  != null){
				includer::getJSModel('systemerror')->addSystemError();
			}
			$query = "SELECT * FROM `".jssupportticket::$_db->prefix."js_ticket_userfieldvalues` WHERE field = ".$id;
			jssupportticket::$_data[1]=jssupportticket::$_db->get_results($query);
			if(jssupportticket::$_db->last_error  != null){
				includer::getJSModel('systemerror')->addSystemError();// if there is an error add it to system errorrs
			}
		}else{
			jssupportticket::$_data[0] = array();
		}
		return;
	}

	function storeUserFeild($data){
		$query_array =  array('id' => $data['id'],
							'name' => $data['name'],
							'title' => $data['title'],
							'type' => $data['type'],
							'readonly' => $data['readonly'],
							'published' => $data['published'],
							'required' => $data['required'],
							'maxlength' => $data['maxlength'],
							'size' => $data['size'],
							'fieldfor' => $data['fieldfor']
							);
		$object = jssupportticket::$_db->replace(jssupportticket::$_db->prefix.'js_ticket_userfields',$query_array);
		$lastid = jssupportticket::$_db->insert_id; // to get the id of userfeild
		if(jssupportticket::$_db->last_error  != null){
			includer::getJSModel('systemerror')->addSystemError();
			message::setMessage(__('USER_FIELD_HAS_NOT_BEEN_STORED','js-support-ticket'),'error');
		}else{
			message::setMessage(__('USER_FIELD_HAS_BEEN_STORED','js-support-ticket'),'updated');
			if($data['type']){
				$ids = $data['jsIds'];
				$names = $data['jsNames'];
				$values = $data['jsValues'];
				$fieldvaluedata = array();
				for ($i=0; $i <= $data['valueCount'];$i++) {
					if(isset($ids[$i])) $fieldvaluedata['id'] = $ids[$i];
					else $fieldvaluedata['id'] = '';
					$fieldvaluedata['field'] = $lastid ;
					$fieldvaluedata['fieldtitle'] = $names[$i];
					$fieldvaluedata['fieldvalue'] = $values[$i];
					$fieldvaluedata['ordering'] = $i + 1;
					$fieldvaluedata['sys'] = 0;
					jssupportticket::$_db->replace(jssupportticket::$_db->prefix.'js_ticket_userfieldvalues',$fieldvaluedata);
					if(jssupportticket::$_db->last_error  != null){
						includer::getJSModel('systemerror')->addSystemError();
					}
				}
			}
		}
		return;
	}
	
	function removeUserFeild($id){
		if(!is_numeric($id)) return false;
		$data = self :: canRemoveUserFeild($id);
		if($this->canRemoveUserFeild($id)){
			jssupportticket::$_db->delete( jssupportticket::$_db->prefix.'js_ticket_userfields', array( 'id' => $id ) );
			if(jssupportticket::$_db->last_error  == Null){
				message::setMessage(__('USER_FIELD_HAS_BEEN_DELETED','js-support-ticket'),'updated');
			}else{
				includer::getJSModel('systemerror')->addSystemError();// if there is an error add it to system errorrs
				message::setMessage(__('USER_FIELD_HAS_NOT_BEEN_DELETED','js-support-ticket'),'error');
			}
		}else{
			message::setMessage(__('USER_FIELD_IN_USE_CANNOT_DELETED','js-support-ticket'),'error');
		}
		return;
	}

    private function canRemoveUserFeild($id){
		if(!is_numeric($id)) return false;
		$query = "SELECT COUNT(userfield.id) 
					FROM `".jssupportticket::$_db->prefix."js_ticket_userfields` AS userfield 
					JOIN `".jssupportticket::$_db->prefix."js_ticket_userfield_data` AS userfield_data ON userfield.id = userfield_data.field ";
        $result = jssupportticket::$_db->get_var($query);

		if(jssupportticket::$_db->last_error  != null){
			includer::getJSModel('systemerror')->addSystemError();
		}
		if($result == 0) return true;
		else return false;

        return $data;
        				
	}

	function getUserFieldsForView($fieldfor, $id){
		if($id != '') if(!is_numeric($id)) return false;
		if(!is_numeric($fieldfor)) return false;
		$field = array();
		$return = array();
		$query =  "SELECT  * FROM `".jssupportticket::$_db->prefix."js_ticket_userfields` AS ticket
					WHERE published = 1 AND fieldfor = ". $fieldfor;
		$rows = jssupportticket::$_db->get_results($query);
		if(jssupportticket::$_db->last_error  != null){
			includer::getJSModel('systemerror')->addSystemError();
		}
		$i = 0;
		foreach ($rows as $row){
			$field[0] = $row;
			if ($id != ""){
				$query =  "SELECT  * FROM `".jssupportticket::$_db->prefix."js_ticket_userfield_data` WHERE referenceid = ".$id." AND field = ". $row->id;
				$data= jssupportticket::$_db->get_row($query);
				if(jssupportticket::$_db->last_error  != null){
					includer::getJSModel('systemerror')->addSystemError();
				}
				$field[1] = $data;
			}
			if ($row->type == "select"){
				$query =  "SELECT  value.* FROM `".jssupportticket::$_db->prefix."js_ticket_userfieldvalues` AS value							
							WHERE value.field = ". $row->id.' AND value.id = '.$field[1]->data;
				$value = jssupportticket::$_db->get_row($query);
				if(jssupportticket::$_db->last_error  != null){
					includer::getJSModel('systemerror')->addSystemError();
				}
				$field[2] = $value;
			}
			$return[] = $field;
			$i++;
		}
		jssupportticket::$_data[2] = $return;
		return;
	}

 	function getUserFieldsForForm($fieldfor, $id) {
		if($id != '') if(!is_numeric($id)) return false;
		if(!is_numeric($fieldfor)) return false;
		$result;
		$field = array();
		$result = array();
		$query =  "SELECT  * FROM `".jssupportticket::$_db->prefix."js_ticket_userfields` AS ticket
					WHERE published = 1 AND fieldfor = ". $fieldfor;
		$rows = jssupportticket::$_db->get_results($query);
		if(jssupportticket::$_db->last_error  != null){
			includer::getJSModel('systemerror')->addSystemError();
		}
		$i = 0;
		foreach ($rows as $row){
		        $field[0] = $row;
		        if ($id != ""){
	                $query =  "SELECT  * FROM `".jssupportticket::$_db->prefix."js_ticket_userfield_data` WHERE referenceid = ".$id." AND field = ". $row->id;
					$data= jssupportticket::$_db->get_row($query);
					if(jssupportticket::$_db->last_error  != null){
						includer::getJSModel('systemerror')->addSystemError();
					}
	                $field[1] = $data;
		        }
		        if ($row->type == "select"){
	                $query =  "SELECT  * FROM `".jssupportticket::$_db->prefix."js_ticket_userfieldvalues` WHERE field = ". $row->id;
	                $data= jssupportticket::$_db->get_results($query);
					if(jssupportticket::$_db->last_error  != null){
						includer::getJSModel('systemerror')->addSystemError();
					}
	                $field[2] = $data;
		        }
		        $result[] = $field;
		        $i++;
		}
		jssupportticket::$_data[3] = $result;
		return;
    }
}

?>
