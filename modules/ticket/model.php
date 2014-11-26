<?php
if(!defined('ABSPATH')) die('Restricted Access');

class ticketModel{

	function getTickets(){
		$this->getOrdering();
		// Filter
		$inquery = '';
        	$ticketid = request::getVar('ticketid','post',null);
		if($ticketid != null){
			if(strlen($ticketid) == 9){
				if(!strstr($ticketid,' ')){
					$inquery = " AND ticket.ticketid LIKE '%$ticketid%'";
				}else{
					$inquery = " AND ticket.subject LIKE '%$ticketid%'";
				}
			}else{
				$inquery = " AND ticket.subject LIKE '%$ticketid%'";
			}
			jssupportticket::$_data['filter_ticketid'] = $ticketid;
		}

		// Pagination
		$query = "SELECT COUNT(ticket.id) FROM `".jssupportticket::$_db->prefix."js_ticket_tickets` AS ticket WHERE 1 = 1 ";
		$query .= $inquery;
		$total = jssupportticket::$_db->get_var($query);
		jssupportticket::$_data[1] = pagination::getPagination($total);		
		
		// Data
		$query = "SELECT ticket.*,department.departmentname AS departmentname ,priority.priority AS priority,priority.prioritycolour AS prioritycolour
					FROM `".jssupportticket::$_db->prefix."js_ticket_tickets` AS ticket
					JOIN `".jssupportticket::$_db->prefix."js_ticket_departments` AS department ON ticket.departmentid = department.id
					JOIN `".jssupportticket::$_db->prefix."js_ticket_priorities` AS priority ON ticket.priorityid = priority.id";
		$query .= ' WHERE 1 = 1 ';
		$query .= $inquery;
		$query .= " ORDER BY ".jssupportticket::$_ordering." LIMIT ".pagination::$_offset.", ".pagination::$_limit;
		jssupportticket::$_data[0] = jssupportticket::$_db->get_results($query);
		//Hook action
		do_action('jsst-ticketbeforelisting',jssupportticket::$_data[0]);
		jssupportticket::$_data['ticketsubject'] = $ticketid;
		if(jssupportticket::$_db->last_error  != null){
			includer::getJSModel('systemerror')->addSystemError();
		}
		return;
	}

	function getOrdering(){
	    $sort = request::getVar('sortby', '');
	    if ($sort == '') $sort = 'statusasc';
	    $this->getTicketListOrdering($sort);
	    $this->getTicketListSorting($sort);
	}

	function getMyTickets($list,$ticketid){
		$this->getOrdering();
		// Filter
		/*
		list variable detail
		1=>For open ticket
		2=>For closed ticket
		3=>For open answered ticket
		4=>For all my tickets
		*/
        $list = request::getVar('list',null,1);
        jssupportticket::$_data['list'] = $list; // assign for reference
		$inquery = '';
		switch($list){
			// Ticket Default Status
			// 0 -> New Ticket
			// 1 -> Waiting admin/staff reply
			// 2 -> in progress
			// 3 -> waiting for customer reply
			// 4 -> close ticket
			case 1:$inquery .= " AND ticket.status = 0 ";break;
			case 2:$inquery .= " AND ticket.status = 4 ";break;
			case 3:$inquery .= " AND ticket.status = 3 ";break;
			case 4:$inquery .= " ";break;
		}

        $ticketid = request::getVar('ticketid','post',null);
		if($ticketid != null){
			if(strlen($ticketid) == 9){
				if(!strstr($ticketid,' ')){
					$inquery = " AND ticket.ticketid LIKE '%$ticketid%'";
				}else{
					$inquery = " AND ticket.subject LIKE '%$ticketid%'";
				}
			}else{
				$inquery = " AND ticket.subject LIKE '%$ticketid%'";
			}
			jssupportticket::$_data['filter_ticketid'] = $ticketid;
		}

		$uid = get_current_user_id();
		// Pagination
		$query = "SELECT COUNT(`id`) FROM `".jssupportticket::$_db->prefix."js_ticket_tickets` AS ticket WHERE ticket.uid = $uid ";
		$query .= $inquery;
		$total = jssupportticket::$_db->get_var($query);
		jssupportticket::$_data[1] = pagination::getPagination($total);		
		
		// Data
		$query = "SELECT ticket.*,department.departmentname AS departmentname ,priority.priority AS priority,priority.prioritycolour AS prioritycolour
					FROM `".jssupportticket::$_db->prefix."js_ticket_tickets` AS ticket
					JOIN `".jssupportticket::$_db->prefix."js_ticket_departments` AS department ON ticket.departmentid = department.id
					JOIN `".jssupportticket::$_db->prefix."js_ticket_priorities` AS priority ON ticket.priorityid = priority.id";
		$query .= " WHERE ticket.uid = $uid ".$inquery;
		$query .= " ORDER BY ".jssupportticket::$_ordering." LIMIT ".pagination::$_offset.", ".pagination::$_limit;
		jssupportticket::$_data[0] = jssupportticket::$_db->get_results($query);
		if(jssupportticket::$_db->last_error  != null){
			includer::getJSModel('systemerror')->addSystemError();
		}
		return;
	}

	function getTicketsForForm($id){
		if ($id) {
			$query = "SELECT ticket.*,department.departmentname AS departmentname ,priority.priority AS priority,priority.prioritycolour AS prioritycolour
						FROM `".jssupportticket::$_db->prefix."js_ticket_tickets` AS ticket
						JOIN `".jssupportticket::$_db->prefix."js_ticket_departments` AS department ON ticket.departmentid = department.id
						JOIN `".jssupportticket::$_db->prefix."js_ticket_priorities` AS priority ON ticket.priorityid = priority.id
						WHERE ticket.id = ".$id;
			jssupportticket::$_data[0] = jssupportticket::$_db->get_row($query);
			if(jssupportticket::$_db->last_error != null){
				includer::getJSModel('systemerror')->addSystemError();// if there is an error add it to system errorrs
			}
		}
		includer::getJSModel('userfeild')->getUserFieldsForForm(1,$id);
		includer::getJSModel('attachment')->getAttachmentForForm($id);
		return;
	}

	function getTicketForDetail($id){
		if(!is_numeric($id)) return $id;
		$query = "SELECT ticket.*,department.departmentname AS departmentname ,priority.priority AS priority,priority.prioritycolour AS prioritycolour
					FROM `".jssupportticket::$_db->prefix."js_ticket_tickets` AS ticket
					JOIN `".jssupportticket::$_db->prefix."js_ticket_departments` AS department ON ticket.departmentid = department.id
					JOIN `".jssupportticket::$_db->prefix."js_ticket_priorities` AS priority ON ticket.priorityid = priority.id
					WHERE ticket.id = ".$id;
		jssupportticket::$_data[0] = jssupportticket::$_db->get_row($query);
		if(jssupportticket::$_db->last_error  != null){
			includer::getJSModel('systemerror')->addSystemError();
		}
		includer::getJSModel('reply')->getReplies($id);
	 	includer::getJSModel('userfeild')->getUserFieldsForView(1, $id);
		jssupportticket::$_data['ticket_attachment'] = includer::getJSModel('attachment')->getAttachmentForReply($id,0);
		//Hooks
		do_action('jsst-ticketbeforeview',jssupportticket::$_data);
		return;
	}

	function getRandomTicketId(){
		$query = "SELECT ticketid FROM `".jssupportticket::$_db->prefix."js_ticket_tickets`";
		do{
			$ticketid = "";
			$length = 9;
			$possible = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";
			// we refer to the length of $possible a few times, so let's grab it now
			$maxlength = strlen($possible); 	
			if ($length > $maxlength) { // check for length overflow and truncate if necessary
				$length = $maxlength;
			}
			// set up a counter for how many characters are in the ticketid so far
			$i = 0;
			// add random characters to $password until $length is reached
			while ($i < $length) {
				// pick a random character from the possible ones
				$char = substr($possible, mt_rand(0, $maxlength-1), 1);
				if (!strstr($ticketid, $char)) {
					if($i == 0){
						if (ctype_alpha($char)){
							$ticketid .= $char;
							$i++;
						}
					}else{
						$ticketid .= $char;
						$i++;
					}
				}
			}
			$rows = jssupportticket::$_db->get_results($query);
			foreach($rows as $row){
				if($ticketid == $row->ticketid) $match = 'Y'; else $match = 'N';
			}
		}while($match == 'Y');
		return $ticketid;
	}

	function storeTickets($data){ 
		if(!is_admin()){
			$count_tickets = jssupportticket::$_db->get_var('SELECT COUNT(id) FROM `'.jssupportticket::$_db->prefix."js_ticket_tickets` WHERE email = '".$data['email']."'");
			if(jssupportticket::$_config['maximum_open_ticket_per_email'] < $count_tickets){
				message::setMessage( __('TICKET_LIMIT_HAS_BEEN_EXCEEDS','js-support-ticket'),'error');
				return;
			}
		}
		$sendEmail = true;
		if($data['id']){
			$sendEmail = false;
			$data['updated'] = date('Y-m-d H:i:s');
		}else{
			$data['ticketid'] = $this->getRandomTicketId();
			$data['created'] = date('Y-m-d H:i:s');
		}
		$query_array = array('id' => $data['id'],
							'email' => $data['email'],
							'name' => $data['name'],
							'uid' => $data['uid'],
							'phone' => $data['phone'],
							'phoneext' => $data['phoneext'],
							'departmentid' => $data['departmentid'],
							'priorityid' => $data['priorityid'],
							'subject' => $data['subject'],
							'message' => $data['message'],
							'status' => $data['status'],
							'duedate' => $data['duedate'],
							'lastreply' => $data['lastreply'],
							'created' => $data['created'],
							'updated' => $data['updated'],
							'ticketid' => $data['ticketid']
							);
		jssupportticket::$_db->replace(jssupportticket::$_db->prefix.'js_ticket_tickets',$query_array);
		if(jssupportticket::$_db->last_error  != null){
			includer::getJSModel('systemerror')->addSystemError();
			$messagetype = __('ERROR','js-support-ticket');
			$sendEmail = false;
			message::setMessage( __('TICKET_HAS_NOT_BEEN_STORED','js-support-ticket'),'error');
		}else{
			$ticketid = jssupportticket::$_db->insert_id;// get the ticket id
			$messagetype = __('SUCCESSFULLY','js-support-ticket');
			// Storing Userfields
			for($i = 1; $i <= $data['userfields_total']; $i++){
				$fname = "userfields_".$i;
				$fid = "userfields_".$i."_id";
				$dataid = "userdata_".$i."_id";
				$query_array = array('id' => $data[$dataid],
									'referenceid' => $ticketid,
									'field' => $data[$fid],
									'data' => $data[$fname]
									);
				jssupportticket::$_db->replace(jssupportticket::$_db->prefix.'js_ticket_userfield_data',$query_array);
				if(jssupportticket::$_db->last_error  != null){
					includer::getJSModel('systemerror')->addSystemError();
				}
			}
			// Storing Attachments
			$data['ticketid'] = $ticketid;
			includer::getJSModel('attachment')->storeAttachments($data);
			message::setMessage( __('TICKET_HAS_BEEN_STORED','js-support-ticket'),'updated');
		}

		/* for activity log */
		$current_user = wp_get_current_user();// to get current user name
		$currentUserName = $current_user->display_name;
		$eventtype = __('ADD_NEW_TICKET','js-support-ticket');
		$message = __('TICKET_IS_CREATED_BY','js-support-ticket')." ( ".$currentUserName." ) ";
		includer::getJSModel('activitylog')->addActivityLog( $ticketid , 1 , $eventtype , $message , $messagetype );
	
		// Send Emails
		if($sendEmail == true){
			includer::getJSModel('email')->sendMail(1,1,$ticketid);// Mailfor, Create Ticket, Ticketid
			//For Hook
			$ticketobject = jssupportticket::$_db->get_row("SELECT * FROM `".jssupportticket::$_db->prefix."js_ticket_tickets` WHERE id = ".$ticketid);
			do_action('jsst-ticketcreate',$ticketobject);
		}
		return;
	}

	function removeTicket($id){
		$sendEmail = true;
		if(!is_numeric($id)) return false;
		if($this->canRemoveTicket($id)){
			jssupportticket::$_data['ticketid'] = $this->getTrackingIdById($id);
			jssupportticket::$_data['ticketemail'] = $this->getTicketEmailById($id);
			jssupportticket::$_db->delete( jssupportticket::$_db->prefix.'js_ticket_tickets', array( 'id' => $id ) );

			if(jssupportticket::$_db->last_error == null){
				$messagetype = __('SUCCESSFULLY','js-support-ticket');
				message::setMessage(__('TICKET_HAS_BEEN_DELETED','js-support-ticket'),'updated');
			}else{
				includer::getJSModel('systemerror')->addSystemError();// if there is an error add it to system errorrs
				message::setMessage(__('TICKET_HAS_NOT_BEEN_DELETED','js-support-ticket'),'error');
				$messagetype = __('ERROR','js-support-ticket');
				$sendEmail = false;
			}
			
			/* for activity log */
			$ticketid = $id;// get the ticket id
			$current_user = wp_get_current_user();// to get current user name
			$currentUserName = $current_user->display_name;
			$eventtype = __('REMOVE_TICKET','js-support-ticket');
			$message = __('TICKET_IS_REMOVE_BY')." ( ".$currentUserName." ) ";
			includer::getJSModel('activitylog')->addActivityLog( $ticketid , 1 , $eventtype , $message , $messagetype );

			// Send Emails
			if($sendEmail == true){
				includer::getJSModel('email')->sendMail(1,3);// Mailfor, Delete Ticket
				$ticketobject = (object)array('ticketid'=>jssupportticket::$_data['ticketid'],'ticketemail'=>jssupportticket::$_data['ticketemail']);
				do_action('jsst-ticketdelete',$ticketobject);
			}
		}else{
			message::setMessage(__('TICKET_IN_USE_CANNOT_DELETED','js-support-ticket'),'error');
		}
			
		return;
	}

	private function canRemoveTicket($id){
		if(!is_numeric($id)) return false;
		$query = "SELECT (
					(SELECT COUNT(id) FROM `".jssupportticket::$_db->prefix."js_ticket_attachments` WHERE ticketid = ".$id.")
					+(SELECT COUNT(id) FROM `".jssupportticket::$_db->prefix."js_ticket_replies` WHERE ticketid = ".$id.")
					) AS total";
		$result = jssupportticket::$_db->get_var($query);
		if(jssupportticket::$_db->last_error  != null){
			includer::getJSModel('systemerror')->addSystemError();
		}
		if($result == 0) return true;
		else return false;
	}

	function getTrackingIdById($id){
		if(!is_numeric($id)) return false;
		$query = "SELECT ticketid FROM `".jssupportticket::$_db->prefix."js_ticket_tickets` WHERE id = ".$id;
		if(jssupportticket::$_db->last_error  != null){
			includer::getJSModel('systemerror')->addSystemError();
		}
		$ticketid = jssupportticket::$_db->get_var($query);
		return $ticketid;
	}

	function getTicketEmailById($id){
		if(!is_numeric($id)) return false;
		$query = "SELECT email FROM `".jssupportticket::$_db->prefix."js_ticket_tickets` WHERE id = ".$id;
		if(jssupportticket::$_db->last_error  != null){
			includer::getJSModel('systemerror')->addSystemError();
		}
		$ticketid = jssupportticket::$_db->get_var($query);
		return $ticketid;
	}

    function setStatus($status,$ticketid){
		// 0 -> New Ticket
		// 1 -> Waiting admin/staff reply
		// 2 -> in progress
		// 3 -> waiting for customer reply
		// 4 -> close ticket
    	if(!is_numeric($status)) return false;
    	if(!is_numeric($ticketid)) return false;
    	$query = "UPDATE `".jssupportticket::$_db->prefix."js_ticket_tickets` SET status = ".$status." WHERE id = ".$ticketid;
    	jssupportticket::$_db->query($query);
		if(jssupportticket::$_db->last_error  != null){
			includer::getJSModel('systemerror')->addSystemError();
		}
		return;
    }

    function updateLastReply($id){
    	if(!is_numeric($id)) return false;
    	$date = date('Y-m-d H:i:s');
    	$isanswered = " , isanswered = 0 ";
    	if(is_admin()){
    		$isanswered = " , isanswered = 1 ";
    	}
    	$query = "UPDATE `".jssupportticket::$_db->prefix."js_ticket_tickets` SET lastreply = '".$date."' ".$isanswered." WHERE id = ".$id;
    	jssupportticket::$_db->query($query);
		if(jssupportticket::$_db->last_error  != null){
			includer::getJSModel('systemerror')->addSystemError();
		}
		return;
    }

    function closeTicket($id){
    	if(!is_numeric($id)) return false;
    	$sendEmail = true;
    	$date = date('Y-m-d H:i:s');
    	$query = "UPDATE `".jssupportticket::$_db->prefix."js_ticket_tickets` SET status = 4, closed = '".$date."' WHERE id = ".$id;
    	jssupportticket::$_db->query($query);
		if(jssupportticket::$_db->last_error  == null){
			message::setMessage(__('TICKET_HAS_BEEN_CLOSED','js-support-ticket'),'updated');
			$messagetype = __('SUCCESSFULLY','js-support-ticket');
		}else{
			includer::getJSModel('systemerror')->addSystemError();// if there is an error add it to system errorrs
			message::setMessage(__('TICKET_HAS_NOT_BEEN_CLOSED','js-support-ticket'),'error');
			$messagetype = __('ERROR','js-support-ticket');
			$sendEmail = false;
		}

		/* for activity log */
		$ticketid = $id;// get the ticket id
		$current_user = wp_get_current_user();// to get current user name
		$currentUserName = $current_user->display_name;
		$eventtype = __('CLOSE_TICKET','js-support-ticket');
		$message = __('TICKET_IS_CLOSE_BY','js-support-ticket')." ( ".$currentUserName." ) ";
		includer::getJSModel('activitylog')->addActivityLog( $ticketid , 1 , $eventtype , $message , $messagetype );

		// Send Emails
		if($sendEmail == true){
			includer::getJSModel('email')->sendMail(1,2,$ticketid);// Mailfor, Close Ticket, Ticketid
			$ticketobject = jssupportticket::$_db->get_row("SELECT * FROM `".jssupportticket::$_db->prefix."js_ticket_tickets` WHERE id = ".$ticketid);
			do_action('jsst-ticketclose',$ticketobject);
		}

		return;
    }

    function getTicketListOrdering($sort) {
        switch ($sort) {
            case "subjectdesc": 
            	jssupportticket::$_ordering = "ticket.subject DESC";
            	jssupportticket::$_sorton = "subject";
            	jssupportticket::$_sortorder = "DESC";
            break;
            case "subjectasc": 
            	jssupportticket::$_ordering = "ticket.subject ASC";
            	jssupportticket::$_sorton = "subject";
            	jssupportticket::$_sortorder = "ASC";
            break;
            case "prioritydesc": 
            	jssupportticket::$_ordering = "priority DESC";
            	jssupportticket::$_sorton = "priority";
            	jssupportticket::$_sortorder = "DESC";
            break;
            case "priorityasc": 
            	jssupportticket::$_ordering = "priority ASC";
            	jssupportticket::$_sorton = "priority";
            	jssupportticket::$_sortorder = "ASC";
            break;
            case "ticketiddesc": 
            	jssupportticket::$_ordering = "ticket.ticketid DESC";
            	jssupportticket::$_sorton = "ticketid";
            	jssupportticket::$_sortorder = "DESC";
            break;
            case "ticketidasc": 
            	jssupportticket::$_ordering = "ticket.ticketid ASC";
            	jssupportticket::$_sorton = "ticketid";
            	jssupportticket::$_sortorder = "ASC";
            break;
            case "isanswereddesc": 
            	jssupportticket::$_ordering = "ticket.isanswered DESC";
            	jssupportticket::$_sorton = "isanswered";
            	jssupportticket::$_sortorder = "DESC";
            break;
            case "isansweredasc": 
            	jssupportticket::$_ordering = "ticket.isanswered ASC";
            	jssupportticket::$_sorton = "isanswered";
            	jssupportticket::$_sortorder = "ASC";
            break;
            case "statusdesc": 
            	jssupportticket::$_ordering = "ticket.status DESC";
            	jssupportticket::$_sorton = "status";
            	jssupportticket::$_sortorder = "DESC";
            break;
            case "statusasc": 
            	jssupportticket::$_ordering = "ticket.status ASC";
            	jssupportticket::$_sorton = "status";
            	jssupportticket::$_sortorder = "ASC";
            break;
            case "createddesc": 
            	jssupportticket::$_ordering = "ticket.created DESC";
            	jssupportticket::$_sorton = "created";
            	jssupportticket::$_sortorder = "DESC";
            break;
            case "createdasc": 
            	jssupportticket::$_ordering = "ticket.created ASC";
            	jssupportticket::$_sorton = "created";
            	jssupportticket::$_sortorder = "ASC";
            break;
            default: jssupportticket::$_ordering = "ticket.id DESC";
        }
        return;
    }

    function getSortArg($type, $sort) {
        $mat = array();
        if (preg_match("/(\w+)(asc|desc)/i", $sort, $mat)) {
            if ($type == $mat[1]) {
                return ( $mat[2] == "asc" ) ? "{$type}desc" : "{$type}asc";
            } else {
                return $type . $mat[2];
            }
        }
        return "iddesc";
    }

    function getTicketListSorting($sort) {
        jssupportticket::$_sortlinks['subject'] = $this->getSortArg("subject", $sort);
        jssupportticket::$_sortlinks['priority'] = $this->getSortArg("priority", $sort);
        jssupportticket::$_sortlinks['ticketid'] = $this->getSortArg("ticketid", $sort);
        jssupportticket::$_sortlinks['isanswered'] = $this->getSortArg("isanswered", $sort);
        jssupportticket::$_sortlinks['status'] = $this->getSortArg("status", $sort);
        jssupportticket::$_sortlinks['created'] = $this->getSortArg("created", $sort);
        return;
    }
}

?>