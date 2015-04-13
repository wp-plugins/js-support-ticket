<?php

if (!defined('ABSPATH'))
    die('Restricted Access');

class JSSTticketController {

    function __construct() {
        self::handleRequest();
    }

    function handleRequest() {
        if (is_admin()) {
            $defaultlayout = "tickets";
        } else
            $defaultlayout = "myticket";
        $layout = JSSTrequest::getLayout('layout', null, $defaultlayout);
        if (self::canaddfile()) {
            switch ($layout) {
                case 'admin_tickets':
                    $list = null;
                    if (isset($_GET['list']))
                        $list = $_GET['list'];
                    JSSTincluder::getJSModel('ticket')->getTicketsForAdmin($list);
                    break;
                case 'admin_addticket':
                case 'addticket':
                    $id = JSSTrequest::getVar('jssupportticketid');
                        JSSTincluder::getJSModel('ticket')->getTicketsForForm($id);
                    break;
                case 'admin_ticketdetail':
                case 'ticketdetail':
                    $id = JSSTrequest::getVar('jssupportticketid');
                        JSSTincluder::getJSModel('ticket')->getTicketForDetail($id);
                    break;
                case 'myticket':
                    JSSTincluder::getJSModel('ticket')->getMyTickets();
                    break;
            }
            $module = (is_admin()) ? 'page' : 'module';
            $module = JSSTrequest::getVar($module, null, 'ticket');
            JSSTincluder::include_file($layout, $module);
        }
    }

    function canaddfile() {
        if (isset($_POST['form_request']) && $_POST['form_request'] == 'jssupportticket')
            return false;
        elseif (isset($_GET['action']) && $_GET['action'] == 'jstask')
            return false;
        else
            return true;
    }

    function closeticket() {
        $id = JSSTrequest::getVar('ticketid');
        JSSTincluder::getJSModel('ticket')->closeTicket($id);
        if (is_admin()) {
            $url = admin_url("admin.php?page=ticket&layout=tickets");
        } else {
            $url = site_url("?page_id=" . jssupportticket::getPageid() . "&module=ticket&layout=myticket&list=2");
        }
        wp_redirect($url);
        exit;
    }


    static function saveticket() {
        $data = JSSTrequest::get('post');
        $result = JSSTincluder::getJSModel('ticket')->storeTickets($data);
        if (is_admin()) {
            $url = admin_url("admin.php?page=ticket&layout=tickets");
        } else {
                if($result == false){ // error on captcha or ticket validation
                    $addticket = 'addticket';
                    $url = site_url("?page_id=" . jssupportticket::getPageid() . "&module=ticket&layout=$addticket");
                }else{
                    $myticket = 'myticket';
                    $url = site_url("?page_id=" . jssupportticket::getPageid() . "&module=ticket&layout=$myticket");
                }
        }
        wp_redirect($url);
        exit;
    }


    static function deleteticket() {
        $id = JSSTrequest::getVar('ticketid');
        JSSTincluder::getJSModel('ticket')->removeTicket($id);
        if (is_admin()) {
            $url = admin_url("admin.php?page=ticket&layout=tickets");
        } else {
            $url = site_url("?page_id=" . jssupportticket::getPageid() . "&module=ticket&layout=myticket");
        }
        wp_redirect($url);
        exit;
    }

    static function changepriority() {
        $id = JSSTrequest::getVar('ticketid');
        $priorityid = JSSTrequest::getVar('priority');
        JSSTincluder::getJSModel('ticket')->changeTicketPriority($id, $priorityid);
        if (is_admin()) {
            $url = admin_url("admin.php?page=ticket&layout=ticketdetail&jssupportticketid=" . $id);
        } else {
            $url = site_url("?page_id=" . jssupportticket::getPageid() . "&module=ticket&layout=ticketdetail&jssupportticketid=" . $id);
        }
        wp_redirect($url);
        exit;
    }

    static function reopenticket() { // for user
        $ticketid = JSSTrequest::getVar('ticketid');
        $data['ticketid'] = $ticketid;
        JSSTincluder::getJSModel('ticket')->reopenTicket($data);
        $url = "&layout=ticketdetail&jssupportticketid=" . $data['ticketid'];
        if (is_admin()) {
            $url = admin_url("admin.php?page=ticket" . $url);
        } else {
            $url = site_url("?page_id=" . jssupportticket::getPageid() . "&module=ticket" . $url);
        }
        wp_redirect($url);
        exit;
    }

    static function actionticket() {
        $data = JSSTrequest::get('post');
        /* to handle actions */
        switch ($data['actionid']) {
            case 1: /* Change Priority Ticket */
                JSSTincluder::getJSModel('ticket')->changeTicketPriority($data['ticketid'], $data['priority']);
                $url = "&layout=ticketdetail&jssupportticketid=" . $data['ticketid'];
                break;
            case 2: /* close ticket */
                JSSTincluder::getJSModel('ticket')->closeTicket($data['ticketid']);
                $url = "&layout=ticketdetail&jssupportticketid=" . $data['ticketid'];
                break;
            case 3: /* Reopen Ticket */
                JSSTincluder::getJSModel('ticket')->reopenTicket($data);
                $url = "&layout=ticketdetail&jssupportticketid=" . $data['ticketid'];
                break;
        }

        if (is_admin()) {
            $url = admin_url("admin.php?page=ticket" . $url);
        } else {
            $url = site_url("?page_id=" . jssupportticket::getPageid() . "&module=ticket" . $url);
        }
        wp_redirect($url);
        exit;
    }


}

$ticketController = new JSSTticketController();
?>
