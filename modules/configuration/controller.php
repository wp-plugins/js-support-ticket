<?php

if (!defined('ABSPATH'))
    die('Restricted Access');

class JSSTconfigurationController {

    function __construct() {
        self::handleRequest();
    }

    function handleRequest() {
        $layout = JSSTrequest::getLayout('layout', null, 'configurations');
        if (self::canaddfile()) {
            switch ($layout) {
                case 'admin_configurations':
                    JSSTincluder::getJSModel('configuration')->getConfigurations();
                    break;
            }
            $module = (is_admin()) ? 'page' : 'module';
            $module = JSSTrequest::getVar($module, null, 'configuration');
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

    static function saveconfiguration() {
        $data = JSSTrequest::get('post');
        JSSTincluder::getJSModel('configuration')->storeConfiguration($data);
        if (is_admin()) {
            $url = admin_url("admin.php?page=configuration&layout=configurations");
        }
        wp_redirect($url);
        exit;
    }

}

$configurationController = new JSSTconfigurationController();
?>
