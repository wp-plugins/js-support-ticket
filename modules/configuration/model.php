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

class configurationModel{

	function getConfigurations(){
		$query = "SELECT configname,configvalue
					FROM `".jssupportticket::$_db->prefix."js_ticket_config`";
		$data = jssupportticket::$_db->get_results($query);
		if(jssupportticket::$_db->last_error  != null){
			includer::getJSModel('systemerror')->addSystemError();
		}
		foreach($data AS $config){
			jssupportticket::$_data[0][$config->configname] = $config->configvalue;
		}
		jssupportticket::$_data[1] = includer::getJSModel('email')->getAllEmailsForCombobox();
		return;
	}

	function storeConfiguration($data){
		foreach($data AS $key => $value){
			jssupportticket::$_db->update(jssupportticket::$_db->prefix.'js_ticket_config',array('configvalue'=>$value),array('configname'=>$key));
			if(jssupportticket::$_db->last_error  != null){
				includer::getJSModel('systemerror')->addSystemError();
			}
		}
		return;
	}

	function getConfiguration(){
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		// check for plugin using plugin name
		if ( is_plugin_active( 'js-support-ticket/js-support-ticket.php' ) ) {
			//plugin is activated
			$query = "SELECT config.* FROM `".jssupportticket::$_db->prefix."js_ticket_config` AS config";
			$config = jssupportticket::$_db->get_results($query);
			foreach($config as $conf) {
				jssupportticket::$_config[$conf->configname] = $conf->configvalue;
			}
		} 
	}

}


?>
