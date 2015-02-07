<?php

if (!defined('ABSPATH'))
    die('Restricted Access');

class JSSTbreadcrumbs {

    static function getBreadcrumbs() {
        if (jssupportticket::$_config['show_breadcrumbs'] != 1)
            return false;
        if (!is_admin()) {
            $editid = JSSTrequest::getVar('jssupportticketid');
            $isnew = ($editid == null) ? true : false;
            //$array[] = array('link' => site_url(home_url()), 'text' => __('HOME','js-support-ticket'));
            $array[] = array('link' => site_url("?page_id=" . jssupportticket::getPageid()), 'text' => __('CONTROL_PANEL', 'js-support-ticket'));
            $module = JSSTrequest::getVar('module');
            $layout = JSSTrequest::getVar('layout');
            if (isset(jssupportticket::$_data['short_code_header'])) {
                switch (jssupportticket::$_data['short_code_header']){
                    case 'myticket':
                        $module = 'ticket';
                        $layout = 'myticket';
                        break;
                    case 'addticket':
                        $module = 'ticket';
                        $layout = 'addticket';
                        break;
                }
            }

            if ($module != null) {
                switch ($module) {
                    case 'jssupportticket':
                        break;
                    case 'ticket':
                        // Add default module link
                        $array[] = array('link' => site_url('?page_id=' . jssupportticket::getPageid() . '&module=ticket&layout=myticket'), 'text' => __('TICKETS', 'js-support-ticket'));
                        switch ($layout) {
                            case 'addticket':
                                // $layout1 = (JSSTincluder::getJSModel('staff')->isUserStaff()) ? 'staffmyticket':'myticket';
                                // $array[] = array('link' => site_url('?page_id='.jssupportticket::getPageid().'&module=ticket&layout='.$layout1), 'text'=>__('MY_TICKETS','js-support-ticket'));
                                $text = ($isnew) ? __('ADD_TICKET', 'js-support-ticket') : __('EDIT_TICKET', 'js-support-ticket');
                                $array[] = array('link' => site_url('?page_id=' . jssupportticket::getPageid() . '&module=ticket&layout=addticket'), 'text' => $text);
                                break;
                            case 'myticket':
                                $array[] = array('link' => site_url('?page_id=' . jssupportticket::getPageid() . '&module=ticket&layout=myticket'), 'text' => __('MY_TICKETS', 'js-support-ticket'));
                                break;
                            case 'ticketdetail':
                                $layout1 = 'myticket';
                                $array[] = array('link' => site_url('?page_id=' . jssupportticket::getPageid() . '&module=ticket&layout=' . $layout1), 'text' => __('MY_TICKETS', 'js-support-ticket'));
                                $array[] = array('link' => site_url('?page_id=' . jssupportticket::getPageid() . '&module=ticket&layout=ticketdetail'), 'text' => __('TICKET_DETAIL', 'js-support-ticket'));
                                break;
                            case 'ticketstatus':
                                $array[] = array('link' => site_url('?page_id=' . jssupportticket::getPageid() . '&module=ticket&layout=ticketstatus'), 'text' => __('TICKET_STATUS', 'js-support-ticket'));
                                break;
                        }
                        break;
                }
            }
        }

        if (isset($array)) {
            $count = count($array);
            $i = 0;
            echo '<div id="jsst_breadcrumbs_parent">';
            foreach ($array AS $obj) {
                if ($i == 0) {
                    echo '<div class="home"><a href="' . $obj['link'] . '"><img class="homeicon" src="' . jssupportticket::$_pluginpath . 'includes/images/homeicon.png"/></a></div>';
                } else {
                    if ($i == ($count - 1)) {
                        echo '<div class="lastlink">' . $obj['text'] . '</div>';
                    } else {
                        echo '<div class="links"><a class="links" href="' . $obj['link'] . '">' . $obj['text'] . '</a></div>';
                    }
                }
                $i++;
            }
            echo '</div>';
        }
    }

}

$jsbreadcrumbs = new JSSTbreadcrumbs;
?>
