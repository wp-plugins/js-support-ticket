<?php
if(!defined('ABSPATH')) die('Restricted Access');

class message{
	
	/*
	 * Set Message
	 * @params $message = Your message to display
	 * @params $type = Messages types => 'updated','error','update-nag'
	 */
	static function setMessage($message, $type){
		$option = get_option('jssupportticket',array());
		$option[] = $message;
		$option[] = $type;
		update_option('jssupportticket',$option);
	}
	
	static function getMessage(){
		$divHtml = '';
		$option = get_option('jssupportticket',array());
		if(isset($option[0]) && isset($option[1])){
			$divHtml = '<div class="'.$option[1].'"><p>'.$option[0].'</p></div>';
		}
		echo $divHtml;
		delete_option('jssupportticket');
	}
	
}

?>
