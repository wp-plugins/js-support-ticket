<?php
if(!defined('ABSPATH')) die('Restricted Access');
class jssupportticketadmin{
	
	function __construct(){
		add_action('admin_menu',array($this,'mainmenu'));
	}	
	function mainmenu() {
		add_menu_page(__('JS_SUPPORT_TICKET_CONTROL_PANEL','js-support-ticket'), // Page title
						  __('JS_SUPPORT_TICKET','js-support-ticket') ,// menu title
						  'manage_options',// capability
						  'jssupportticket_controlpanel',//menu slug
						  array($this,'showAdminPage'), // function name,
						  plugins_url('js-support-ticket/includes/images/admin_ticket.png')
						  );
		add_submenu_page('jssupportticket_controlpanel', // parent slug
						 __('JS_SUPPORT_TICKET_TICKETS','js-support-ticket'), // Page title
						  __('TICKETS','js-support-ticket') ,// menu title
						  'manage_options',// capability
						  'ticket_tickets',//menu slug
						  array($this,'showAdminPage') // function name
						  );
		add_submenu_page('jssupportticket_controlpanel', // parent slug
						 __('JS_SUPPORT_TICKET_CONFIGURATION','js-support-ticket'), // Page title
						  __('CONFIGURATIONS','js-support-ticket') ,// menu title
						  'manage_options',// capability
						  'configuration_configurations',//menu slug
						  array($this,'showAdminPage') // function name
						  );
	    add_submenu_page('jssupportticket_controlpanel', // parent slug
						 __('JS_SUPPORT_TICKET_DEPARTMENT','js-support-ticket'), // Page title
						  __('DEPARTMENTS','js-support-ticket') ,// menu title
						  'manage_options',// capability
						  'department_departments',//menu slug
						  array($this,'showAdminPage') // function name
						  );
		add_submenu_page('jssupportticket_controlpanel', // parent slug
						 __('JS_SUPPORT_TICKET_PRIORITIES','js-support-ticket'), // Page title
						  __('PRIORITY','js-support-ticket') ,// menu title
						  'manage_options',// capability
						  'priority_priorities',//menu slug
						  array($this,'showAdminPage') // function name
						  );
		add_submenu_page('jssupportticket_controlpanel', // parent slug
						 __('JS_SUPPORT_TICKET_EMAILS','js-support-ticket'), // Page title
						  __('SYSTEM_EMAILS','js-support-ticket') ,// menu title
						  'manage_options',// capability
						  'email_emails',//menu slug
						  array($this,'showAdminPage') // function name
						  );
		add_submenu_page('jssupportticket_controlpanel', // parent slug
						 __('JS_SUPPORT_TICKET_EMAIL_TEMPLATES','js-support-ticket'), // Page title
						  __('EMAIL_TEMPLATES','js-support-ticket') ,// menu title
						  'manage_options',// capability
						  'emailtemplate_emailtemplates',//menu slug
						  array($this,'showAdminPage') // function name
						  );
		add_submenu_page('jssupportticket_controlpanel', // parent slug
						 __('JS_SUPPORT_TICKET_USER_FIELDS','js-support-ticket'), // Page title
						  __('USER_FIELDS','js-support-ticket') ,// menu title
						  'manage_options',// capability
						  'userfeild_userfeilds',//menu slug
						  array($this,'showAdminPage') // function name
						  );
		add_submenu_page('jssupportticket_controlpanel', // parent slug
						 __('JS_SUPPORT_TICKET_SYSTEM_ERROR','js-support-ticket'), // Page title
						  __('SYSTEM_ERRORS','js-support-ticket') ,// menu title
						  'manage_options',// capability
						  'systemerror_systemerrors',//menu slug
						  array($this,'showAdminPage') // function name
						  );
	}
	

	function showAdminPage(){
		jssupportticket::addStyleSheets();
		$page = request::getVar('page');
		$array = explode('_',$page);
		includer::include_file($array[0]);
	}
}

$jssupportticketAdmin = new jssupportticketadmin();
?>
