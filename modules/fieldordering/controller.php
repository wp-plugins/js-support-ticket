<?php

if (!defined('ABSPATH'))
    die('Restricted Access');

class JSSTfieldorderingController {

    function __construct() {
        self::handleRequest();
    }

    function handleRequest() {
        $layout = JSSTrequest::getLayout('layout', null, 'fieldordering');
        if (self::canaddfile()) {
            switch ($layout) {
                case 'admin_fieldordering':
                    JSSTincluder::getJSModel('fieldordering')->getFieldOrderingForList();
                    break;
            }
            $module = (is_admin()) ? 'page' : 'module';
            $module = JSSTrequest::getVar($module, null, 'fieldordering');
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

    static function changeorder() {
        $id = JSSTrequest::getVar('fieldorderingid');
        $action = JSSTrequest::getVar('order');
        JSSTincluder::getJSModel('fieldordering')->changeOrder($id, $action);
        $url = admin_url("admin.php?page=fieldordering&layout=fieldordering");
        wp_redirect($url);
        exit;
    }

    static function changepublishstatus() {
        $id = JSSTrequest::getVar('fieldorderingid');
        $status = JSSTrequest::getVar('status');
        JSSTincluder::getJSModel('fieldordering')->changePublishStatus($id, $status);
        $url = admin_url("admin.php?page=fieldordering&layout=fieldordering");
        wp_redirect($url);
        exit;
    }

    static function changerequiredstatus() {
        $id = JSSTrequest::getVar('fieldorderingid');
        $status = JSSTrequest::getVar('status');
        JSSTincluder::getJSModel('fieldordering')->changeRequiredStatus($id, $status);
        $url = admin_url("admin.php?page=fieldordering&layout=fieldordering");
        wp_redirect($url);
        exit;
    }

}

$announcementController = new JSSTfieldorderingController();
?>
