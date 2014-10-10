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

class emailModel{

	/*
		$mailfor
		For which purpose you want to send mail
		1 => Ticket

		$action
		For which action of $mailfor you want to send the mail
		1 => New Ticket Create
		2 => Close Ticket
		3 => Delete Ticket
		4 => Reply Ticket (Admin/Staff Member)
		5 => Reply Ticket (Ticket member)

		$id
		id required when recever emailaddress is stored in record
	*/
	function sendMail($mailfor,$action,$id = null){
		if(!is_numeric($mailfor)) return false;
		if(!is_numeric($action)) return false;
		if($id != null) if(!is_numeric($id)) return false;
		$pageid = jssupportticket::$_db->get_var("Select id FROM `".jssupportticket::$_db->prefix."posts` WHERE post_name = 'js-support-ticket-controlpanel'");
		switch ($mailfor) {
			case 1: // Mail For Tickets
				switch ($action) {
					case 1: // New Ticket Created
						$ticketRecord = $this->getRecordByTablenameAndId('js_ticket_tickets',$id);
	                    $Username = $ticketRecord->name;
	                    $Subject = $ticketRecord->subject;
	                    $TrackingId = $ticketRecord->ticketid;
	                    $Email = $ticketRecord->email;
	                    $Message = $ticketRecord->message;

	                    $matcharray = array(
	                    					'{USERNAME}'=>$Username,
	                    					'{SUBJECT}'=>$Subject,
	                    					'{TRACKINGID}'=>$TrackingId,
	                    					'{EMAIL}'=>$Email,
	                    					'{MESSAGE}'=>$Message
                    					);

                        $object = $this->getSenderEmailAndName($id);
                        $senderEmail = $object->email;
                        $senderName = $object->name;
						// New ticket mail to admin
						if(jssupportticket::$_config['new_ticket_mail_to_admin'] == 1){ 
							$adminEmail = jssupportticket::$_config['default_admin_email'];
							$template = $this->getTemplateForEmail('ticket-new-admin');
							//Parsing template
		                    $msgSubject = $template->subject;
		                    $msgBody = $template->body;
		                    //Replace Data
		                    $link = "<a href=".admin_url("admin.php?page=ticket_tickets&task=ticket_ticketdetail&jssupportticket_ticketid=".$id).">".__('TICKET_DETAIL','js-support-ticket')."</a>";

		                    $matcharray['{TICKETURL}'] = $link;

		                    $this->replaceMatches($msgSubject,$matcharray);
		                    $this->replaceMatches($msgBody,$matcharray);

                            $this->sendEmail($adminEmail,$msgSubject,$msgBody,$senderEmail,$senderName,'',$action);
						}
						// New ticket mail to User
						$template = $this->getTemplateForEmail('ticket-new');
						//Parsing template
	                    $msgSubject = $template->subject;
	                    $msgBody = $template->body;
	                    //Replace Data
	                    $link = "<a href=".site_url("?page_id=".$pageid."&task=ticket_ticketdetail&jssupportticket_ticketid=".$id).">".__('TICKET_DETAIL','js-support-ticket')."</a>";

	                    $matcharray['{TICKETURL}'] = $link;

	                    $this->replaceMatches($msgSubject,$matcharray);
	                    $this->replaceMatches($msgBody,$matcharray);

                        $this->sendEmail($Email,$msgSubject,$msgBody,$senderEmail,$senderName,'',$action);
					break;
					case 2: // Close Ticket
						$ticketRecord = $this->getRecordByTablenameAndId('js_ticket_tickets',$id);
	                    $Username = $ticketRecord->name;
	                    $Subject = $ticketRecord->subject;
	                    $TrackingId = $ticketRecord->ticketid;
	                    $Email = $ticketRecord->email;
	                    $Message = $ticketRecord->message;

	                    $matcharray = array(
	                    					'{USERNAME}'=>$Username,
	                    					'{SUBJECT}'=>$Subject,
	                    					'{TRACKINGID}'=>$TrackingId,
	                    					'{EMAIL}'=>$Email,
	                    					'{MESSAGE}'=>$Message
                    					);

                        $object = $this->getSenderEmailAndName($id);
                        $senderEmail = $object->email;
                        $senderName = $object->name;

						$template = $this->getTemplateForEmail('close-tk');
						//Parsing template
	                    $msgSubject = $template->subject;
	                    $msgBody = $template->body;
	                    $msgSubjectUser = $template->subject;
	                    $msgBodyUser = $template->body;

						// New ticket mail to admin
						if(jssupportticket::$_config['ticket_close_admin'] == 1){ 
							$adminEmail = jssupportticket::$_config['default_admin_email'];
		                    //Replace Data
		                    $link = "<a href=".admin_url("admin.php?page=ticket_tickets&task=ticket_ticketdetail&jssupportticket_ticketid=".$id).">".__('TICKET_DETAIL','js-support-ticket')."</a>";

		                    $matcharray['{TICKETURL}'] = $link;

		                    $this->replaceMatches($msgSubject,$matcharray);
		                    $this->replaceMatches($msgBody,$matcharray);

                            $this->sendEmail($adminEmail,$msgSubject,$msgBody,$senderEmail,$senderName,'',$action);
						}
						// New ticket mail to User
						if(jssupportticket::$_config['ticket_close_user'] == 1){
		                    //Replace Data
		                    $link = "<a href=".site_url("?page_id=".$pageid."&task=ticket_ticketdetail&jssupportticket_ticketid=".$id).">".__('TICKET_DETAIL','js-support-ticket')."</a>";

		                    $matcharray['{TICKETURL}'] = $link;

		                    $this->replaceMatches($msgSubjectUser,$matcharray);
		                    $this->replaceMatches($msgBodyUser,$matcharray);

	                        $this->sendEmail($Email,$msgSubjectUser,$msgBodyUser,$senderEmail,$senderName,'',$action);
						}
						break;
					case 3: // Delete Ticket
	                    $TrackingId = jssupportticket::$_data['ticketid'];
	                    $Email = $ticketRecord->email;
	                    $Message = $ticketRecord->message;

	                    $matcharray = array(
	                    					'{TRACKINGID}'=>$TrackingId
                    					);

                        $object = $this->getSenderEmailAndName($id);
                        $senderEmail = $object->email;
                        $senderName = $object->name;

						$template = $this->getTemplateForEmail('delete-tk');
						//Parsing template
	                    $msgSubject = $template->subject;
	                    $msgBody = $template->body;
	                    $msgSubjectUser = $template->subject;
	                    $msgBodyUser = $template->body;

						// New ticket mail to admin
						if(jssupportticket::$_config['ticket_delete_admin'] == 1){
							$adminEmail = jssupportticket::$_config['default_admin_email'];
		                    //Replace Data
		                    $this->replaceMatches($msgSubject,$matcharray);
		                    $this->replaceMatches($msgBody,$matcharray);

                            $this->sendEmail($adminEmail,$msgSubject,$msgBody,$senderEmail,$senderName,'',$action);
						}
						// New ticket mail to User
						if(jssupportticket::$_config['ticket_delete_user'] == 1){
		                    //Replace Data
		                    $this->replaceMatches($msgSubjectUser,$matcharray);
		                    $this->replaceMatches($msgBodyUser,$matcharray);

	                        $this->sendEmail($Email,$msgSubjectUser,$msgBodyUser,$senderEmail,$senderName,'',$action);
						}
						break;
					case 4: // Reply Ticket (Admin/Staff Member)
						$ticketRecord = $this->getRecordByTablenameAndId('js_ticket_tickets',$id);
	                    $Username = $ticketRecord->name;
	                    $Subject = $ticketRecord->subject;
	                    $TrackingId = $ticketRecord->ticketid;
	                    $Email = $ticketRecord->email;
	                    $Message = $this->getLatestReplyByTicketId($id);

	                    $matcharray = array(
	                    					'{USERNAME}'=>$Username,
	                    					'{SUBJECT}'=>$Subject,
	                    					'{TRACKINGID}'=>$TrackingId,
	                    					'{EMAIL}'=>$Email,
	                    					'{MESSAGE}'=>$Message
                    					);

                        $object = $this->getSenderEmailAndName($id);
                        $senderEmail = $object->email;
                        $senderName = $object->name;

						$template = $this->getTemplateForEmail('responce-tk');
						//Parsing template
	                    $msgSubject = $template->subject;
	                    $msgBody = $template->body;
	                    $msgSubjectUser = $template->subject;
	                    $msgBodyUser = $template->body;

						// New ticket mail to admin
						if(jssupportticket::$_config['ticket_response_to_staff_admin'] == 1){ 
							$adminEmail = jssupportticket::$_config['default_admin_email'];
		                    //Replace Data
		                    $link = "<a href=".admin_url("admin.php?page=ticket_tickets&task=ticket_ticketdetail&jssupportticket_ticketid=".$id).">".__('TICKET_DETAIL','js-support-ticket')."</a>";

		                    $matcharray['{TICKETURL}'] = $link;

		                    $this->replaceMatches($msgSubject,$matcharray);
		                    $this->replaceMatches($msgBody,$matcharray);
		                    $msgSubject .= '<br/> Admin Mail link'.$link;
                            $this->sendEmail($adminEmail,$msgSubject,$msgBody,$senderEmail,$senderName,'',$action);
						}
						// New ticket mail to User
						if(jssupportticket::$_config['ticket_response_to_staff_user'] == 1){
		                    //Replace Data
		                    $link = "<a href=".site_url("?page_id=".$pageid."&task=ticket_ticketdetail&jssupportticket_ticketid=".$id).">".__('TICKET_DETAIL','js-support-ticket')."</a>";

		                    $matcharray['{TICKETURL}'] = $link;

		                    $this->replaceMatches($msgSubjectUser,$matcharray);
		                    $this->replaceMatches($msgBodyUser,$matcharray);

		                    $msgSubjectUser .= '<br/> User Mail link'.$link;
	                        $this->sendEmail($Email,$msgSubjectUser,$msgBodyUser,$senderEmail,$senderName,'',$action);
						}
						break;					
						case 5: // Reply Ticket (Ticket Member)
						$ticketRecord = $this->getRecordByTablenameAndId('js_ticket_tickets',$id);
	                    $Username = $ticketRecord->name;
	                    $Subject = $ticketRecord->subject;
	                    $TrackingId = $ticketRecord->ticketid;
	                    $Email = $ticketRecord->email;
	                    $Message = $this->getLatestReplyByTicketId($id);

	                    $matcharray = array(
	                    					'{USERNAME}'=>$Username,
	                    					'{SUBJECT}'=>$Subject,
	                    					'{TRACKINGID}'=>$TrackingId,
	                    					'{EMAIL}'=>$Email,
	                    					'{MESSAGE}'=>$Message
                    					);

                        $object = $this->getSenderEmailAndName($id);
                        $senderEmail = $object->email;
                        $senderName = $object->name;

						$template = $this->getTemplateForEmail('reply-tk');
						//Parsing template
	                    $msgSubject = $template->subject;
	                    $msgBody = $template->body;
	                    $msgSubjectUser = $template->subject;
	                    $msgBodyUser = $template->body;

						// New ticket mail to admin
						if(jssupportticket::$_config['ticket_reply_ticket_user_admin'] == 1){ 
							$adminEmail = jssupportticket::$_config['default_admin_email'];
		                    //Replace Data
		                    $link = "<a href=".admin_url("admin.php?page=ticket_tickets&task=ticket_ticketdetail&jssupportticket_ticketid=".$id).">".__('TICKET_DETAIL','js-support-ticket')."</a>";

		                    $matcharray['{TICKETURL}'] = $link;

		                    $this->replaceMatches($msgSubject,$matcharray);
		                    $this->replaceMatches($msgBody,$matcharray);

                            $this->sendEmail($adminEmail,$msgSubject,$msgBody,$senderEmail,$senderName,'',$action);
						}
						// New ticket mail to User
						if(jssupportticket::$_config['ticket_reply_ticket_user_user'] == 1){
		                    //Replace Data
		                    $link = "<a href=".site_url("?page_id=".$pageid."&task=ticket_ticketdetail&jssupportticket_ticketid=".$id).">".__('TICKET_DETAIL','js-support-ticket')."</a>";

		                    $matcharray['{TICKETURL}'] = $link;

		                    $this->replaceMatches($msgSubjectUser,$matcharray);
		                    $this->replaceMatches($msgBodyUser,$matcharray);

	                        $this->sendEmail($Email,$msgSubjectUser,$msgBodyUser,$senderEmail,$senderName,'',$action);
						}
						break;
				}
			break;
		}
	}

	private function getLatestReplyByTicketId($id){
		if(!is_numeric($id)) return false;
		$query = "SELECT reply.message FROM `".jssupportticket::$_db->prefix."js_ticket_replies` AS reply WHERE reply.ticketid = ".$id." ORDER BY reply.created DESC LIMIT 1";
		$message = jssupportticket::$_db->get_var($query);
		if(jssupportticket::$_db->last_error  != null){
			includer::getJSModel('systemerror')->addSystemError();
		}
		return $message;
	}

	private function replaceMatches(&$string,$matcharray){
		foreach($matcharray AS $find => $replace){
			$string = str_replace($find, $replace, $string);
		}
	}

	private function sendEmail($recevierEmail,$subject,$body,$senderEmail,$senderName,$attachments='',$action){
		/*
		$attachments = array( WP_CONTENT_DIR . '/uploads/file_to_attach.zip' );
		$headers = 'From: My Name <myname@example.com>' . "\r\n";
		wp_mail('test@example.org', 'subject', 'message', $headers, $attachments );		

		$action
		For which action of $mailfor you want to send the mail
		1 => New Ticket Create
		2 => Close Ticket
		3 => Delete Ticket
		4 => Reply Ticket (Admin/Staff Member)
		5 => Reply Ticket (Ticket member)

		*/
		switch($action){
			case 1:
				do_action('jsst-beforeemailticketcreate',$recevierEmail,$subject,$body,$senderEmail);
			break;
			case 2:
				do_action('jsst-beforeemailticketreply',$recevierEmail,$subject,$body,$senderEmail);
			break;
			case 3:
				do_action('jsst-beforeemailticketclose',$recevierEmail,$subject,$body,$senderEmail);
			break;
			case 4:
				do_action('jsst-beforeemailticketdelete',$recevierEmail,$subject,$body,$senderEmail);
			break;
		}
		$headers = 'From: '.$senderName.' <'.$senderEmail.'>' . "\r\n";
		add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));
		wp_mail($recevierEmail, $subject, $body, $headers, $attachments );
	}

	private function getSenderEmailAndName($id){
		if(!is_numeric($id)) return false;
		$query = "SELECT email.email,email.name
					FROM `".jssupportticket::$_db->prefix."js_ticket_tickets` AS ticket 
					JOIN `".jssupportticket::$_db->prefix."js_ticket_departments` AS department ON department.id = ticket.departmentid 
					JOIN `".jssupportticket::$_db->prefix."js_ticket_email` AS email ON email.id = department.emailid 
					WHERE ticket.id = ".$id;
		$email = jssupportticket::$_db->get_row($query);
		if(jssupportticket::$_db->last_error  != null){
			includer::getJSModel('systemerror')->addSystemError();
		}
		if(empty($email)){
			$emailid = jssupportticket::$_config['default_alert_email'];
			$query = "SELECT email,name FROM `".jssupportticket::$_db->prefix."js_ticket_email` WHERE id = ".$emailid;
			$email = jssupportticket::$db->get_row($query);
		}
		return $email;
	}

	private function getTemplateForEmail($templatefor){
		$query = "SELECT * FROM `".jssupportticket::$_db->prefix."js_ticket_emailtemplates` WHERE templatefor = '".$templatefor."'" ;
		$template = jssupportticket::$_db->get_row($query);
		if(jssupportticket::$_db->last_error  != null){
			includer::getJSModel('systemerror')->addSystemError();
		}
		return $template;
	}

	private function getRecordByTablenameAndId($tablename,$id){
		if(!is_numeric($id)) return false;
		$query = "SELECT * FROM `".jssupportticket::$_db->prefix.$tablename."` WHERE id = ".$id;
		$record = jssupportticket::$_db->get_row($query);
		if(jssupportticket::$_db->last_error  != null){
			includer::getJSModel('systemerror')->addSystemError();
		}
		return $record;
	}

	function getEmails(){
		// Filter
		$email = request::getVar('email');
		$inquery = '';
		if($email != null)
			$inquery .= " WHERE email.email LIKE '%$email%'";

		// Pagination
		$query = "SELECT COUNT(email.id) 
					FROM `".jssupportticket::$_db->prefix."js_ticket_email` AS email 
					JOIN `".jssupportticket::$_db->prefix."js_ticket_priorities`AS priority ON priority.id = email.priorityid ";
		$query .= $inquery;
		$total = jssupportticket::$_db->get_var($query);
		jssupportticket::$_data[1] = pagination::getPagination($total);		
		
		// Data
		$query = " SELECT email.id, email.email, email.autoresponse, email.created, email.updated,email.status,priority.priority
					FROM `".jssupportticket::$_db->prefix."js_ticket_email` AS email 
					JOIN `".jssupportticket::$_db->prefix."js_ticket_priorities`AS priority ON priority.id=email.priorityid ";
		$query .= $inquery;
		$query .= " ORDER BY email.email DESC LIMIT ".pagination::$_offset.", ".pagination::$_limit;
		jssupportticket::$_data[0] = jssupportticket::$_db->get_results($query);
		jssupportticket::$_data['email'] = $email;
		if(jssupportticket::$_db->last_error  != null){
			includer::getJSModel('systemerror')->addSystemError();
		}
		return;
	}

	function getAllEmailsForCombobox(){
		$query = "SELECT id AS id, email AS text FROM `".jssupportticket::$_db->prefix."js_ticket_email` WHERE status = 1 AND autoresponse = 1";
		$emails = jssupportticket::$_db->get_results($query);
		if(jssupportticket::$_db->last_error  != null){
			includer::getJSModel('systemerror')->addSystemError();
		}
		return $emails;
	}

	function getEmailForForm($id){
		if ($id) {
			$query = "SELECT email.id, email.email, email.autoresponse, email.created, email.updated,email.status,priority.priority,priority.id AS priorityid
						FROM `".jssupportticket::$_db->prefix."js_ticket_email` AS email 
						JOIN `".jssupportticket::$_db->prefix."js_ticket_priorities`AS priority ON priority.id=email.priorityid  
						WHERE email.id = ".$id;
			jssupportticket::$_data[0] = jssupportticket::$_db->get_row($query);
			if(jssupportticket::$_db->last_error  != null){
				includer::getJSModel('systemerror')->addSystemError();// if there is an error add it to system errorrs
			}
		}
		return;
	}
	function storeEmail($data){
		if($data['id']) $data['updated'] = date('Y-m-d H:i:s');
		else $data['created'] = date('Y-m-d H:i:s');
		$query_array = array('id' => $data['id'],
							'email' => $data['email'],
							'autoresponse' => $data['autoresponse'],
							'priorityid' => $data['priority'],
							'status' => $data['status'],
							'created' => $data['created'],
							'updated' => $data['updated']
							);
		jssupportticket::$_db->replace(jssupportticket::$_db->prefix.'js_ticket_email',$query_array);
		if(jssupportticket::$_db->last_error  == null){
			message::setMessage(__('EMAIL_HAS_BEEN_STORED','js-support-ticket'),'updated');
		}else{
			includer::getJSModel('systemerror')->addSystemError();// if there is an error add it to system errorrs
			message::setMessage(__('EMAIL_HAS_NOT_BEEN_STORED','js-support-ticket'),'error');
		}
		return;
	}

	function removeEmail($id){
		if(!is_numeric($id)) return false;
		if($this->canRemoveEmail($id)){
			jssupportticket::$_db->delete( jssupportticket::$_db->prefix.'js_ticket_email', array( 'id' => $id ) );
			if(jssupportticket::$_db->last_error  == null){
				message::setMessage(__('EMAIL_HAS_BEEN_DELETED','js-support-ticket'),'updated');
			}else{
				includer::getJSModel('systemerror')->addSystemError();// if there is an error add it to system errorrs
				message::setMessage(__('EMAIL_HAS_NOT_BEEN_DELETED','js-support-ticket'),'error');
			}
		}else{
			message::setMessage(__('EMAIL_IN_USE_CANNOT_DELETED','js-support-ticket'),'error');
		}
		return;
	}

	private function canRemoveEmail($id){
		if(!is_numeric($id)) return false;
		$query = "SELECT (
					(SELECT COUNT(id) FROM `".jssupportticket::$_db->prefix."js_ticket_departments` WHERE emailid = ".$id.")
					) AS total";
		$result = jssupportticket::$_db->get_var($query);
		if(jssupportticket::$_db->last_error  != null){
			includer::getJSModel('systemerror')->addSystemError();
		}
		if($result == 0) return true;
		else return false;
	}

	function getEmailForDepartment(){
		$query = "SELECT id, email AS text FROM `".jssupportticket::$_db->prefix."js_ticket_email`";
		$emails = jssupportticket::$_db->get_results($query);
		if(jssupportticket::$_db->last_error  != null){
			includer::getJSModel('systemerror')->addSystemError();
		}
		return $emails;
	}

}

?>