<?php

if (!defined('ABSPATH'))
    die('Restricted Access');

class JSSTconfigurationModel {

    function getConfigurations() {
        $query = "SELECT configname,configvalue
					FROM `" . jssupportticket::$_db->prefix . "js_ticket_config`";
        $data = jssupportticket::$_db->get_results($query);
        if (jssupportticket::$_db->last_error != null) {
            JSSTincluder::getJSModel('systemerror')->addSystemError();
        }
        foreach ($data AS $config) {
            jssupportticket::$_data[0][$config->configname] = $config->configvalue;
        }
        jssupportticket::$_data[1] = JSSTincluder::getJSModel('email')->getAllEmailsForCombobox();
        return;
    }

    function storeConfiguration($data) {
        $notsave = false;
        foreach ($data AS $key => $value) {
            $query = true;
            if ($key == 'pagination_default_page_size') {
                if ($value < 3) {
                    JSSTmessage::setMessage(__('Pagination default page size not saved', 'js-support-ticket'), 'updated');
                    continue;
                }
            }
            jssupportticket::$_db->update(jssupportticket::$_db->prefix . 'js_ticket_config', array('configvalue' => $value), array('configname' => $key));
            if (jssupportticket::$_db->last_error != null) {
                JSSTincluder::getJSModel('systemerror')->addSystemError();
                $notsave = true;
            }
        }
        if ($notsave == false) {
            JSSTmessage::setMessage(__('Configuration has been stored', 'js-support-ticket'), 'updated');
        } else {
            JSSTmessage::setMessage(__('Configuration not has been stored', 'js-support-ticket'), 'error');
        }
        return;
    }

    function getConfiguration() {
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        // check for plugin using plugin name
        if (is_plugin_active('js-support-ticket/js-support-ticket.php')) {
            //plugin is activated
            $query = "SELECT config.* FROM `" . jssupportticket::$_db->prefix . "js_ticket_config` AS config";
            $config = jssupportticket::$_db->get_results($query);
            foreach ($config as $conf) {
                jssupportticket::$_config[$conf->configname] = $conf->configvalue;
            }
            jssupportticket::$_config['config_count'] = COUNT($config);
        }
    }

}

?>
