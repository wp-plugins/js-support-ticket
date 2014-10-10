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

class activation{

	static function jssupportticket_activate(){
		// Install Database
		activation::runSQL();
		activation::insertMenu();
	}

	static private function insertMenu(){
		$pageexist = jssupportticket::$_db->get_var("Select COUNT(id) FROM `".jssupportticket::$_db->prefix."posts` WHERE post_name = 'js-support-ticket-controlpanel'");
		if($pageexist == 0){
			$post = array(
						  'post_name'      => 'js-support-ticket-controlpanel',
						  'post_title'     => 'JS Support Ticket',
						  'post_status'    => 'publish',
						  'post_type'      => 'page'
						);  
			wp_insert_post( $post, $wp_error );
		}else{
			jssupportticket::$_db->get_var("UPDATE `".jssupportticket::$_db->prefix."posts` SET post_status = 'publish' WHERE post_name = 'js-support-ticket-controlpanel'");
		}
	}

	static private function runSQL(){
		// Run Sql to install the database;
		$query = "CREATE TABLE IF NOT EXISTS `".jssupportticket::$_db->prefix."js_ticket_activity_log` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `uid` int(11) DEFAULT NULL,
				  `referenceid` int(11) DEFAULT NULL,
				  `level` int(2) DEFAULT NULL,
				  `eventfor` int(2) DEFAULT NULL,
				  `event` varchar(255) DEFAULT NULL,
				  `eventtype` varchar(255) DEFAULT NULL,
				  `message` text,
				  `messagetype` varchar(255) DEFAULT NULL,
				  `datetime` timestamp NULL DEFAULT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='utf8_general_ci' AUTO_INCREMENT=1 ;";
		jssupportticket::$_db->query($query);

		$query = "CREATE TABLE IF NOT EXISTS `".jssupportticket::$_db->prefix."js_ticket_attachments` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `ticketid` int(11) DEFAULT NULL,
				  `replyattachmentid` int(11) DEFAULT NULL,
				  `filesize` varchar(32) DEFAULT NULL,
				  `filename` varchar(128) DEFAULT NULL,
				  `filekey` varchar(128) DEFAULT NULL,
				  `deleted` tinyint(1) DEFAULT NULL,
				  `status` tinyint(1) DEFAULT NULL,
				  `created` datetime DEFAULT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=163 ;";
		jssupportticket::$_db->query($query);

		$query = "CREATE TABLE IF NOT EXISTS `".jssupportticket::$_db->prefix."js_ticket_email` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `autoresponse` tinyint(1) DEFAULT NULL,
				  `priorityid` int(11) DEFAULT NULL,
				  `email` varchar(125) DEFAULT NULL,
				  `name` varchar(32) DEFAULT NULL,
				  `uid` int(11) DEFAULT NULL,
				  `password` varchar(125) DEFAULT NULL COMMENT '	',
				  `status` tinyint(1) DEFAULT NULL,
				  `mailhost` varchar(125) DEFAULT NULL,
				  `mailprotocol` enum('pop','map') DEFAULT NULL,
				  `mailencryption` enum('NONE','SSL') DEFAULT NULL,
				  `mailport` smallint(6) DEFAULT NULL,
				  `mailfetchfrequency` tinyint(3) DEFAULT NULL,
				  `mailfetchmaximum` tinyint(4) DEFAULT NULL,
				  `maildeleted` tinyint(1) DEFAULT NULL,
				  `mailerrors` tinyint(3) DEFAULT NULL,
				  `maillasterror` datetime DEFAULT NULL,
				  `maillastfetch` datetime DEFAULT NULL,
				  `smtpactive` tinyint(1) DEFAULT NULL,
				  `smtphost` varchar(125) DEFAULT NULL,
				  `smtpport` smallint(6) DEFAULT NULL,
				  `smtpsecure` tinyint(1) DEFAULT NULL,
				  `smtpauthencation` tinyint(1) DEFAULT NULL,
				  `created` datetime DEFAULT NULL,
				  `updated` datetime DEFAULT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
		jssupportticket::$_db->query($query);		

		$query = "CREATE TABLE IF NOT EXISTS `".jssupportticket::$_db->prefix."js_ticket_config` (
				  `configname` varchar(100) NOT NULL DEFAULT '',
				  `configvalue` varchar(255) NOT NULL DEFAULT '',
				  `configfor` varchar(50) DEFAULT NULL,
				  PRIMARY KEY (`configname`),
				  FULLTEXT KEY `config_name` (`configname`),
				  FULLTEXT KEY `config_for` (`configfor`)
				) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
		jssupportticket::$_db->query($query);

		$runConfig = jssupportticket::$_db->get_var("SELECT COUNT(configname) FROM `".jssupportticket::$_db->prefix."js_ticket_config`");
		if($runConfig == 0){
			$systememail = get_option('admin_email');
			$query = "INSERT INTO `".jssupportticket::$_db->prefix."js_ticket_email` (`autoresponse`, `priorityid`, `email`, `name`, `uid`, `password`, `status`, `mailhost`, `mailprotocol`, `mailencryption`, `mailport`, `mailfetchfrequency`, `mailfetchmaximum`, `maildeleted`, `mailerrors`, `maillasterror`, `maillastfetch`, `smtpactive`, `smtphost`, `smtpport`, `smtpsecure`, `smtpauthencation`, `created`, `updated`) VALUES
						(1, 31, 'admin@admin.com', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2014-10-02 10:38:48', '0000-00-00 00:00:00');";
			jssupportticket::$_db->query($query);
			$emailid = jssupportticket::$_db->insert_id;
			$query = "INSERT INTO `".jssupportticket::$_db->prefix."js_ticket_config` (`configname`, `configvalue`, `configfor`) VALUES
						('title', 'JS Support Ticket', 'default'),
						('offline', '2', 'default'),
						('offline_message', 'JS Support Ticket is now offline, please come back soon.', 'default'),
						('data_directory', 'jssupportticketdata', 'default'),
						('date_format', 'd-m-Y', 'default'),
						('ticket_overdue', '10', 'default'),
						('ticket_auto_close', '7', 'default'),
						('no_of_attachement', '2', 'default'),
						('file_maximum_size', '1024', 'default'),
						('file_extension', 'png,jpg,jpeg,gif,doc,docx,pdf,odt', 'default'),
						('show_current_location', '2', 'default'),
						('maximum_open_ticket_per_email', '20', 'default'),
						('reopen_ticket_within_days', '5', 'default'),
						('staff_can_lock_ticket', '2', 'default'),
						('visitor_can_create_ticket', '2', 'default'),
						('show_captcha_on_visitor_from_ticket', '2', 'default'),
						('staff_identity', '2', 'default'),
						('view_tickets', '1', 'default'),
						('default_alert_email', '".$emailid."', 'default'),
						('default_system_email', '".$emailid."', 'default'),
						('default_admin_email', '".$emailid."', 'default'),
						('articles_per_row', '10', 'default'),
						('knowledge_base_enable', '2', 'default'),
						('staff_create_categories', '2', 'default'),
						('staff_create_articles', '2', 'default'),
						('new_ticket_mail_to_admin', '1', 'default'),
						('new_ticket_mail_to_staff_members', '1', 'default'),
						('banemail_mail_to_admin', '1', 'default'),
						('ticket_reassign_admin', '1', 'default'),
						('ticket_reassign_staff', '1', 'default'),
						('ticket_reassign_user', '1', 'default'),
						('ticket_close_admin', '1', 'default'),
						('ticket_close_staff', '1', 'default'),
						('ticket_close_user', '2', 'default'),
						('ticket_delete_admin', '1', 'default'),
						('ticket_delete_staff', '1', 'default'),
						('ticket_delete_user', '1', 'default'),
						('ticket_mark_overdue_admin', '1', 'default'),
						('ticket_mark_overdue_staff', '1', 'default'),
						('ticket_mark_overdue_user', '1', 'default'),
						('ticket_ban_email_admin', '1', 'default'),
						('ticket_ban_email_staff', '1', 'default'),
						('ticket_ban_email_user', '1', 'default'),
						('ticket_department_transfer_admin', '1', 'default'),
						('ticket_department_transfer_staff', '1', 'default'),
						('ticket_department_transfer_user', '1', 'default'),
						('ticket_reply_ticket_user_admin', '1', 'default'),
						('ticket_reply_ticket_user_staff', '1', 'default'),
						('ticket_reply_ticket_user_user', '1', 'default'),
						('ticket_response_to_staff_admin', '1', 'default'),
						('ticket_response_to_staff_staff', '1', 'default'),
						('ticket_response_to_staff_user', '1', 'default'),
						('ticker_ban_eamil_and_close_ticktet_admin', '1', 'default'),
						('ticker_ban_eamil_and_close_ticktet_staff', '1', 'default'),
						('ticker_ban_eamil_and_close_ticktet_user', '1', 'default'),
						('unban_email_admin', '1', 'default'),
						('unban_email_staff', '1', 'default'),
						('unban_email_user', '1', 'default');";
			jssupportticket::$_db->query($query);						
		}
		$query = "CREATE TABLE IF NOT EXISTS `".jssupportticket::$_db->prefix."js_ticket_departments` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `emailtemplateid` int(11) DEFAULT NULL,
				  `emailid` int(11) DEFAULT NULL,
				  `autoresponceemailid` int(11) DEFAULT NULL,
				  `managerid` int(11) DEFAULT NULL,
				  `departmentname` varchar(32) DEFAULT NULL,
				  `departmentsignature` text,
				  `ispublic` tinyint(1) DEFAULT NULL,
				  `ticketautoresponce` tinyint(1) DEFAULT NULL,
				  `messageautoresponce` tinyint(1) DEFAULT NULL,
				  `canappendsignature` tinyint(1) DEFAULT NULL,
				  `updated` datetime DEFAULT NULL,
				  `created` datetime DEFAULT NULL,
				  `status` tinyint(1) DEFAULT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
		jssupportticket::$_db->query($query);
		if($runConfig == 0){
			$query = "INSERT INTO `".jssupportticket::$_db->prefix."js_ticket_departments` (`emailid`,`departmentname`, `departmentsignature`, `ispublic`,`updated`, `created`, `status`) VALUES ('".$emailid."', 'Support', '', 1, '0000-00-00 00:00:00', '2014-10-02 10:39:53', 1);";
			jssupportticket::$_db->query($query);
		}


		$query = "CREATE TABLE IF NOT EXISTS `".jssupportticket::$_db->prefix."js_ticket_emailtemplates` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `templatefor` varchar(50) DEFAULT NULL,
				  `title` varchar(50) DEFAULT NULL,
				  `subject` varchar(255) DEFAULT NULL,
				  `body` text,
				  `created` datetime DEFAULT NULL,
				  `status` tinyint(1) DEFAULT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;";
		jssupportticket::$_db->query($query);
		if($runConfig == 0){
			$query = "INSERT INTO `".jssupportticket::$_db->prefix."js_ticket_emailtemplates` (`id`, `templatefor`, `title`, `subject`, `body`, `created`, `status`) VALUES
						(1, 'ticket-new', '', 'JS Support Tickets: New Ticket Received ', 'Dear {USERNAME},\r\n\r\nYour support ticket <strong>{SUBJECT}</strong> has been submitted. We try to reply to all tickets as soon as possible, usually within 24 hours.\r\n\r\nYour tracking ID: {TRACKINGID}\r\n\r\nYour Email ID: {EMAIL}\r\n\r\nTicket message: {MESSAGE}\r\n\r\nYou can view the status of your ticket here:\r\n{TICKETURL}\r\n\r\nYou will receive an e-mail notification when our staff replies to your ticket.\r\n\r\n<span style=\"color: red;\"><strong>*DO NOT REPLY TO THIS E-MAIL*</strong></span>\r\nThis is an automated e-mail message sent from our support system. Do not reply to this e-mail as we will not receive your reply!', NULL, 0),
						(6, 'reassign-tk', '', 'JS Support Tickets: Reassign Ticket  ', 'Sucess: Ticket Reassign<br/> <br/> Your ticket has been successfully Reassign! Ticket ID:{TRACKINGID} is Reassign to Staff Member:{STAFF_MEMBER_TITLE}<br/> <br/> You can manage this ticket here<br/> <br/> {TICKETURL}<br/> <br/> <span style=\"color: red;\"><strong>*DO NOT REPLY TO THIS E-MAIL*</strong></span>\r\nThis is an automated e-mail message sent from our support system. Do not reply to this e-mail as we wonot receive your reply!', NULL, 0),
						(7, 'close-tk', '', 'JS Support Tickets:  Close Ticket ', 'Ticket Close\r\n\r\nTicket ID:{TRACKINGID} has been  Closed.\r\n\r\nYou can manage this ticket here\r\n\r\n{TICKETURL}\r\n\r\n<span style=\"color: red;\"><strong>*DO NOT REPLY TO THIS E-MAIL*</strong></span>\r\nThis is an automated e-mail message sent from our support system. Do not reply to this e-mail as we will not receive your reply!', NULL, 0),
						(8, 'delete-tk', '', 'JS Support Tickets:  Delete Ticket', 'Ticket Deleted\r\n\r\nTicket ID:{TRACKINGID} has been deleted.\r\n\r\n<span style=\"color: red;\"><strong>*DO NOT REPLY TO THIS E-MAIL*</strong></span>\r\nThis is an automated e-mail message sent from our support system. Do not reply to this e-mail as we will not receive your reply!', NULL, 0),
						(9, 'moverdue-tk', '', 'JS Support Tickets:  Markoverdue Ticket ', 'Ticket Markoverdue<br/> <br/> Ticket ID:{TRACKINGID} is Markoverdue.<br/> <br/> You can manage this ticket here<br/> <br/> {TICKETURL}<br/> <br/> <span style=\"color: red;\"><strong>*DO NOT REPLY TO THIS E-MAIL*</strong></span>\r\nThis is an automated e-mail message sent from our support system. Do not reply to this e-mail as we wonot receive your reply!', NULL, 0),
						(10, 'banemail-tk', '', 'JS Support Tickets:  Email Baned ', 'Email Baned<br/> <br/> This email {EMAIL_ADDRESS} is Baned.<br/> <br/> <span style=\"color: red;\"><strong>*DO NOT REPLY TO THIS E-MAIL*</strong></span>\r\nThis is an automated e-mail message sent from our support system. Do not reply to this e-mail as we wonot receive your reply!', NULL, 0),
						(11, 'deptrans-tk', '', 'JS Support Tickets:  Ticket Transfer to Department{DEPARTMENT_TITLE} ', 'Ticket transfer to department<br/> <br/> Ticket ID: {TRACKINGID} is transfer to department{DEPARTMENT_TITLE}.<br/> <br/> <span style=\"color: red;\"><strong>*DO NOT REPLY TO THIS E-MAIL*</strong></span>\r\nThis is an automated e-mail message sent from our support system. Do not reply to this e-mail as we wonot receive your reply!', NULL, 0),
						(12, 'banemailcloseticket-tk', '', 'JS Support Tickets: Email Baned and ticket close ', 'Email Baned and ticket close<br/> <br/> This email {EMAIL_ADDRESS} is Baned and ticket ID:{TICKETID} is closed.<br/> <br/> <span style=\"color: red;\"><strong>*DO NOT REPLY TO THIS E-MAIL*</strong></span>\r\nThis is an automated e-mail message sent from our support system. Do not reply to this e-mail as we wonot receive your reply!', NULL, 0),
						(13, 'unbanemail-tk', '', 'JS Support Tickets:  Email Unbaned ', 'Email Unbaned<br/> <br/> This email {EMAIL_ADDRESS} is Unbaned<br/> <br/> <span style=\"color: red;\"><strong>*DO NOT REPLY TO THIS E-MAIL*</strong></span>\r\nThis is an automated e-mail message sent from our support system. Do not reply to this e-mail as we wonot receive your reply!', NULL, 0),
						(14, 'reply-tk', '', 'JS Support Tickets:  Ticket Reply  ', 'Hello,\r\n\r\nA new reply to   <strong>{SUBJECT} </strong>has been submitted.\r\n\r\nUser Name: {USERNAME}\r\n\r\nTracking ID: {TRACKINGID}\r\n\r\nEmail: {EMAIL}\r\n\r\nMessage: {MESSAGE}\r\n\r\nYou can manage this ticket here:\r\n\r\n{TICKETURL}\r\n\r\n\r\n\r\n<span style=\"color: red;\"><strong>*DO NOT REPLY TO THIS E-MAIL*</strong></span>\r\nThis is an automated e-mail message sent from our support system. Do not reply to this e-mail as we will not receive your reply!', NULL, 0),
						(15, 'responce-tk', '', 'JS Support Tickets:  Ticket Responce ', 'Hello,\r\n\r\n\r\nStaff just reply to your ticket <strong>{SUBJECT}</strong>.\r\n\r\n\r\nUser Name: {USERNAME}\r\n\r\n\r\nTracking ID: {TRACKINGID}\r\n\r\n\r\nEmail: {EMAIL}\r\n\r\n\r\nMessage: {MESSAGE}\r\n\r\n\r\nYou can manage this ticket here:\r\n\r\n\r\n{TICKETURL}\r\n\r\n\r\n\r\n<span style=\"color: red;\"><strong>*DO NOT REPLY TO THIS E-MAIL*</strong></span>\r\nThis is an automated e-mail message sent from our support system. Do not reply to this e-mail as we will not receive your reply!', NULL, 0),
						(16, 'ticket-staff', '', 'JS Support Tickets: New Ticket', 'New ticket <strong>{SUBJECT}</strong> has been submitted with the following details.\r\n\r\nTracking ID: {TRACKINGID}\r\n\r\nEmail ID: {EMAIL}\r\n\r\nTicket message: {MESSAGE}\r\n\r\nHelp Topic: {HELP_TOPIC}\r\n\r\nYou can view the status of your ticket here:\r\n{TICKETURL}\r\n\r\nYou will receive an e-mail notification when our staff replies to your ticket.\r\n\r\n<span style=\"color: red;\"><strong>*DO NOT REPLY TO THIS E-MAIL*</strong></span>\r\nThis is an automated e-mail message sent from our support system. Do not reply to this e-mail as we will not receive your reply!', NULL, 0),
						(17, 'banemail-trtk', '', 'JS Support Tickets: Banemail try new ticket ', 'Hello Admin ,<br/> <br/> This email {EMAIL_ADDRESS} is baned and try open new ticket .<br/> <br/> <span style=\"color: red;\"><strong>*DO NOT REPLY TO THIS E-MAIL*</strong></span>\r\nThis is an automated e-mail message sent from our support system. Do not reply to this e-mail as we wonot receive your reply!', NULL, 0),
						(18, 'ticket-new-admin', '', 'JS Support Tickets: New Ticket Received ', 'Hello,\r\n\r\nA new support ticket <strong>{SUBJECT}</strong> has been submitted. Ticket details.\r\n\r\nTracking ID: {TRACKINGID}\r\n\r\nEmail ID: {EMAIL}\r\n\r\nTicket message: {MESSAGE}\r\n\r\nYou can manage this ticket here:\r\n\r\n{TICKETURL}\r\n\r\n\r\n\r\n<span style=\"color: #ff0000;\"><strong>*DO NOT REPLY TO THIS E-MAIL*</strong></span>\r\nThis is an automated e-mail message sent from our support system. Do not reply to this e-mail as we will not receive your reply!', NULL, 0),
						(2, 'department-new', '', 'JS Support Tickets :  New Department {DEPARTMENT_TITLE} has been added', 'Hello Admin ,\r\n\r\nNew department has been added.\r\n\r\n<span style=\"color: red;\"><strong>*DO NOT REPLY TO THIS E-MAIL*</strong></span>\r\nThis is an automated e-mail message sent from our support system. Do not reply to this e-mail as we wonot receive your reply!', NULL, 0),
						(3, 'group-new', '', 'JS Support Tickets :  New Group {GROUP_TITLE} has beed received ', 'Hello Admin ,<br/> <br/> We receive new group.<br/> <br/> <span style=\"color: red;\"><strong>*DO NOT REPLY TO THIS E-MAIL*</strong></span>\r\nThis is an automated e-mail message sent from our support system. Do not reply to this e-mail as we wonot receive your reply!', NULL, 0),
						(4, 'staff-new', '', 'JS Support Tickets :  New Staff Member {STAFF_MEMBER_TITLE} has beed received ', 'Hello Admin ,<br/> <br/> We receive new staff member.<br/> <br/> <span style=\"color: red;\"><strong>*DO NOT REPLY TO THIS E-MAIL*</strong></span>\r\nThis is an automated e-mail message sent from our support system. Do not reply to this e-mail as we wonot receive your reply!', NULL, 0),
						(5, 'helptopic-new', '', 'JS Support Tickets :  New Help Topic {HELPTOPIC_TITLE} has beed received ', 'Hello Admin ,<br/> <br/> We receive new help topic {HELPTOPIC_TITLE} of department {DEPARTMENT_TITLE}.<br/> <br/> <span style=\"color: red;\"><strong>*DO NOT REPLY TO THIS E-MAIL*</strong></span>\r\nThis is an automated e-mail message sent from our support system. Do not reply to this e-mail as we wonot receive your reply!', NULL, 0);";
			jssupportticket::$_db->query($query);
		}

		$query = "CREATE TABLE IF NOT EXISTS `".jssupportticket::$_db->prefix."js_ticket_priorities` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `priority` varchar(60) DEFAULT NULL,
				  `prioritycolour` varchar(7) DEFAULT NULL,
				  `priorityurgency` int(1) DEFAULT NULL,
				  `ispublic` varchar(45) DEFAULT NULL,
				  `isdefault` tinyint(1) DEFAULT NULL,
				  `status` tinyint(4) NOT NULL DEFAULT '0',
				  PRIMARY KEY (`id`)
				) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;";
		jssupportticket::$_db->query($query);
		if($runConfig == 0){
			$query = "INSERT INTO `".jssupportticket::$_db->prefix."js_ticket_priorities` (`id`, `priority`, `prioritycolour`, `priorityurgency`, `ispublic`, `isdefault`, `status`) VALUES
						(33, 'Urgent', '#EE0000', 0, '2', 2, 1),
						(32, 'High', '#FA3700', 0, '1', 2, 1),
						(30, 'Low', '#00FF00', 0, '1', 1, 1),
						(31, 'Medium', '#FDC700', 0, '1', 2, 1);";
			jssupportticket::$_db->query($query);
		}
		$query = "CREATE TABLE IF NOT EXISTS `".jssupportticket::$_db->prefix."js_ticket_replies` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `uid` int(11) NOT NULL,
				  `ticketid` int(11) DEFAULT NULL,
				  `name` varchar(50) DEFAULT NULL,
				  `message` text,
				  `staffid` int(11) DEFAULT NULL,
				  `rating` enum('1','5') DEFAULT NULL,
				  `status` tinyint(1) DEFAULT NULL,
				  `created` datetime DEFAULT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
		jssupportticket::$_db->query($query);

		$query = "CREATE TABLE IF NOT EXISTS `".jssupportticket::$_db->prefix."js_ticket_system_errors` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `uid` int(11) DEFAULT NULL,
				  `error` text,
				  `isview` tinyint(1) DEFAULT '0',
				  `created` datetime DEFAULT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
		jssupportticket::$_db->query($query);

		$query = "CREATE TABLE IF NOT EXISTS `".jssupportticket::$_db->prefix."js_ticket_tickets` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `uid` int(11) DEFAULT NULL,
				  `ticketid` varchar(11) DEFAULT NULL,
				  `departmentid` int(11) DEFAULT NULL,
				  `priorityid` int(11) DEFAULT NULL,
				  `staffid` int(11) DEFAULT NULL,
				  `email` varchar(255) DEFAULT NULL,
				  `name` varchar(100) DEFAULT NULL,
				  `subject` varchar(255) DEFAULT NULL,
				  `message` text,
				  `helptopicid` int(11) DEFAULT NULL,
				  `phone` varchar(16) DEFAULT NULL,
				  `phoneext` varchar(8) DEFAULT NULL,
				  `status` tinyint(1) DEFAULT NULL,
				  `isoverdue` tinyint(1) DEFAULT NULL,
				  `isanswered` tinyint(1) NOT NULL DEFAULT '0',
				  `duedate` datetime DEFAULT NULL,
				  `reopened` datetime DEFAULT NULL,
				  `closed` datetime DEFAULT NULL,
				  `lastreply` datetime DEFAULT NULL,
				  `created` datetime DEFAULT NULL,
				  `updated` datetime DEFAULT NULL,
				  `lock` tinyint(4) NOT NULL DEFAULT '0',
				  PRIMARY KEY (`id`)
				) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
		jssupportticket::$_db->query($query);

		$query = "CREATE TABLE IF NOT EXISTS `".jssupportticket::$_db->prefix."js_ticket_userfields` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `name` varchar(50) NOT NULL DEFAULT '',
				  `title` varchar(255) NOT NULL,
				  `description` mediumtext,
				  `type` varchar(50) NOT NULL DEFAULT '',
				  `maxlength` int(11) DEFAULT NULL,
				  `size` int(11) DEFAULT NULL,
				  `required` tinyint(4) DEFAULT '0',
				  `ordering` int(11) DEFAULT NULL,
				  `cols` int(11) DEFAULT NULL,
				  `rows` int(11) DEFAULT NULL,
				  `value` varchar(50) DEFAULT NULL,
				  `default` int(11) DEFAULT NULL,
				  `published` tinyint(1) NOT NULL DEFAULT '1',
				  `fieldfor` tinyint(2) NOT NULL DEFAULT '0',
				  `readonly` tinyint(1) NOT NULL DEFAULT '0',
				  `calculated` tinyint(1) NOT NULL DEFAULT '0',
				  `sys` tinyint(4) NOT NULL DEFAULT '0',
				  `params` mediumtext,
				  PRIMARY KEY (`id`)
				) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
		jssupportticket::$_db->query($query);

		$query = "CREATE TABLE IF NOT EXISTS `".jssupportticket::$_db->prefix."js_ticket_userfieldvalues` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `field` int(11) NOT NULL DEFAULT '0',
				  `fieldtitle` varchar(255) NOT NULL DEFAULT '',
				  `fieldvalue` varchar(255) NOT NULL,
				  `ordering` int(11) NOT NULL DEFAULT '0',
				  `sys` tinyint(4) NOT NULL DEFAULT '0',
				  PRIMARY KEY (`id`)
				) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
		jssupportticket::$_db->query($query);

		$query = "CREATE TABLE IF NOT EXISTS `".jssupportticket::$_db->prefix."js_ticket_userfield_data` (
				  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
				  `referenceid` int(11) NOT NULL,
				  `field` int(10) unsigned DEFAULT NULL,
				  `data` varchar(1000) DEFAULT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
		jssupportticket::$_db->query($query);

	}
}

?>
