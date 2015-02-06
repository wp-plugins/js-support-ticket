<?php
if(jssupportticket::$_config['offline'] == 2){
    if( get_current_user_id() != 0 ){
        JSSTmessage::getMessage(); 
        wp_enqueue_script('jquery-ui-datepicker');
        wp_enqueue_script('file_validate.js', jssupportticket::$_pluginpath . 'includes/js/file_validate.js');
        wp_enqueue_style('jquery-ui-css', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
        wp_enqueue_script('formvalidate.js',jssupportticket::$_pluginpath.'includes/js/jquery.form-validator.js');
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $('.custom_date').datepicker({
                    dateFormat: 'yy-mm-dd'
                });
                jQuery("#tk_attachment_add").click(function () {
                    var obj = this;
                    var current_files = jQuery('input[type="file"]').length;
                    var total_allow =<?php echo jssupportticket::$_config['no_of_attachement']; ?>;
                    var append_text = "<span class='tk_attachment_value_text'><input name='filename[]' type='file' onchange=\"uploadfile(this,'<?php echo jssupportticket::$_config['file_maximum_size']; ?>','<?php echo jssupportticket::$_config['file_extension']; ?>');\" size='20' maxlenght='30'  /><span  class='tk_attachment_remove'></span></span>";
                    if (current_files < total_allow) {
                        jQuery(".tk_attachment_value_wrapperform").append(append_text);
                    } else if ((current_files === total_allow) || (current_files > total_allow)) {
                        alert('<?php echo __('FILE_UPLOAD_LIMIT_EXCEED', 'js-support-ticket'); ?>');
                        obj.hide();
                    }
                });
                jQuery(document).delegate(".tk_attachment_remove", "click", function (e) {
                    jQuery(this).parent().remove();
                    var current_files = jQuery('input[type="file"]').length;
                    var total_allow =<?php echo jssupportticket::$_config['no_of_attachement']; ?>;
                    if (current_files < total_allow) {
                        jQuery("#tk_attachment_add").show();
                    }
                });
                $.validate();
            });
        </script>
        <span style="display:none" id="filesize"><?php echo __('ERROR_FILE_SIZE_TO_LARGE', 'js-support-ticket'); ?></span>
        <span style="display:none" id="fileext"><?php echo __('ERROR_FILE_EXT_MISMATCH', 'js-support-ticket'); ?></span>
        <?php
        $loginuser_name = '';
        $loginuser_email = '';
        if (is_user_logged_in()) {
            global $current_user;
            get_currentuserinfo();

            $loginuser_name = $current_user->user_firstname . ' ' . $current_user->user_lastname;
            $loginuser_email = $current_user->user_email;
        }
        ?>
        <?php JSSTbreadcrumbs::getBreadcrumbs();?>
        <h1 class="js-ticket-heading"><?php echo __('ADD_TICKET', 'js-support-ticket') ?></h1>
        <form class="js-ticket-form" method="post" action="<?php echo site_url("?page_id=" . jssupportticket::$_pageid . "&module=ticket&task=saveticket"); ?>" id="adminTicketform" enctype="multipart/form-data">
                            <div class="js-col-md-6 js-form-wrapper">
                                <div class="js-col-md-12 js-form-title"><?php echo __('EMAIL', 'js-support-ticket'); ?>&nbsp;<font color="red">*</font></div>
                                <div class="js-col-md-12 js-form-value"><?php echo JSSTformfield::text('email', isset(jssupportticket::$_data[0]->email) ? jssupportticket::$_data[0]->email : $loginuser_email, array('class' => 'inputbox','data-validation'=>'email')) ?></div>
                            </div>
                            <div class="js-col-md-6 js-form-wrapper">
                                <div class="js-col-md-12 js-form-title"><?php echo __('FULL_NAME', 'js-support-ticket'); ?>&nbsp;<font color="red">*</font></div>
                                <div class="js-col-md-12 js-form-value"><?php echo JSSTformfield::text('name', isset(jssupportticket::$_data[0]->name) ? jssupportticket::$_data[0]->name : $loginuser_name, array('class' => 'inputbox','data-validation'=>'required')) ?></div>
                            </div>
                            <div class="js-col-md-6 js-form-wrapper">
                                <div class="js-col-md-12 js-form-title"><?php echo __('PHONE_NOE', 'js-support-ticket'); ?></div>
                                <div class="js-col-md-12 js-form-value"><?php echo JSSTformfield::text('phone', isset(jssupportticket::$_data[0]->phone) ? jssupportticket::$_data[0]->phone : '', array('class' => 'inputbox')) ?></div>
                            </div>
                            <div class="js-col-md-6 js-form-wrapper">
                                <div class="js-col-md-12 js-form-title"><?php echo __('PHONE_EXT', 'js-support-ticket'); ?></div>
                                <div class="js-col-md-12 js-form-value"><?php echo JSSTformfield::text('phoneext', isset(jssupportticket::$_data[0]->phoneext) ? jssupportticket::$_data[0]->phoneext : '', array('class' => 'inputbox')) ?></div>
                            </div>
                            <div class="js-col-md-6 js-form-wrapper">
                                <div class="js-col-md-12 js-form-title"><?php echo __('DEPARTMENT', 'js-support-ticket'); ?>&nbsp;<font color="red">*</font></div>
                                <div class="js-col-md-12 js-form-value"><?php echo JSSTformfield::select('departmentid', JSSTincluder::getJSModel('department')->getDepartmentForCombobox(), isset(jssupportticket::$_data[0]->departmentid) ? jssupportticket::$_data[0]->departmentid : '', __('SELECT_DEPARTMENT', 'js-support-ticket'), array('class' => 'inputbox','onchange'=>'getHelpTopicByDepartment(this.value);','data-validation'=>'required')); ?></div>
                            </div>
                            <div class="js-col-md-6 js-form-wrapper">
                                <div class="js-col-md-12 js-form-title"><?php echo __('PRIORITY', 'js-support-ticket'); ?>&nbsp;<font color="red">*</font></div>
                                <div class="js-col-md-12 js-form-value"><?php echo JSSTformfield::select('priorityid', JSSTincluder::getJSModel('priority')->getPriorityForCombobox(), isset(jssupportticket::$_data[0]->priorityid) ? jssupportticket::$_data[0]->priorityid : JSSTincluder::getJSModel('priority')->getDefaultPriorityID(), __('SELECT_PROIRITY', 'js-support-ticket'), array('class' => 'inputbox','data-validation'=>'required')); ?></div>
                            </div>
                            <div class="js-col-md-12 js-form-wrapper">
                                <div class="js-col-md-12 js-form-title"><?php echo __('SUBJECT', 'js-support-ticket'); ?>&nbsp;<font color="red">*</font></div>
                                <div class="js-col-md-12 js-form-value"><?php echo JSSTformfield::text('subject', isset(jssupportticket::$_data[0]->subject) ? jssupportticket::$_data[0]->subject : '', array('class' => 'inputbox','data-validation'=>'required')) ?></div>
                            </div>
                            <div class="js-col-md-12 js-form-wrapper">
                                <div class="js-col-md-12"><?php echo __('ISSUE_SUMMARY', 'js-support-ticket'); ?></div>
                                <div class="js-col-md-12"><?php echo wp_editor(isset(jssupportticket::$_data[0]->message) ? jssupportticket::$_data[0]->message : '', 'message', array('media_buttons' => false)); ?></div>
                            </div>
                            <div class="js-col-md-12 js-form-wrapper">
                                <div class="js-col-md-12 js-form-title"><?php echo __('ATTACHMENTS', 'js-support-ticket'); ?></div>
                                <div class="js-col-md-12 js-form-value">
                                    <div class="tk_attachment_value_wrapperform">
                                        <span class="tk_attachment_value_text">
                                            <input type="file" class="inputbox" name="filename[]" onchange="uploadfile(this, '<?php echo jssupportticket::$_config['file_maximum_size']; ?>', '<?php echo jssupportticket::$_config['file_extension']; ?>');" size="20" maxlenght='30'/>
                                            <span class='tk_attachment_remove'></span>
                                        </span>
                                    </div>
                                    <span class="tk_attachments_configform">
                                        <small><?php echo __('MAXIMUM_FILE_SIZE', 'js-support-ticket');
                        echo ' (' . jssupportticket::$_config['file_maximum_size']; ?>KB)<br><?php echo __('FILE_EXTENSION_TYPE', 'js-support-ticket');
                        echo ' (' . jssupportticket::$_config['file_extension'] . ')'; ?></small>
                                    </span>
                                    <span id="tk_attachment_add" class="tk_attachments_addform"><?php echo __('ADD_MORE_FILE', 'js-support-ticket'); ?></span>
                                    <?php
                                    if (!empty(jssupportticket::$_data[5])) {
                                        foreach (jssupportticket::$_data[5] AS $attachment) {
                                            echo '
                                                                <div class="js_ticketattachment">
                                                                        ' . $attachment->filename . ' ( ' . $attachment->filesize . ' ) ' . '
                                                                        <a href="?page=attachment&task=deleteattachment&action=jstask&id=' . $attachment->id . '&ticketid=' . isset(jssupportticket::$_data[0]->id) ? jssupportticket::$_data[0]->id : '' . '">' . _('DELETE_ATTACHMENT') . '</a>
                                                                </div>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php
                        if(isset(jssupportticket::$_data[3]))
                        foreach (jssupportticket::$_data[3] as $ufield) {
                            $userfeild = $ufield[0];
                            //if($field->field == $userfeild->id){
                                $i++;
                                echo '<div class="js-col-md-6 js-form-wrapper">
                                        <div class="js-col-md-12 js-form-title">';
                                if ($userfeild->required == 1) {
                                    echo '<label id="' . $userfeild->name . '"msg for="' . $userfeild->name . '">' . $userfeild->title . '</label>:&nbsp;<font color="red">*</font>';
                                    if ($userfeild->type == 'emailaddress')
                                        $cssclass = 'class ="inputbox required validate-email"';
                                    else
                                        $cssclass = 'class="inputbox required"';
                                }else {
                                    echo $userfeild->title . ":&nbsp;";
                                    if ($userfeild->type == 'emailaddress')
                                        $cssclass = 'class="inputbox validate-email"';
                                    else
                                        $cssclass = 'class="inputbox"';
                                }
                                echo '  </div>
                                        <div class="js-col-md-12 js-form-value">';
                                $readonly = ($userfeild->readonly == 1) ? ' readonly="readonly"' : '';
                                $required = ($userfeild->required == 1) ? ' data-validation="required"' : '';
                                $maxlength = ($userfeild->maxlength > 0) ? 'maxlength="' . $userfeild->maxlength . '"' : '';
                                if (isset($ufield[1])) {
                                    $fvalue = $ufield[1]->data;
                                    $userdataid = $ufield[1]->id;
                                } else {
                                    $fvalue = "";
                                    $userdataid = "";
                                }
                                echo '<input type="hidden" id="userfeilds_' . $i . '_id" name="userfeilds_' . $i . '_id"  value="' . $userfeild->id . '"  />';
                                echo '<input type="hidden" id="userdata_' . $i . '_id" name="userdata_' . $i . '_id"  value="' . $userdataid . '"  />';
                                switch ($userfeild->type) {
                                    case 'text':
                                        echo '<input type="text" id="userfeilds_' . $i . '" name="userfeilds_' . $i . '" size="' . $userfeild->size . '" value="' . $fvalue . '" ' . $cssclass . $maxlength . $readonly . $required.' />';
                                        break;
                                    case 'emailaddress':
                                        echo '<input type="text" id="userfeilds_' . $i . '" name="userfeilds_' . $i . '" size="' . $userfeild->size . '" value="' . $fvalue . '" ' . $cssclass . $maxlength . $readonly . $required.' data-validation="email" />';
                                        break;
                                    case 'date':
                                        $userfeildid = 'userfeilds_' . $i;
                                        $userfeildid = "'" . $userfeildid . "'";
                                        echo JSSTformfield::text('userfeilds_' . $i, $fvalue, array('class' => 'custom_date'));
                                        break;
                                    case 'textarea':
                                        echo '<textarea name="userfeilds_' . $i . '" id="userfeilds_' . $i . '_field" cols="' . $userfeild->cols . '" rows="' . $userfeild->rows . '" ' . $readonly . $required.'>' . $fvalue . '</textarea>';
                                        break;
                                    case 'checkbox':
                                        echo '<input type="checkbox" name="userfeilds_' . $i . '" id="userfeilds_' . $i . '_field" value="1" ' . 'checked="checked"' . '/>';
                                        break;
                                    case 'select':
                                        $htm = '<select name="userfeilds_' . $i . '" id="userfeilds_' . $i . '" '.$required.'>';
                                        if (isset($ufield[2])) {
                                            foreach ($ufield[2] as $opt) {
                                                if ($opt->id == $fvalue)
                                                    $htm .= '<option value="' . $opt->id . '" selected="yes">' . $opt->fieldtitle . ' </option>';
                                                else
                                                    $htm .= '<option value="' . $opt->id . '">' . $opt->fieldtitle . ' </option>';
                                            }
                                        }
                                        $htm .= '</select>';
                                        echo $htm;
                                        break;
                                }
                                echo '  </div>
                                </div>';
                            //}
                        }
                        ?>
            <?php
                echo '<input type="hidden" id="userfeilds_total" name="userfeilds_total"  value="' . $i . '"  />';
            ?>
        <?php echo JSSTformfield::hidden('id', isset(jssupportticket::$_data[0]->id) ? jssupportticket::$_data[0]->id : ''); ?>
        <?php echo JSSTformfield::hidden('ticketid', isset(jssupportticket::$_data[0]->ticketid) ? jssupportticket::$_data[0]->ticketid : ''); ?>
        <?php echo JSSTformfield::hidden('created', isset(jssupportticket::$_data[0]->created) ? jssupportticket::$_data[0]->created : ''); ?>
        <?php echo JSSTformfield::hidden('uid', get_current_user_id()); ?>
        <?php echo JSSTformfield::hidden('updated', isset(jssupportticket::$_data[0]->updated) ? jssupportticket::$_data[0]->updated : ''); ?>
        <?php echo JSSTformfield::hidden('form_request', 'jssupportticket'); ?>
            <div class="js-form-button">
        <?php echo JSSTformfield::submitbutton('save', __('SAVE_TICKET', 'js-support-ticket'), array('class' => 'button')); ?>
            </div>
        </form>
<?php
    }else{// User is guest
        JSSTlayout::getUserGuest();
    }
}else{ // System is offline
    JSSTlayout::getSystemOffline();
}
?>