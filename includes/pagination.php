<?php

if (!defined('ABSPATH'))
    die('Restricted Access');

class JSSTpagination {

    static $_limit;
    static $_offset;

    static function getPagination($total) {
        $pagenum = isset($_GET['pagenum']) ? absint($_GET['pagenum']) : 1;
        self::$_limit = jssupportticket::$_config['pagination_default_page_size']; // number of rows in page
        self::$_offset = ( $pagenum - 1 ) * self::$_limit;
        $num_of_pages = ceil($total / self::$_limit);
        $result = paginate_links(array(
            'base' => add_query_arg('pagenum', '%#%'),
            'format' => '',
            'prev_next' => true,
            'prev_text' => __('Pervious', 'js-support-ticket'),
            'next_text' => __('Next', 'js-support-ticket'),
            'total' => $num_of_pages,
            'current' => $pagenum,
            'add_args' => false,
        ));
        return $result;
    }

    static function isLastOrdering($total, $pagenum) {
        $maxrecord = $pagenum * jssupportticket::$_config['pagination_default_page_size'];
        if ($maxrecord >= $total)
            return false;
        else
            return true;
    }

}

?>
