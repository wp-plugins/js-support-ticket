<?php
if(!defined('ABSPATH')) die('Restricted Access');

class ticketController{
	
	function __construct(){
		self::handleRequest();
	}
	
	function handleRequest(){
		$task = request::getVar('task',null,'ticket_tickets');
		$list = request::getVar('list',null,'1');
		$ticketid = request::getVar('ticketid',null,'1');
		if(self::canaddfile()){
			$array = explode('_',$task);
			if(is_admin()){
				$action = request::getVar('action');
				$action_array = explode("_",$action);
				if($action_array[0] == 'admin'){
					ticketController::$action_array[1]();
				}else{
					$array[1] = 'admin_'.$array[1];

				}				
			}
			switch($array[1]){
				case 'admin_tickets':
					includer::getJSModel('ticket')->getTickets();
				break;
                case 'admin_addticket':
				case 'addticket':
					$id = request::getVar('jssupportticket_ticketid','get',null);
					includer::getJSModel('ticket')->getTicketsForForm($id);
				break;
                case 'admin_ticketdetail':
				case 'ticketdetail':
					$id = request::getVar('jssupportticket_ticketid',null,'ticket_tickets');
					includer::getJSModel('ticket')->getTicketForDetail($id);
				break;
                case 'myticket':
                    includer::getJSModel('ticket')->getMyTickets($list,$ticketid);
                break;
				
			}
			includer::include_file($array[1],$array[0]);
		}
	}

	function canaddfile(){
		if(isset($_POST['form_request']) && $_POST['form_request'] == 'jssupportticket')
			return false;
		elseif(isset($_GET['action']) && $_GET['action'] == 'deleteitem')
			return false;
		else
			return true;
	}

	function closeticket(){
		$id = request::getVar('ticketid');
		includer::getJSModel('ticket')->closeTicket($id);
		if(is_admin()){		
			$url = admin_url("admin.php?page=ticket_tickets&task=ticket_tickets");
		}else{
			$option = get_option('jssupportticket-pageid',array());
			$pageid = $option[0];
			$url = site_url("?page_id=".$pageid."&task=ticket_myticket&list=2");
		}
		wp_redirect($url); exit;

	}

	static function saveticket(){
		$data = request::get('post');
		includer::getJSModel('ticket')->storeTickets($data);
		if(is_admin()){		
			$url = admin_url("admin.php?page=ticket_tickets&task=ticket_tickets");
		}else{
			$option = get_option('jssupportticket-pageid',array());
			$pageid = $option[0];
			$url = site_url("?page_id=".$pageid."&task=ticket_myticket");
		}
		wp_redirect($url); exit;

	}

	static function deleteticket(){
		$id = request::getVar('ticketid');
		includer::getJSModel('ticket')->removeTicket($id);
		if(is_admin()){		
			$url = admin_url("admin.php?page=ticket_tickets&task=ticket_tickets");
		}else{
			$option = get_option('jssupportticket-pageid',array());
			$pageid = $option[0];
			$url = site_url("?page_id=".$pageid."&task=ticket_myticket");
		}
		wp_redirect($url); exit;

	}

}

$ticketController = new ticketController();
?>
