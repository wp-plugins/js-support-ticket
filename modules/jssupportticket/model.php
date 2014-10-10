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

class jssupportticketModel{
	
	function getControlPanelData(){
		//Pie Chart Data
		$query = "SELECT COUNT(id) FROM `".jssupportticket::$_db->prefix."js_ticket_tickets` WHERE status = 0 AND date(created) = CURDATE()";
		jssupportticket::$_data['pie_openticket'] = jssupportticket::$_db->get_var($query);

		$query = "SELECT COUNT(id) FROM `".jssupportticket::$_db->prefix."js_ticket_tickets` WHERE status = 4 AND date(created) = CURDATE()";
		jssupportticket::$_data['pie_closeticket'] = jssupportticket::$_db->get_var($query);

		$query = "SELECT COUNT(id) FROM `".jssupportticket::$_db->prefix."js_ticket_tickets` WHERE isanswered = 1 AND status != 4 AND status != 0 AND date(created) = CURDATE()";
		jssupportticket::$_data['pie_answeredticket'] = jssupportticket::$_db->get_var($query);

		$query = "SELECT COUNT(id) FROM `".jssupportticket::$_db->prefix."js_ticket_tickets` WHERE date(created) = CURDATE()";
		jssupportticket::$_data['pie_allticket'] = jssupportticket::$_db->get_var($query);

		//Line Chart Data
		$curdate = date('Y-m-d');
		$dates = '';
		$fromdate = date('Y-m-d', strtotime("now -7 days") );
		$nextdate = $fromdate;
		//Query to get Data
		$query = "SELECT created FROM `".jssupportticket::$_db->prefix."js_ticket_tickets` WHERE status = 0 AND date(created) >= '".$fromdate."' AND date(created) <= '".$curdate."'";
		$openticket = jssupportticket::$_db->get_results($query);

		$query = "SELECT created FROM `".jssupportticket::$_db->prefix."js_ticket_tickets` WHERE status = 4 AND date(created) >= '".$fromdate."' AND date(created) <= '".$curdate."'";
		$closeticket = jssupportticket::$_db->get_results($query);

		$query = "SELECT created FROM `".jssupportticket::$_db->prefix."js_ticket_tickets` WHERE isanswered = 1 AND status != 4 AND status != 0 AND date(created) >= '".$fromdate."' AND date(created) <= '".$curdate."'";
		$answeredticket = jssupportticket::$_db->get_results($query);

		$query = "SELECT created FROM `".jssupportticket::$_db->prefix."js_ticket_tickets` WHERE date(created) >= '".$fromdate."' AND date(created) <= '".$curdate."' ORDER BY created DESC";
		$allticket = jssupportticket::$_db->get_results($query);

		$date_allticket = '';
		$date_openticket = '';
		$date_closeticket = '';
		$date_answeredticket = '';
		foreach($allticket AS $ticket){
			if(!isset($date_allticket[date('Y-m-d',strtotime($ticket->created))])) 
				$date_allticket[date('Y-m-d',strtotime($ticket->created))] = 0;
			$date_allticket[date('Y-m-d',strtotime($ticket->created))] = $date_allticket[date('Y-m-d',strtotime($ticket->created))] + 1;
		}
		foreach($openticket AS $ticket){
			if(!isset($date_openticket[date('Y-m-d',strtotime($ticket->created))])) 
				$date_openticket[date('Y-m-d',strtotime($ticket->created))] = 0;
			$date_openticket[date('Y-m-d',strtotime($ticket->created))] = $date_openticket[date('Y-m-d',strtotime($ticket->created))] + 1;
		}
		foreach($closeticket AS $ticket){
			if(!isset($date_closeticket[date('Y-m-d',strtotime($ticket->created))])) 
				$date_closeticket[date('Y-m-d',strtotime($ticket->created))] = 0;
			$date_closeticket[date('Y-m-d',strtotime($ticket->created))] = $date_closeticket[date('Y-m-d',strtotime($ticket->created))] + 1;
		}
		foreach($answeredticket AS $ticket){
			if(!isset($date_answeredticket[date('Y-m-d',strtotime($ticket->created))])) 
				$date_answeredticket[date('Y-m-d',strtotime($ticket->created))] = 0;
			$date_answeredticket[date('Y-m-d',strtotime($ticket->created))] = $date_answeredticket[date('Y-m-d',strtotime($ticket->created))] + 1;
		}
		$openticket = '';
		$closeticket = '';
		$answeredticket = '';
		$allticket = '';
		for($i = 0; $i < 7; $i++){
			$nextdate = date('Y-m-d',strtotime($nextdate." +1 days"));
			$dates .= '"'.$nextdate.'",';
			$openticket .= isset($date_openticket[$nextdate]) ? '"'.$date_openticket[$nextdate].'",' : '"0",';
			$closeticket .= isset($date_close[$nextdate]) ? '"'.$date_closeticket[$nextdate].'",' : '"0",';
			$answeredticket .= isset($date_answeredticket[$nextdate]) ? '"'.$date_answeredticket[$nextdate].'",' : '"0",';
			$allticket .= isset($date_allticket[$nextdate]) ? '"'.$date_allticket[$nextdate].'",' : '"0",';
		}

		jssupportticket::$_data['line_dates'] = $dates;
		jssupportticket::$_data['line_openticket'] = $openticket;
		jssupportticket::$_data['line_closeticket'] = $closeticket;
		jssupportticket::$_data['line_answeredticket'] = $answeredticket;
		jssupportticket::$_data['line_allticket'] = $allticket;

		$query = "SELECT ticket.id,ticket.ticketid,ticket.subject,ticket.name,ticket.created,priority.priority,priority.prioritycolour
					FROM `".jssupportticket::$_db->prefix."js_ticket_tickets` AS ticket
					JOIN `".jssupportticket::$_db->prefix."js_ticket_priorities` AS priority ON priority.id = ticket.priorityid
					WHERE ticket.status = 0 AND date(ticket.created) = CURDATE() LIMIT 0, 5";
		jssupportticket::$_data['tickets'] = jssupportticket::$_db->get_results($query);
		return;
	}	
}

?>
