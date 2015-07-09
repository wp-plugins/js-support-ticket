<?php

if (!defined('ABSPATH'))
    die('Restricted Access');

class JSSTuserfeildController {

    function __construct() {
        self::handleRequest();
    }

    function handleRequest() {
        $layout = JSSTrequest::getLayout('layout', null, 'userfeilds');
        if (self::canaddfile()) {
            switch ($layout) {
                case 'admin_userfeilds':
                    JSSTincluder::getJSModel('userfeild')->getUserFeilds(1);
                    break;

                case 'admin_adduserfeild':
                    $id = JSSTrequest::getVar('jssupportticketid');
                    JSSTincluder::getJSModel('userfeild')->getUserFeildbyId($id);
                    break;
            }
            $module = (is_admin()) ? 'page' : 'module';
            $module = JSSTrequest::getVar($module, null, 'userfeild');
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

    static function saveuserfeild() {
        $data = JSSTrequest::get('post');
        JSSTincluder::getJSModel('userfeild')->storeUserFeild($data);
        if (is_admin()) {
            $url = admin_url("admin.php?page=userfeild&layout=userfeilds");
        } else {
            $url = site_url("?page_id=" . jssupportticket::getPageid() . "&module=userfield&layout=userfeilds");
        }
        wp_redirect($url);
        exit;
    }

    static function deleteuserfeild() {
        $id = JSSTrequest::getVar('userfeildid');
        JSSTincluder::getJSModel('userfeild')->removeUserFeild($id);
        if (is_admin()) {
            $url = admin_url("admin.php?page=userfeild&layout=userfeilds");
        } else {
            $url = site_url("?page_id=" . jssupportticket::getPageid() . "&module=userfield&layout=userfeilds");
        }
        wp_redirect($url);
        exit;
    }

}

$userfeildController = new JSSTuserfeildController();
?>
