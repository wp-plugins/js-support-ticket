<?php

if (!defined('ABSPATH'))
    die('Restricted Access');

class JSSTshortcodes {

    function __construct() {
        add_shortcode('jssupportticket', array($this, 'show_main_ticket'));
        add_shortcode('jssupportticket_addticket', array($this, 'show_form_ticket'));
        add_shortcode('jssupportticket_mytickets', array($this, 'show_my_ticket'));
    }

    function show_main_ticket($raw_args, $content = null) {
        //default set of parameters for the front end shortcodes
        $defaults = array(
            'module' => '',
            'layout' => '',
        );
        $sanitized_args = shortcode_atts($defaults, $raw_args);
        /*
         * Fetch data from the database according to the params values
         */
        jssupportticket::$_data['sanitized_args'] = $sanitized_args;
        jssupportticket::addStyleSheets();
        $pageid = get_the_ID();
        jssupportticket::$_pageid = $pageid;
        jssupportticket::setPageID($pageid);
        JSSTincluder::include_slug('');

        return $content;
    }
    
    function show_form_ticket($raw_args, $content = null) {
        //default set of parameters for the front end shortcodes
        $defaults = array(
            'job_type' => '',
            'city' => '',
            'company' => '',
        );
        $sanitized_args = shortcode_atts($defaults, $raw_args);
        /*
         * Fetch data from the database according to the params values
         */
        JSSTincluder::getJSModel('ticket')->getTicketsForForm(null);
        JSSTincluder::include_file('addticket', 'ticket');

        return $content;
    }

    function show_my_ticket($raw_args, $content = null) {
        //default set of parameters for the front end shortcodes
        $defaults = array(
            'list' => '',
            'ticketid' => '',
        );
        $list = JSSTrequest::getVar('list', 'get', null);
        $ticketid = JSSTrequest::getVar('ticketid', null, null);
        $option = get_option('jssupportticket-pageid', array());
        $id = $option[0];
        jssupportticket::$_pageid = $id;
        $args = shortcode_atts($defaults, $raw_args);
        if ($list == null)
            $list = $args['list'];
        if ($ticketid == null)
            $ticketid = $args['ticketid'];

        /*
         * Fetch data from the database according to the params values
         */
        JSSTincluder::getJSModel('ticket')->getMyTickets($list, $ticketid);
        JSSTincluder::include_file('myticket', 'ticket');

        return $content;
    }

}

$shortcodes = new JSSTshortcodes();
?>
