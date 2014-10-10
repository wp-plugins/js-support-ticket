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

add_action( 'init', 'boj_rrs_add_rules' );
function boj_rrs_add_rules() {
    add_rewrite_rule( 'js-support-ticket-controlpanel/ticket_ticketdetail/?([^/]*)',
    'index.php?pagename=js-support-ticket-controlpanel&task=ticket_ticketdetail&jssupportticket_ticketid=$matches[1]',
    'top' );
    add_rewrite_rule( 'js-support-ticket-controlpanel/ticket_myticket/([^/]*)/?([^/]*)',
    'index.php?pagename=js-support-ticket-controlpanel&task=ticket_myticket&list=$matches[1]&sortby=$matches[2]',
    'top' );
    add_rewrite_rule( 'js-support-ticket-controlpanel/?([^/]*)',
    'index.php?pagename=js-support-ticket-controlpanel&task=$matches[1]',
    'top' );
	add_rewrite_rule( 'js-support-ticket-controlpanel/([^/]*)/([^/]*)/?([^/]*)',
	'index.php?pagename=js-support-ticket-controlpanel&task=$matches[1]&list=$matches[2]&sortby=$matches[3]',
	'top' );
}

add_action('init', 'boj_products_rewrite');
function boj_products_rewrite() {
	add_rewrite_tag( '%task%', '([^/]+)');
	add_rewrite_tag( '%list%', '([^/]+)');
	add_rewrite_tag( '%sortby%', '([^/]+)');
	add_rewrite_tag( '%jssupportticket_ticketid%', '([^/]+)');
	//add_permastruct( 'store', '%pagename%/%store_id%' , array( 'ep_mask'=>EP_PERMALINK ));
}

add_action('parse_request','parse_request1');

function parse_request1($q){
	//echo '<pre>';print_r($q->query_vars);echo '</pre>';
}

add_filter('redirect_canonical', 'wptuts_redirect_canonical', 10, 2);
function wptuts_redirect_canonical($redirect_url, $requested_url) {
 
    global $wp_rewrite;
    // Abort if not using pretty permalinks, is a feed, or not an archive for the post type 'book'
    if( ! $wp_rewrite->using_permalinks() || is_feed()  )
        return $redirect_url;
 
    // Get the original query parts
    $redirect = @parse_url($requested_url);
    $original = $redirect_url;
    if( !isset($redirect['query'] ) )
        $redirect['query'] ='';
 
    // If is year/month/day - append year
    if ( is_year() || is_month() || is_day() ) {
        $year = get_query_var('year');
        $redirect['query'] = remove_query_arg( 'year', $redirect['query'] );
        $redirect_url = user_trailingslashit(get_post_type_archive_link('book')).$year;
    }
 
    // If is month/day - append month
    if ( is_month() || is_day() ) {
        $month = zeroise( intval(get_query_var('monthnum')), 2 );
        $redirect['query'] = remove_query_arg( 'monthnum', $redirect['query'] );
        $redirect_url .= '/'.$month;
    }
 
    // If is day - append day
    if ( is_day() ) {
        $day = zeroise( intval(get_query_var('day')), 2 );
        $redirect['query'] = remove_query_arg( 'day', $redirect['query'] );
        $redirect_url .= '/'.$day;
    }

    // If is page_id
    if ( get_query_var('page_id') ) {
        $page_id = get_query_var('page_id');
        $redirect['query'] = remove_query_arg( 'page_id', $redirect['query'] );
        $redirect_url = user_trailingslashit(get_page_link($page_id));
    }
 
    // If is task
    if ( get_query_var('task') ) {
        $task = get_query_var('task');
        $redirect['query'] = remove_query_arg( 'task', $redirect['query'] );
        $redirect_url .= $task;
    }

    // If is list
    if ( get_query_var('list') ) {
        $list = get_query_var('list');
        $redirect['query'] = remove_query_arg( 'list', $redirect['query'] );
        $redirect_url .= '/'.$list;
    }

    // If is sortby
    if ( get_query_var('sortby') ) {
        $sortby = get_query_var('sortby');
        $redirect['query'] = remove_query_arg( 'sortby', $redirect['query'] );
        $redirect_url .= '/'.$sortby;
    }

    // If is jssupportticket_ticketid
    if ( get_query_var('jssupportticket_ticketid') ) {
        $jssupportticket_ticketid = get_query_var('jssupportticket_ticketid');
        $redirect['query'] = remove_query_arg( 'jssupportticket_ticketid', $redirect['query'] );
        $redirect_url .= '/'.$jssupportticket_ticketid;
    }

    // If paged, apppend pagination
    if ( get_query_var('paged') > 0 ) {
        $paged = (int) get_query_var('paged');
        $redirect['query'] = remove_query_arg( 'paged', $redirect['query'] );
 
        if ( $paged > 1 )
            $redirect_url .= user_trailingslashit("/page/$paged", 'paged');
    }
 
    if( $redirect_url == $original )
        return $original;
 
    // tack on any additional query vars
    $redirect['query'] = preg_replace( '#^\??&*?#', '', $redirect['query'] );
    if ( $redirect_url && !empty($redirect['query']) ) {
        parse_str( $redirect['query'], $_parsed_query );
        $_parsed_query = array_map( 'rawurlencode', $_parsed_query );
        $redirect_url = add_query_arg( $_parsed_query, $redirect_url );
    }
 
    return $redirect_url;
}

?>
