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

class pagination{

	static $_limit;
	static $_offset;
	
	static function getPagination($total){
		$pagenum = isset( $_GET['pagenum'] ) ? absint( $_GET['pagenum'] ) : 1;
		self::$_limit = 10; // number of rows in page
		self::$_offset = ( $pagenum - 1 ) * self::$_limit;
		$num_of_pages = ceil( $total / self::$_limit );
		$result = paginate_links( array(
									    'base' => add_query_arg( 'pagenum', '%#%' ),
									    'format' => '',
									    'prev_text' => __( '&laquo;', 'aag' ),
									    'next_text' => __( '&raquo;', 'aag' ),
									    'total' => $num_of_pages,
									    'current' => $pagenum
										));
		return $result;
	}
	
	
}

?>
