<?php
if(!defined('ABSPATH')) die('Restricted Access');

class deactivation{

	static function jssupportticket_deactivate(){
		wp_clear_scheduled_hook('jssupporticket_updateticketstatus');
		$option = get_option('jssupportticket-pageid',array());
		$id = $option[0];
		jssupportticket::$_db->get_var("UPDATE `".jssupportticket::$_db->prefix."posts` SET post_status = 'draft' WHERE ID = $id");
		delete_option('jssupportticket-pageid');
	}

}

?>