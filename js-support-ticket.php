<?php

/**
 * @package JS Support Ticket
 * @author Ahmad Bilal
 * @version 1.0.4
 */
/*
  Plugin Name: JS Support Ticket
  Plugin URI: http://www.joomsky.com
  Description: JS Support Ticket is a trusted open source ticket system. JS Support ticket is a simple, easy to use, web-based customer support system. User can create ticket from front-end. JS support ticket comes packed with lot features than most of the expensive(and complex) support ticket system on market. JS Support ticket provide you best industry help desk system.
  Author: Ahmed Bilal
  Version: 1.0.4
  Author URI: http://www.joomsky.com
 */

if (!defined('ABSPATH'))
    die('Restricted Access');

class jssupportticket {

    public static $_path;
    public static $_pluginpath;
    public static $_data; /* data[0] for list , data[1] for total paginition ,data[2] userfieldsforview , data[3] userfield for form , data[4] for reply , data[5] for ticket history  , data[6] for internal notes  , data[7] for ban email  , data['ticket_attachment'] for attachment */
    public static $_pageid;
    public static $_db;
    public static $_config;
    public static $_sorton;
    public static $_sortorder;
    public static $_ordering;
    public static $_sortlinks;
    public static $_currentversion;

    function __construct() {
        self::includes();
        self::registeractions();
        self::$_path = plugin_dir_path(__FILE__);
        self::$_pluginpath = plugins_url('/', __FILE__);
        self::$_data = '';
		self::$_currentversion = '103';
        global $wpdb;
        self::$_db = $wpdb;
        JSSTincluder::getJSModel('configuration')->getConfiguration();
        register_activation_hook(__FILE__, array($this, 'jssupportticket_activate'));
        register_deactivation_hook(__FILE__, array($this, 'jssupportticket_deactivate'));
        add_action('plugins_loaded', array($this, 'load_plugin_textdomain'));
        add_action('jssupporticket_updateticketstatus', array($this, 'updateticketstatus'));
    }

    function jssupportticket_activate() {
        include_once 'includes/activation.php';
        JSSTactivation::jssupportticket_activate();
        wp_schedule_event(time(), 'daily', 'jssupporticket_updateticketstatus');
    }

    function updateticketstatus() {
        $query = "UPDATE `" . jssupportticket::$_db->prefix . "js_ticket_tickets` SET status = 4 WHERE date(DATE_ADD(lastreply,INTERVAL " . jssupportticket::$_config['ticket_auto_close'] . " DAY)) < CURDATE() AND isanswered = 1";
        jssupportticket::$_db->query($query);
        if (jssupportticket::$_db->last_error != null) {
            JSSTincluder::getJSModel('systemerror')->addSystemError();
        }
    }

    function jssupportticket_deactivate() {
        include_once 'includes/deactivation.php';
        JSSTdeactivation::jssupportticket_deactivate();
    }

    function registeractions() {
        //Ticket Action Hooks
        add_action('jsst-ticketcreate', array($this, 'ticketcreate'), 10, 1);
        add_action('jsst-ticketreply', array($this, 'ticketreply'), 10, 1);
        add_action('jsst-ticketclose', array($this, 'ticketclose'), 10, 1);
        add_action('jsst-ticketdelete', array($this, 'ticketdelete'), 10, 1);
        add_action('jsst-ticketbeforelisting', array($this, 'ticketbeforelisting'), 10, 1);
        add_action('jsst-ticketbeforeview', array($this, 'ticketbeforeview'), 10, 1);
        //Email Hooks
        add_action('jsst-beforeemailticketcreate', array($this, 'beforeemailticketcreate'), 10, 4);
        add_action('jsst-beforeemailticketreply', array($this, 'beforeemailticketreply'), 10, 4);
        add_action('jsst-beforeemailticketclose', array($this, 'beforeemailticketclose'), 10, 4);
        add_action('jsst-beforeemailticketdelete', array($this, 'beforeemailticketdelete'), 10, 4);
    }

    //Funtions for Ticket Hooks
    function ticketcreate($ticketobject) {
        return $ticketobject;
    }

    function ticketreply($ticketobject) {
        return $ticketobject;
    }

    function ticketclose($ticketobject) {
        return $ticketobject;
    }

    function ticketdelete($ticketobject) {
        return $ticketobject;
    }

    function ticketbeforelisting($ticketobject) {
        return $ticketobject;
    }

    function ticketbeforeview($ticketobject) {
        return $ticketobject;
    }

    //Funtion for Email Hooks
    function beforeemailticketcreate($recevierEmail, $subject, $body, $senderEmail) {
        return;
    }

    function beforeemailticketdelete($recevierEmail, $subject, $body, $senderEmail) {
        return;
    }

    function beforeemailticketreply($recevierEmail, $subject, $body, $senderEmail) {
        return;
    }

    function beforeemailticketclose($recevierEmail, $subject, $body, $senderEmail) {
        return;
    }

    /*
     * Include the required files
     */

    function includes() {
        if (is_admin()) {
            include_once 'includes/jssupportticketadmin.php';
        }
        include_once 'includes/pagination.php';
        include_once 'includes/breadcrumbs.php';
        include_once 'includes/includer.php';
        include_once 'includes/formfield.php';
        include_once 'includes/request.php';
        include_once 'includes/formhandler.php';
        include_once 'includes/shortcodes.php';
        include_once 'includes/paramregister.php';
        include_once 'includes/message.php';
        include_once 'includes/layout.php';
        include_once 'includes/ajax.php';
    }

    /**
     * Localization
     */
    public function load_plugin_textdomain() {
        load_plugin_textdomain('js-support-ticket', false, dirname(plugin_basename(__FILE__)) . '/languages/');
    }

    public static function getPageid() {
        $id = 0;
        $option = get_option('jssupportticket-pageid', array());
        if (!empty($option))
            $id = $option[0];
        return $id;
    }
    public static function setPageID($id) {
        $option = array();
        $option[] = $id;
        update_option('jssupportticket-pageid',$option);
    }

    /*
     * function for the Style Sheets
     */

    Static function addStyleSheets() {
        if (is_admin()) {
            wp_register_style('jsticket-admincss', jssupportticket::$_pluginpath . 'includes/css/admincss.css');
            wp_enqueue_style('jsticket-admincss');
        } else {
            wp_register_style('jsticket-style', jssupportticket::$_pluginpath . 'includes/css/style.css');
            wp_enqueue_style('jsticket-style');
        }
        wp_register_style('jsticket-bootstarp', jssupportticket::$_pluginpath . 'includes/css/bootstrap.min.css');
        wp_enqueue_style('jsticket-bootstarp');
    }
    /*
     * function to parse the spaces in given string
     */

    public static function parseSpaces($string) {
        return str_replace('%20',' ',$string);
    }
}
    add_action('init', 'custom_init_session', 1);
    function custom_init_session() {
        if (!session_id())
            session_start();
    }

$jssupportticket = new jssupportticket();
?>
