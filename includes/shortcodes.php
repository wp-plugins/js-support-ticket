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

class shortcodes{
	
	function __construct(){
		add_shortcode('jssupportticket_formticket', array($this,'show_form_ticket'));
		add_shortcode('jssupportticket_myticket', array($this,'show_my_ticket'));
	}

	function show_form_ticket($raw_args,$content = null){
		//default set of parameters for the front end shortcodes
		$defaults = array(
			'job_type' => '',
			'city' => '',
			'company' => '',
		);
		$sanitized_args = shortcode_atts( $defaults, $raw_args );
		/*
		 * Fetch data from the database according to the params values
		 */
		includer::getJSModel('ticket')->getTicketsForForm(null);
		includer::include_file('addticket','ticket');

		return $content;
	}
	
	function show_my_ticket($raw_args,$content = null){
		//default set of parameters for the front end shortcodes
		$defaults = array(
			'list' => '',
			'ticketid' => '',
		);
		$list = request::getVar('list','get',null);
		$ticketid = request::getVar('ticketid',null,null);
		jssupportticket::$_pageid = jssupportticket::$_db->get_var("Select id FROM `".jssupportticket::$_db->prefix."posts` WHERE post_name = 'js-support-ticket-controlpanel'");
		$args = shortcode_atts( $defaults, $raw_args );
		if($list == null) $list = $args['list'];
		if($ticketid == null) $ticketid = $args['ticketid'];

		/*
		 * Fetch data from the database according to the params values
		 */
		includer::getJSModel('ticket')->getMyTickets($list,$ticketid);
		includer::include_file('myticket','ticket');

		return $content;
	}
	
}

$shortcodes = new shortcodes();
?>
