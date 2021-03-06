<?php


if (!defined('ABSPATH'))
    die('Restricted Access');

class JSSTreplyModel {

    function getReplies($id) {
        if (!is_numeric($id))
            return false;
        // Data
        $query = "SELECT replies.*,replies.id AS replyid,tickets.id
					FROM `" . jssupportticket::$_db->prefix . "js_ticket_replies` AS replies 
					JOIN `" . jssupportticket::$_db->prefix . "js_ticket_tickets` AS tickets ON  replies.ticketid = tickets.id 
					WHERE tickets.id = " . $id;
        jssupportticket::$_data[4] = jssupportticket::$_db->get_results($query);
        if (jssupportticket::$_db->last_error != null) {
            JSSTincluder::getJSModel('systemerror')->addSystemError();
        }
        $attachmentmodel = JSSTincluder::getJSModel('attachment');
        foreach (jssupportticket::$_data[4] AS $reply) {
            $reply->attachments = $attachmentmodel->getAttachmentForReply($reply->id, $reply->replyid);
        }
        return;
    }

    function getTicketNameForReplies() {
        $query = "SELECT id, ticketid AS text FROM `" . jssupportticket::$_db->prefix . "js_ticket_tickets`";
        $list = jssupportticket::$_db->get_results($query);
        if (jssupportticket::$_db->last_error != null) {
            JSSTincluder::getJSModel('systemerror')->addSystemError();
        }
        return $list;
    }

    function getRepliesForForm($id) {
        if ($id) {
            if (!is_numeric($id))
                return false;
            $query = "SELECT replies.*,tickets.id 
						FROM `" . jssupportticket::$_db->prefix . "js_ticket_replies` AS replies 
						JOIN `" . jssupportticket::$_db->prefix . "js_ticket_tickets` AS tickets ON  replies.ticketid = tickets.id 
						WHERE replies.id = " . $id;
            jssupportticket::$_data[0] = jssupportticket::$_db->get_row($query);
            if (jssupportticket::$_db->last_error != null) {
                JSSTincluder::getJSModel('systemerror')->addSystemError(); // if there is an error add it to system errorrs
            }
        }
        return;
    }

    function storeReplies($data) {

        $sendEmail = true;
        if (is_user_logged_in()) {
            $current_user = get_userdata(get_current_user_id());
            $currentUserName = $current_user->display_name;
        } else {
            $currentUserName = '';
        }
        //check signature
        if (!isset($data['nonesignature'])) {
            if (isset($data['departmentsignature']) && $data['departmentsignature'] == 1) {
                $data['message'] .= '<br/>' . JSSTincluder::getJSModel('department')->getSignatureByID($data['departmentid']);
            }
        }
        $data['id'] = isset($data['id']) ? $data['id'] : '';
        $data['status'] = isset($data['status']) ? $data['status'] : '';
        $data['closeonreply'] = isset($data['closeonreply']) ? $data['closeonreply'] : '';
        $query_array = array('id' => $data['id'],
            'uid' => $data['uid'],
            'ticketid' => $data['ticketid'],
            'name' => $currentUserName,
            'message' => wpautop(wptexturize(stripslashes($data['message']))),
            'status' => $data['status'],
            'created' => date('Y-m-d H:i:s')
        );
        jssupportticket::$_db->replace(jssupportticket::$_db->prefix . 'js_ticket_replies', $query_array);
        $replyid = jssupportticket::$_db->insert_id;
        if (jssupportticket::$_db->last_error == null) {
            //tickets attachments store
            $data['replyattachmentid'] = jssupportticket::$_db->insert_id;
            JSSTincluder::getJSModel('attachment')->storeAttachments($data);
            //reply stored change action		
            if (is_admin())
                JSSTincluder::getJSModel('ticket')->setStatus(3, $data['ticketid']); // 3 -> waiting for customer reply
            else {
                    JSSTincluder::getJSModel('ticket')->setStatus(1, $data['ticketid']); // 1 -> waiting for admin/staff reply
            }
            JSSTincluder::getJSModel('ticket')->updateLastReply($data['ticketid']);
            JSSTmessage::setMessage(__('Reply has been stored', 'js-support-ticket'), 'updated');
            $messagetype = __('Successfully', 'js-support-ticket');
        }else {
            JSSTincluder::getJSModel('systemerror')->addSystemError(); // if there is an error add it to system errorrs
            JSSTmessage::setMessage(__('Reply has not been stored', 'js-support-ticket'), 'error');
            $messagetype = __('Error', 'js-support-ticket');
            $sendEmail = false;
        }

        $ticketid = $data['ticketid']; // get the ticket id

        // Send Emails
        if ($sendEmail == true) {
            if (is_admin()) {
                JSSTincluder::getJSModel('email')->sendMail(1, 4, $ticketid); // Mailfor, Reply Ticket
            } else {
                JSSTincluder::getJSModel('email')->sendMail(1, 5, $ticketid); // Mailfor, Reply Ticket
            }
            $ticketreplyobject = jssupportticket::$_db->get_row("SELECT * FROM `" . jssupportticket::$_db->prefix . "js_ticket_replies` WHERE id = " . $replyid);
            do_action('jsst-ticketreply', $ticketreplyobject);
        }
        // if Close on reply is cheked
        if ($data['closeonreply'] == 1) {
            JSSTincluder::getJSModel('ticket')->closeTicket($ticketid);
        }

        return;
    }

    function removeReplies($id) {
        if (!is_numeric($id))
            return false;
        jssupportticket::$_db->delete(jssupportticket::$_db->prefix . 'js_ticket_replies', array('id' => $id));
        if (jssupportticket::$_db->last_error == null) {
            JSSTmessage::setMessage(__('Reply has been deleted', 'js-support-ticket'), 'updated');
        } else {
            JSSTincluder::getJSModel('systemerror')->addSystemError(); // if there is an error add it to system errorrs
            JSSTmessage::setMessage(__('Reply has not been deleted', 'js-support-ticket'), 'error');
        }
        return;
    }

    function getLastReply($ticketid) {
        if (!is_numeric($ticketid))
            return false;
        $query = "SELECT created FROM `" . jssupportticket::$_db->prefix . "js_ticket_replies` WHERE ticketid =  " . $ticketid . " ORDER BY created desc";
        $lastreply = jssupportticket::$_db->get_var($query);
        if (jssupportticket::$_db->last_error != null) {
            JSSTincluder::getJSModel('systemerror')->addSystemError(); // if there is an error add it to system errorrs
        }
        return $lastreply;
    }

}

?>
