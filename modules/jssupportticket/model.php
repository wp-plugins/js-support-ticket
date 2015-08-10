<?php

if (!defined('ABSPATH'))
    die('Restricted Access');

class JSSTjssupportticketModel {

    function getControlPanelData() {
        $curdate = date_i18n('Y-m-d');
        $fromdate = date_i18n('Y-m-d', strtotime("now -1 month"));

        $query = "SELECT priority.priority,(SELECT COUNT(id) FROM `" . jssupportticket::$_db->prefix . "js_ticket_tickets` WHERE priorityid = priority.id AND status = 0 AND (lastreply = '0000-00-00 00:00:00' OR lastreply = '') AND date(created) >= '" . $fromdate . "' AND date(created) <= '" . $curdate . "' ) AS totalticket
                    FROM `" . jssupportticket::$_db->prefix . "js_ticket_priorities` AS priority ORDER BY priority.priority";
        $openticket_pr = jssupportticket::$_db->get_results($query);
        $query = "SELECT priority.priority,(SELECT COUNT(id) FROM `" . jssupportticket::$_db->prefix . "js_ticket_tickets` WHERE priorityid = priority.id AND isanswered = 1 AND status != 4 AND status != 0 AND date(created) >= '" . $fromdate . "' AND date(created) <= '" . $curdate . "') AS totalticket
                    FROM `" . jssupportticket::$_db->prefix . "js_ticket_priorities` AS priority ORDER BY priority.priority";
        $answeredticket_pr = jssupportticket::$_db->get_results($query);
        $query = "SELECT priority.priority,(SELECT COUNT(id) FROM `" . jssupportticket::$_db->prefix . "js_ticket_tickets` WHERE priorityid = priority.id AND isanswered != 1 AND status != 4 AND (lastreply != '0000-00-00 00:00:00' AND lastreply != '') AND date(created) >= '" . $fromdate . "' AND date(created) <= '" . $curdate . "') AS totalticket
                    FROM `" . jssupportticket::$_db->prefix . "js_ticket_priorities` AS priority ORDER BY priority.priority";
        $pendingticket_pr = jssupportticket::$_db->get_results($query);
        jssupportticket::$_data['stack_chart_horizontal']['title'] = "['" . __('Tickets', 'js-support-ticket') . "',";
        jssupportticket::$_data['stack_chart_horizontal']['data'] = "['" . __('Pending', 'js-support-ticket') . "',";

        foreach ($pendingticket_pr AS $pr) {
            jssupportticket::$_data['stack_chart_horizontal']['title'] .= "'" . $pr->priority . "',";
            jssupportticket::$_data['stack_chart_horizontal']['data'] .= $pr->totalticket . ",";
        }
        jssupportticket::$_data['stack_chart_horizontal']['title'] .= "]";
        jssupportticket::$_data['stack_chart_horizontal']['data'] .= "],['" . __('Answered', 'js-support-ticket') . "',";

        foreach ($answeredticket_pr AS $pr) {
            jssupportticket::$_data['stack_chart_horizontal']['data'] .= $pr->totalticket . ",";
        }

        jssupportticket::$_data['stack_chart_horizontal']['data'] .= "],['" . __('New', 'js-support-ticket') . "',";

        foreach ($openticket_pr AS $pr) {
            jssupportticket::$_data['stack_chart_horizontal']['data'] .= $pr->totalticket . ",";
        }

        jssupportticket::$_data['stack_chart_horizontal']['data'] .= "]";

        jssupportticket::$_data['ticket_total']['openticket'] = 0;
        jssupportticket::$_data['ticket_total']['overdueticket'] = 0;
        jssupportticket::$_data['ticket_total']['pendingticket'] = 0;
        jssupportticket::$_data['ticket_total']['answeredticket'] = 0;
        $overdueticket_pr = 0;

        $count = count($openticket_pr);
        for ($i = 0; $i < $count; $i++) {
            jssupportticket::$_data['ticket_total']['openticket'] += $openticket_pr[$i]->totalticket;
            jssupportticket::$_data['ticket_total']['overdueticket'] += $overdueticket_pr[$i]->totalticket;
            jssupportticket::$_data['ticket_total']['pendingticket'] += $pendingticket_pr[$i]->totalticket;
            jssupportticket::$_data['ticket_total']['answeredticket'] += $answeredticket_pr[$i]->totalticket;
        }

        $query = "SELECT ticket.id,ticket.ticketid,ticket.subject,ticket.name,ticket.created,priority.priority,priority.prioritycolour,ticket.status
		 			FROM `" . jssupportticket::$_db->prefix . "js_ticket_tickets` AS ticket
		 			JOIN `" . jssupportticket::$_db->prefix . "js_ticket_priorities` AS priority ON priority.id = ticket.priorityid
		 			ORDER BY ticket.status ASC, ticket.created DESC LIMIT 0, 5";
        jssupportticket::$_data['tickets'] = jssupportticket::$_db->get_results($query);
        jssupportticket::$_data['version'] = jssupportticket::$_config['versioncode'];
        return;
    }

    function makeDir($path) {
        if (!file_exists($path)) { // create directory
            mkdir($path, 0755);
            $ourFileName = $path . '/index.html';
            $ourFileHandle = fopen($ourFileName, 'w') or die(__('Cannot open file', 'js-support-ticket'));
            fclose($ourFileHandle);
        }
    }

    function checkExtension($filename) {
        $i = strrpos($filename, ".");
        if (!$i)
            return 6;
        $l = strlen($filename) - $i;
        $ext = substr($filename, $i + 1, $l);
        $extensions = explode(",", jssupportticket::$_config['file_extension']);
        $match = 'N';
        foreach ($extensions as $extension) {
            if (strtolower($extension) == strtolower($ext)) {
                $match = 'Y';
                break;
            }
        }
        return $match;
    }

    function getUserListForRegistration() {
        $query = "SELECT DISTINCT user.ID AS userid, user.user_login AS username, user.user_email AS useremail, user.display_name AS userdisplayname
                    FROM `" . jssupportticket::$_db->prefix . "users` AS user ";
        $users = jssupportticket::$_db->get_results($query);
        return $users;
    }

    function getusersearchajax() {
        $username = JSSTrequest::getVar('username');
        $name = JSSTrequest::getVar('name');
        $emailaddress = JSSTrequest::getVar('emailaddress');
        $canloadresult = false;

        $query = "SELECT DISTINCT user.ID AS userid, user.user_login AS username, user.user_email AS useremail, user.display_name AS userdisplayname
                    FROM `" . jssupportticket::$_db->prefix . "users` AS user
                    WHERE 1 = 1 ";
        if (strlen($name) > 0) {
            $query .= " AND user.display_name LIKE '%$name%'";
            $canloadresult = true;
        }
        if (strlen($emailaddress) > 0) {
            $query .= " AND user.user_email LIKE '%$emailaddress%'";
            $canloadresult = true;
        }
        if (strlen($username) > 0) {
            $query .= " AND user.user_login LIKE '%$username%'";
            $canloadresult = true;
        }
        if ($canloadresult) {
            $users = jssupportticket::$_db->get_results($query);
            if (!empty($users)) {
                $result = '
                    <div class="js-col-md-2 js-title">' . __('User id', 'js-support-ticket') . '</div>
                    <div class="js-col-md-3 js-title">' . __('Username', 'js-support-ticket') . '</div>
                    <div class="js-col-md-4 js-title">' . __('Email address', 'js-support-ticket') . '</div>
                    <div class="js-col-md-3 js-title">' . __('Name', 'js-support-ticket') . '</div>
                    <div id="records-inner">';
                foreach ($users AS $user) {
                    $result .='
                        <div class="user-records-wrapper js-value" style="display:inline-block;width:100%;">
                            <div class="js-col-xs-12 js-col-md-2">
                                <span class="js-user-title-xs">' . __('User id', 'js-support-ticket') . ' : </span>' . $user->userid . '
                            </div>                            
                            <div class="js-col-xs-12 js-col-md-3">
                                <span class="js-user-title-xs">' . __('Username', 'js-support-ticket') . ' : </span>';
                    $result .='<a href="#" class="js-userpopup-link" data-id="' . $user->userid . '" data-email="' . $user->useremail . '" data-name="' . $user->userdisplayname . '">' . $user->username . '</a> </div>';
                    $result .=
                            '<div class="js-col-xs-12 js-col-md-4">
                                <span class="js-user-title-xs">' . __('Email address', 'js-support-ticket') . ' : </span>' . $user->useremail . '
                            </div>
                            <div class="js-col-xs-12 js-col-md-3">
                                <span class="js-user-title-xs">' . __('Display name', 'js-support-ticket') . ' : </span>' . $user->userdisplayname . '
                            </div>
                        </div></div>';
                }
            } else {
                $result = JSSTlayout::getNoRecordFound();
            }
        } else { // reset button
            $result = '<div class="js-staff-searc-desc">' . __('Use Search Feature To Select The User', 'js-support-ticket') . '</div>';
        }

        return $result;
    }

}

?>
