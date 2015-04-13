<?php

if (!defined('ABSPATH'))
    die('Restricted Access');

class JSSTuserfeildModel {

    function getUserFeilds($fieldfor) {
        // Filter
        $name = JSSTrequest::getVar('name');
        $inquery = '';

        $formsearch = JSSTrequest::getVar('JSST_form_search', 'post');
        if ($formsearch == 'JSST_SEARCH') {
            $_SESSION['JSST_SEARCH']['name'] = $name;
        }

        if (JSSTrequest::getVar('pagenum', 'get', null) != null) {
            $name = (isset($_SESSION['JSST_SEARCH']['name']) && $_SESSION['JSST_SEARCH']['name'] != '') ? $_SESSION['JSST_SEARCH']['name'] : null;
        }

        if ($name != null)
            $inquery .= " AND field.name LIKE '%$name%'";

        jssupportticket::$_data['filter']['name'] = $name;

        // Pagination
        $query = "SELECT COUNT(`id`) FROM `" . jssupportticket::$_db->prefix . "js_ticket_userfields` AS field WHERE 1=1 ";
        $query .= $inquery;
        $total = jssupportticket::$_db->get_var($query);
        jssupportticket::$_data[1] = JSSTpagination::getPagination($total);

        if (!is_numeric($fieldfor))
            return false;
        $query = "SELECT field.* FROM `" . jssupportticket::$_db->prefix . "js_ticket_userfields` AS field WHERE fieldfor = '" . $fieldfor . "'";
        $query .= $inquery;
        $query .= " ORDER BY field.id ASC LIMIT " . JSSTpagination::$_offset . ", " . JSSTpagination::$_limit;
        jssupportticket::$_data[0] = jssupportticket::$_db->get_results($query);
        if (jssupportticket::$_db->last_error != null) {
            JSSTincluder::getJSModel('systemerror')->addSystemError();
        }
        return;
    }

    function getUserFeildbyId($id) {
        if ($id) { // edit case
			if(!is_numeric($id)) return false;
            $query = "SELECT * FROM `" . jssupportticket::$_db->prefix . "js_ticket_userfields` WHERE id = " . $id;
            jssupportticket::$_data[0] = jssupportticket::$_db->get_results($query);
            if (jssupportticket::$_db->last_error != null) {
                JSSTincluder::getJSModel('systemerror')->addSystemError();
            }
            $query = "SELECT * FROM `" . jssupportticket::$_db->prefix . "js_ticket_userfieldvalues` WHERE field = " . $id;
            jssupportticket::$_data[1] = jssupportticket::$_db->get_results($query);
            if (jssupportticket::$_db->last_error != null) {
                JSSTincluder::getJSModel('systemerror')->addSystemError(); // if there is an error add it to system errorrs
            }
        }else jssupportticket::$_data[0] = array();
        return;
    }

    function storeUserFeild($data) {
        $query_array = array('id' => $data['id'],
            'name' => $data['name'],
            'title' => $data['title'],
            'type' => $data['type'],
            'readonly' => $data['readonly'],
            'published' => $data['published'],
            'required' => $data['required'],
            'maxlength' => $data['maxlength'],
            'size' => $data['size'],
            'fieldfor' => $data['fieldfor']
        );
        $object = jssupportticket::$_db->replace(jssupportticket::$_db->prefix . 'js_ticket_userfields', $query_array);
        $lastid = jssupportticket::$_db->insert_id; // to get the id of userfeild        
        if (jssupportticket::$_db->last_error != null) {
            JSSTincluder::getJSModel('systemerror')->addSystemError();
            JSSTmessage::setMessage(__('User field has not been stored', 'js-support-ticket'), 'error');
        } else {
            JSSTmessage::setMessage(__('User field has been stored', 'js-support-ticket'), 'updated');
            if ($data['id'] == '') { // only for new
                $query = "INSERT INTO `" . jssupportticket::$_db->prefix . "js_ticket_fieldsordering`
                        (field, fieldtitle, ordering, section, fieldfor, published, sys, cannotunpublish)
                        VALUES(" . $lastid . ",'" . $data['title'] . "', ( SELECT max(ordering)+1 FROM `" . jssupportticket::$_db->prefix . "js_ticket_fieldsordering` AS field WHERE fieldfor = 1 ), ''
                        , 1 ," . $data['published'] . " ,0,0)
                ";
                jssupportticket::$_db->query($query);
            }
            $data['jsIds'] = isset($data['jsIds']) ? $data['jsIds'] : '';
            $data['jsNames'] = isset($data['jsNames']) ? $data['jsNames'] : '';
            $data['jsValues'] = isset($data['jsValues']) ? $data['jsValues'] : '';
            if ($data['type']) {
                $ids = $data['jsIds'];
                $names = $data['jsNames'];
                $values = $data['jsValues'];
                $fieldvaluedata = array();
                if (!empty($names) && !empty($values))
                    for ($i = 0; $i <= $data['valueCount']; $i++) {
                        if (isset($ids[$i]))
                            $fieldvaluedata['id'] = $ids[$i];
                        else
                            $fieldvaluedata['id'] = '';
                        $fieldvaluedata['field'] = $lastid;
                        $fieldvaluedata['fieldtitle'] = $names[$i];
                        $fieldvaluedata['fieldvalue'] = $values[$i];
                        $fieldvaluedata['ordering'] = $i + 1;
                        $fieldvaluedata['sys'] = 0;
                        jssupportticket::$_db->replace(jssupportticket::$_db->prefix . 'js_ticket_userfieldvalues', $fieldvaluedata);
                        if (jssupportticket::$_db->last_error != null) {
                            JSSTincluder::getJSModel('systemerror')->addSystemError();
                        }
                    }
            }
        }
        return;
    }

    function removeUserFeild($id) {
        if (!is_numeric($id))
            return false;
        $data = self :: canRemoveUserFeild($id);
        if ($this->canRemoveUserFeild($id)) {
            jssupportticket::$_db->delete(jssupportticket::$_db->prefix . 'js_ticket_userfields', array('id' => $id));
            if (jssupportticket::$_db->last_error == null) {
                JSSTmessage::setMessage(__('User field has been deleted', 'js-support-ticket'), 'updated');
            } else {
                JSSTincluder::getJSModel('systemerror')->addSystemError(); // if there is an error add it to system errorrs
                JSSTmessage::setMessage(__('User field has not been deleted', 'js-support-ticket'), 'error');
            }
        } else {
            JSSTmessage::setMessage(__('User field in use cannot deleted', 'js-support-ticket'), 'error');
        }
        return;
    }

    private function canRemoveUserFeild($id) {
        if (!is_numeric($id))
            return false;
        $query = "SELECT COUNT(userfield_data.id) 
					FROM `" . jssupportticket::$_db->prefix . "js_ticket_userfield_data` AS userfield_data WHERE userfield_data.field = $id";
        $result = jssupportticket::$_db->get_var($query);

        if (jssupportticket::$_db->last_error != null) {
            JSSTincluder::getJSModel('systemerror')->addSystemError();
        }
        if ($result == 0)
            return true;
        else
            return false;

        return $data;
    }

    function getUserFeildsForView($fieldfor, $id) {
        if ($id != '')
            if (!is_numeric($id))
                return false;
        if (!is_numeric($fieldfor))
            return false;
        $field = array();
        $return = array();
        $query = "SELECT  * FROM `" . jssupportticket::$_db->prefix . "js_ticket_userfields` AS ticket
					WHERE published = 1 AND fieldfor = " . $fieldfor;
        $rows = jssupportticket::$_db->get_results($query);
        if (jssupportticket::$_db->last_error != null) {
            JSSTincluder::getJSModel('systemerror')->addSystemError();
        }
        $i = 0;
        foreach ($rows as $row) {
            $field[0] = $row;
            if ($id != "") {
                $query = "SELECT  * FROM `" . jssupportticket::$_db->prefix . "js_ticket_userfield_data` WHERE referenceid = " . $id . " AND field = " . $row->id;
                $data = jssupportticket::$_db->get_row($query);
                if (jssupportticket::$_db->last_error != null) {
                    JSSTincluder::getJSModel('systemerror')->addSystemError();
                }
                $field[1] = $data;
            }
            if ($row->type == "select") {
                $query = "SELECT  value.* FROM `" . jssupportticket::$_db->prefix . "js_ticket_userfieldvalues` AS value
							JOIN `" . jssupportticket::$_db->prefix . "js_ticket_userfield_data` udata ON udata.data = value.id
							WHERE value.field = " . $row->id;
                $value = jssupportticket::$_db->get_row($query);
                if (jssupportticket::$_db->last_error != null) {
                    JSSTincluder::getJSModel('systemerror')->addSystemError();
                }
                $field[2] = $value;
            }
            $return[] = $field;
            $i++;
        }

        jssupportticket::$_data[2] = $return;
        return;
    }

    function getUserFeildsForForm($fieldfor, $id) {
        if ($id != '')
            if (!is_numeric($id))
                return false;
        if (!is_numeric($fieldfor))
            return false;
        $result;
        $field = array();
        $result = array();
        $query = "SELECT  * FROM `" . jssupportticket::$_db->prefix . "js_ticket_userfields` AS ticket
					WHERE published = 1 AND fieldfor = " . $fieldfor;
        $rows = jssupportticket::$_db->get_results($query);
        if (jssupportticket::$_db->last_error != null) {
            JSSTincluder::getJSModel('systemerror')->addSystemError();
        }
        $i = 0;
        foreach ($rows as $row) {
            $field[0] = $row;
            if ($id != "") {
                $query = "SELECT  * FROM `" . jssupportticket::$_db->prefix . "js_ticket_userfield_data` WHERE referenceid = " . $id . " AND field = " . $row->id;
                $data = jssupportticket::$_db->get_row($query);
                if (jssupportticket::$_db->last_error != null) {
                    JSSTincluder::getJSModel('systemerror')->addSystemError();
                }
                $field[1] = $data;
            }
            if ($row->type == "select") {
                $query = "SELECT  * FROM `" . jssupportticket::$_db->prefix . "js_ticket_userfieldvalues` WHERE field = " . $row->id;
                $data = jssupportticket::$_db->get_results($query);
                if (jssupportticket::$_db->last_error != null) {
                    JSSTincluder::getJSModel('systemerror')->addSystemError();
                }
                $field[2] = $data;
            }
            $result[] = $field;
            $i++;
        }
        jssupportticket::$_data[3] = $result;
        return;
    }

}

?>
