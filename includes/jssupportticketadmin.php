<?php

if (!defined('ABSPATH'))
    die('Restricted Access');

class jssupportticketadmin {

    function __construct() {
        add_action('admin_menu', array($this, 'mainmenu'));
    }

    function mainmenu() {
        add_menu_page(__('JS Support Ticket Control Panel', 'js-support-ticket'), // Page title
                __('JS Support Ticket', 'js-support-ticket'), // menu title
                'manage_options', // capability
                'jssupportticket', //menu slug
                array($this, 'showAdminPage'), // function name
			  plugins_url('js-support-ticket/includes/images/admin_ticket.png')
        );
        add_submenu_page('jssupportticket', // parent slug
                __('JS Support Ticket Tickets', 'js-support-ticket'), // Page title
                __('Tickets', 'js-support-ticket'), // menu title
                'manage_options', // capability
                'ticket', //menu slug
                array($this, 'showAdminPage') // function name
        );
        add_submenu_page('jssupportticket', // parent slug
                __('JS Support Ticket Configuration', 'js-support-ticket'), // Page title
                __('Configurations', 'js-support-ticket'), // menu title
                'manage_options', // capability
                'configuration', //menu slug
                array($this, 'showAdminPage') // function name
        );
        add_submenu_page('jssupportticket', // parent slug
                __('JS Support Ticket Department', 'js-support-ticket'), // Page title
                __('Departments', 'js-support-ticket'), // menu title
                'manage_options', // capability
                'department', //menu slug
                array($this, 'showAdminPage') // function name
        );
        add_submenu_page('jssupportticket', // parent slug
                __('JS Support Ticket Priorities', 'js-support-ticket'), // Page title
                __('Priority', 'js-support-ticket'), // menu title
                'manage_options', // capability
                'priority', //menu slug
                array($this, 'showAdminPage') // function name
        );
        add_submenu_page('jssupportticket', // parent slug
                __('JS Support Ticket Emails', 'js-support-ticket'), // Page title
                __('System Emails', 'js-support-ticket'), // menu title
                'manage_options', // capability
                'email', //menu slug
                array($this, 'showAdminPage') // function name
        );
        add_submenu_page('jssupportticket', // parent slug
                __('JS Support Ticket Email Templates', 'js-support-ticket'), // Page title
                __('Email Templates', 'js-support-ticket'), // menu title
                'manage_options', // capability
                'emailtemplate', //menu slug
                array($this, 'showAdminPage') // function name
        );
        add_submenu_page('jssupportticket', // parent slug
                __('JS Support Ticket User Fields', 'js-support-ticket'), // Page title
                __('User Fields', 'js-support-ticket'), // menu title
                'manage_options', // capability
                'userfeild', //menu slug
                array($this, 'showAdminPage') // function name
        );
        add_submenu_page('jssupportticket', // parent slug
                __('JS Support Ticket System Errors', 'js-support-ticket'), // Page title
                __('System Errors', 'js-support-ticket'), // menu title
                'manage_options', // capability
                'systemerror', //menu slug
                array($this, 'showAdminPage') // function name
        );
        add_submenu_page('jssupportticket', // parent slug
                __('JS Support Ticket Upgrade', 'js-support-ticket'), // Page title
                __('Upgrade', 'js-support-ticket'), // menu title
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
