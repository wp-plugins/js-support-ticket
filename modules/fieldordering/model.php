<?php

if (!defined('ABSPATH'))
    die('Restricted Access');

class JSSTfieldorderingModel {

    function getFieldOrderingForList() {
        // Pagination
        /*
          $query = "SELECT COUNT(`id`) FROM `".jssupportticket::$_db->prefix."js_ticket_fieldsordering` WHERE published = 1 AND fieldfor = 1";
          $total = jssupportticket::$_db->get_var($query);
          jssupportticket::$_data[1] = JSSTpagination::getPagination($total);
         */

        // Data
//        $query = "SELECT * FROM `".jssupportticket::$_db->prefix."js_ticket_fieldsordering` WHERE published = 1 AND fieldfor = 1 ORDER BY ordering LIMIT ".JSSTpagination::$_offset.", ".JSSTpagination::$_limit;
        $query = "SELECT * FROM `" . jssupportticket::$_db->prefix . "js_ticket_fieldsordering` WHERE fieldfor = 1 ORDER BY ordering ";
        jssupportticket::$_data[0] = jssupportticket::$_db->get_results($query);
        if (jssupportticket::$_db->last_error != null) {
            JSSTincluder::getJSModel('systemerror')->addSystemError();
        }
        return;
    }

    function changePublishStatus($id, $status) {
        if (!is_numeric($id))
            return false;
        if ($status == 'publish') {            
            $query = "UPDATE `" . jssupportticket::$_db->prefix . "js_ticket_fieldsordering` SET published = 1 WHERE id = " . $id . " AND cannotunpublish = 0";
            jssupportticket::$_db->query($query);
            if (jssupportticket::$_db->last_error != null) {
                JSSTincluder::getJSModel('systemerror')->addSystemError();
            }
            JSSTmessage::setMessage(__('Field mark as published', 'js-support-ticket'),'updated');
        } elseif ($status == 'unpublish') {
            $query = "UPDATE `" . jssupportticket::$_db->prefix . "js_ticket_fieldsordering` SET published = 0 WHERE id = " . $id . " AND cannotunpublish = 0";
            jssupportticket::$_db->query($query);
            if (jssupportticket::$_db->last_error != null) {
                JSSTincluder::getJSModel('systemerror')->addSystemError();
            }
            JSSTmessage::setMessage(__('Field mark as unpublished', 'js-support-ticket'),'updated');
        }
        return;
    }

    function changeRequiredStatus($id, $status) {
        if (!is_numeric($id))
            return false;
        if ($status == 'required') {            
            $query = "UPDATE `" . jssupportticket::$_db->prefix . "js_ticket_fieldsordering` SET required = 1 WHERE id = " . $id . " AND cannotunpublish = 0";
            jssupportticket::$_db->query($query);
            if (jssupportticket::$_db->last_error != null) {
                JSSTincluder::getJSModel('systemerror')->addSystemError();
            }
            JSSTmessage::setMessage(__('Field mark as required', 'js-support-ticket'),'updated');
        } elseif ($status == 'unrequired') {
            $query = "UPDATE `" . jssupportticket::$_db->prefix . "js_ticket_fieldsordering` SET required = 0 WHERE id = " . $id . " AND cannotunpublish = 0";
            jssupportticket::$_db->query($query);
            if (jssupportticket::$_db->last_error != null) {
                JSSTincluder::getJSModel('systemerror')->addSystemError();
            }
            JSSTmessage::setMessage(__('Field mark as not required', 'js-support-ticket'),'updated');
        }
        return;
    }

    function changeOrder($id, $action) {
        if (!is_numeric($id))
            return false;
        if ($action == 'down') {
            $query = "UPDATE `" . jssupportticket::$_db->prefix . "js_ticket_fieldsordering` AS f1, `" . jssupportticket::$_db->prefix . "js_ticket_fieldsordering` AS f2
                        SET f1.ordering = f1.ordering - 1 WHERE f1.ordering = f2.ordering + 1 AND f1.fieldfor = f2.fieldfor
                        AND f2.id = " . $id;
            jssupportticket::$_db->query($query);
            $query = " UPDATE `" . jssupportticket::$_db->prefix . "js_ticket_fieldsordering` SET ordering = ordering + 1 WHERE id = " . $id;
            jssupportticket::$_db->query($query);
            JSSTmessage::setMessage(__('Field ordering down', 'js-support-ticket'),'updated');
        } elseif ($action == 'up') {
            $query = "UPDATE `" . jssupportticket::$_db->prefix . "js_ticket_fieldsordering` AS f1, `" . jssupportticket::$_db->prefix . "js_ticket_fieldsordering` AS f2 SET f1.ordering = f1.ordering + 1 
                        WHERE f1.ordering = f2.ordering - 1 AND f1.fieldfor = f2.fieldfor AND f2.id = " . $id;
            jssupportticket::$_db->query($query);
            $query = " UPDATE `" . jssupportticket::$_db->prefix . "js_ticket_fieldsordering` SET ordering = ordering - 1 WHERE id = " . $id;
            jssupportticket::$_db->query($query);
            JSSTmessage::setMessage(__('Field ordering up', 'js-support-ticket'),'updated');
        }
        return;
    }

    function getFieldsOrderingforForm($fieldfor) {
        if (!is_numeric($fieldfor))
            return false;
        $query = "SELECT  * FROM `" . jssupportticket::$_db->prefix . "js_ticket_fieldsordering` WHERE published = 1 AND fieldfor =  " . $fieldfor . " ORDER BY ordering ";
        jssupportticket::$_data['fieldordering'] = jssupportticket::$_db->get_results($query);
        return;
    }

}

?>