<?php

if (!defined('ABSPATH'))
    die('Restricted Access');

class jssupportticketadmin {

    function __construct() {
        add_action('admin_menu', array($this, 'mainmenu'));
    }

    function mainmenu() {
        add_menu_page(__('JS_SUPPORT_TICKET_CONTROL_PANEL', 'js-support-ticket'), // Page title
                __('JS_SUPPORT_TICKET', 'js-support-ticket'), // menu title
                'manage_options', // capability
                'jssupportticket', //menu slug
                array($this, 'showAdminPage'), // function name,
                plugins_url('js-support-ticket/includes/images/admin_ticket.png')
        );
        add_submenu_page('jssupportticket', // parent slug
                __('JS_SUPPORT_TICKET_TICKETS', 'js-support-ticket'), // Page title
                __('TICKETS', 'js-support-ticket'), // menu title
                'manage_options', // capability
                'ticket', //menu slug
                array($this, 'showAdminPage') // function name
        );
        add_submenu_page('jssupportticket', // parent slug
                __('JS_SUPPORT_TICKET_CONFIGURATION', 'js-support-ticket'), // Page title
                __('CONFIGURATIONS', 'js-support-ticket'), // menu title
                'manage_options', // capability
                'configuration', //menu slug
                array($this, 'showAdminPage') // function name
        );
        add_submenu_page('jssupportticket', // parent slug
                __('JS_SUPPORT_TICKET_DEPARTMENT', 'js-support-ticket'), // Page title
                __('DEPARTMENTS', 'js-support-ticket'), // menu title
                'manage_options', // capability
                'department', //menu slug
                array($this, 'showAdminPage') // function name
        );
        add_submenu_page('jssupportticket', // parent slug
                __('JS_SUPPORT_TICKET_PRIORITIES', 'js-support-ticket'), // Page title
                __('PRIORITY', 'js-support-ticket'), // menu title
                'manage_options', // capability
                'priority', //menu slug
                array($this, 'showAdminPage') // function name
        );
        add_submenu_page('jssupportticket', // parent slug
                __('JS_SUPPORT_TICKET_EMAILS', 'js-support-ticket'), // Page title
                __('SYSTEM_EMAILS', 'js-support-ticket'), // menu title
                'manage_options', // capability
                'email', //menu slug
                array($this, 'showAdminPage') // function name
        );
        add_submenu_page('jssupportticket', // parent slug
                __('JS_SUPPORT_TICKET_EMAIL_TEMPLATES', 'js-support-ticket'), // Page title
                __('EMAIL_TEMPLATES', 'js-support-ticket'), // menu title
                'manage_options', // capability
                'emailtemplate', //menu slug
                array($this, 'showAdminPage') // function name
        );
        add_submenu_page('jssupportticket', // parent slug
                __('JS_SUPPORT_TICKET_USER_FIELDS', 'js-support-ticket'), // Page title
                __('USER_FIELDS', 'js-support-ticket'), // menu title
                'manage_options', // capability
                'userfeild', //menu slug
                array($this, 'showAdminPage') // function name
        );
        add_submenu_page('jssupportticket', // parent slug
                __('JS_SUPPORT_TICKET_SYSTEM_ERROR', 'js-support-ticket'), // Page title
                __('SYSTEM_ERRORS', 'js-support-ticket'), // menu title
                'manage_options', // capability
                'systemerror', //menu slug
                array($this, 'showAdminPage') // function name
        );
        add_submenu_page('jssupportticket', // parent slug
                __('JS_SUPPORT_TICKET_UPGRADE', 'js-support-ticket'), // Page title
                __('UPGRADE', 'js-support-ticket'), // menu title
                'manage_options', // capability
                'proinstaller', //menu slug
                array($this, 'showAdminPage') // function name
        );
    }

    function showAdminPage() {
        jssupportticket::addStyleSheets();
        $page = JSSTrequest::getVar('page');
        JSSTincluder::include_file($page);
    }

}

$jssupportticketAdmin = new jssupportticketadmin();
?>
