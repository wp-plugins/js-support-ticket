<?php
wp_enqueue_script('jquery-ui-datepicker');
wp_enqueue_script('file_validate.js', jssupportticket::$_pluginpath . 'includes/js/file_validate.js');
wp_enqueue_style('jquery-ui-css', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
wp_enqueue_script('formvalidate.js', jssupportticket::$_pluginpath . 'includes/js/jquery.form-validator.js');
?>
<?php JSSTmessage::getMessage(); ?>
<?php $formdata = JSSTformfield::getFormData(); ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("a#userpopup").click(function (e) {
            e.preventDefault();
            jQuery("div#userpopupblack").show();
            jQuery("div#userpopup").slideDown('slow');
        });
        setUserLink();
        function setUserLink() {
            jQuery("a.js-userpopup-link").each(function () {
                var anchor = jQuery(this);
                jQuery(anchor).click(function (e) {
                    var id = jQuery(this).attr('data-id');
                    var name = jQuery(this).html();
                    var email = jQuery(this).attr('data-email');
                    var displayname = jQuery(this).attr('data-name');
                    jQuery("input#username-text").val(name);
                    if (jQuery('input#name').val() == '') {
                        jQuery('input#name').val(displayname);
                    }
                    if (jQuery('input#email').val().length <= 1) {
                        jQuery('input#email').val(email);
                    }
                    jQuery("input#uid").val(id);
                    jQuery("div#userpopup").slideUp('slow', function () {
                        jQuery("div#userpopupblack").hide();
                    });
                });
            });
        }
        jQuery("form#userpopupsearch").submit(function (e) {
            e.preventDefault();
            var username = jQuery("input#username").val();
            var name = jQuery("input#name").val();
            var emailaddress = jQuery("input#emailaddress").val();
            jQuery.post(ajaxurl, {action: 'jsticket_ajax', name: name, username: username, emailaddress: emailaddress, module: 'jssupportticket', task: 'getusersearchajax'}, function (data) {
                if (data) {
                    jQuery("div#records-inner").html(data);
                    setUserLink();
                }
            });//jquery closed
        });
        jQuery("span.close, div#userpopupblack").click(function (e) {
            jQuery("div#userpopup").slideUp('slow', function () {
                jQuery("div#userpopupblack").hide();
            });

        });
    });
    // to get premade and append to isssue summery
    function getpremade(val) {
        jQuery.post(ajaxurl, {action: 'jsticket_ajax', val: val, module: 'premademessage', task: 'getpremadeajax'}, function (data) {
            if (data) {
                var append = jQuery('input#append1:checked').length;
                if (append == 1) {
                    var content = tinyMCE.get('message').getContent();
                    content = content + data;
                    tinyMCE.get('message').execCommand('mceSetContent', false, content);
                }
                else {
                    tinyMCE.get('message').execCommand('mceSetContent', false, data);
                }
            }
        });//jquery closed
    }
    // to get premade and append to isssue summery
    function getHelpTopicByDepartment(val) {
        jQuery.post(ajaxurl, {action: 'jsticket_ajax', val: val, module: 'department', task: 'getHelpTopicByDepartment'}, function (data) {
            if (data) {
                jQuery("div#helptopic").html(data);
            }
        });//jquery closed
    }

    function getPremadeByDepartment(val) {
        jQuery.post(ajaxurl, {action: 'jsticket_ajax', val: val, module: 'department', task: 'getPremadeByDepartment'}, function (data) {
            if (data) {
                jQuery("span#premade").html(data);
            }
        });//jquery closed
    }

    jQuery(document).ready(function ($) {
        $('.custom_date').datepicker({dateFormat: 'yy-mm-dd'});
        jQuery("#tk_attachment_add").click(function () {
            var obj = this;
            var current_files = jQuery('input[type="file"]').length;
            var total_allow =<?php echo jssupportticket::$_config['no_of_attachement']; ?>;
            var append_text = "<span class='tk_attachment_value_text'><input name='filename[]' type='file' onchange=\"uploadfile(this,'<?php echo jssupportticket::$_config['file_maximum_size']; ?>','<?php echo jssupportticket::$_config['file_extension']; ?>');\" size='20' maxlenght='30'  /><span  class='tk_attachment_remove'></span></span>";

            if (current_files < total_allow) {
                jQuery(".tk_attachment_value_wrapperform").append(append_text);
            } else if ((current_files === total_allow) || (current_files > total_allow)) {
                alert('<?php echo __('File upload limit exceed', 'js-support-ticket'); ?>');
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
<span style="display:none" id="filesize"><?php echo __('Error file size too large', 'js-support-ticket'); ?></span>
<span style="display:none" id="fileext"><?php echo __('Error file ext mismatch', 'js-support-ticket'); ?></span>
<span class="js-admin-title"><?php echo __('Add Ticket', 'js-support-ticket'); ?></span>
<div id="userpopupblack" style="display:none;"></div>
<div id="userpopup" style="display:none;">
    <div class="js-row">
        <form id="userpopupsearch">
            <div class="search-center">
                <div class="search-center-heading"><?php echo __('Select user', 'js-support-ticket'); ?><span class="close"></span></div>
                <div class="js-col-md-12">
                    <div class="js-col-xs-12 js-col-md-3 js-search-value">
                        <input type="text" name="username" id="username" placeholder="<?php echo __('Username', 'js-support-ticket'); ?>" />
                    </div>
                    <div class="js-col-xs-12 js-col-md-3 js-search-value">
                        <input type="text" name="name" id="name" placeholder="<?php echo __('Name', 'js-support-ticket'); ?>" />
                    </div>
                    <div class="js-col-xs-12 js-col-md-3 js-search-value">
                        <input type="text" name="emailaddress" id="emailaddress" placeholder="<?php echo __('Email Address', 'js-support-ticket'); ?>"/>
                    </div>
                    <div class="js-col-xs-12 js-col-md-3 js-search-value-button">
                        <div class="js-button">
                            <input type="submit" value="<?php echo __('Search', 'js-support-ticket'); ?>" />
                        </div>
                        <div class="js-button">
                            <input type="submit" onclick="document.getElementById('name').value = '';
                                    document.getElementById('username').value = '';
                                    document.getElementById('emailaddress').value = '';" value="<?php echo __('Reset', 'js-support-ticket'); ?>" />
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div id="records">
        <div id="records-inner">
            <div class="js-staff-searc-desc">
                <?php echo __('Use Search Feature To Select The User', 'js-support-ticket'); ?>
            </div>
        </div>    
    </div>          
</div>

<form method="post" action="<?php echo admin_url("admin.php?page=ticket&task=saveticket"); ?>" id="adminTicketform" enctype="multipart/form-data">
    <?php
    $i = '';
    foreach (jssupportticket::$_data['fieldordering'] AS $field):
        switch ($field->field) {
            case 'users':
                ?>
                <div class="js-form-wrapper">
                    <div class="js-form-title"><?php echo __('Username', 'js-support-ticket'); ?><?php if ($field->required == 1) echo '&nbsp;<font color="red">*</font>'; ?></div>
                    <div class="js-form-value">
                        <?php if (isset(jssupportticket::$_data[0]->uid)) { ?>
                            <input type="text" id="username-text" name="username-text" value="<?php if (isset($formdata['username-text']))
                    echo $formdata['username-text'];
                else
                    echo jssupportticket::$_data[0]->user_login;
                            ?>" readonly="readonly" <?php if ($field->required == 1) echo 'data-validation="required"'; ?>/><div id="username-div"></div>
                        <?php } else {
                            ?>
                            <input type="text" value="<?php if (isset($formdata['username-text'])) echo $formdata['username-text']; ?>" id="username-text" name="username-text" readonly="readonly" <?php if ($field->required == 1) echo 'data-validation="required"'; ?>/><a href="#" id="userpopup"><?php echo __('Select User', 'js-support-ticket'); ?></a><div id="username-div"></div>
                <?php
            }
            ?>              
                    </div>
                </div>
                <?php
                break;
            case 'email':
                ?>
                <div class="js-form-wrapper">
                    <div class="js-form-title"><?php echo __('Email', 'js-support-ticket'); ?>&nbsp;<font color="red">*</font></div>
                    <div class="js-form-field">
                        <?php
                        if (isset($formdata['email']))
                            $email = $formdata['email'];
                        elseif (isset(jssupportticket::$_data[0]->email))
                            $email = jssupportticket::$_data[0]->email;
                        else
                            $email = $loginuser_email;
                        echo JSSTformfield::text('email', $email, array('class' => 'inputbox', 'data-validation' => 'email'));
                        ?>
                    </div>
                </div>
                <?php
                break;
            case 'fullname':
                ?>
                <div class="js-form-wrapper">
                    <div class="js-form-title"><?php echo __('Full Name', 'js-support-ticket'); ?>&nbsp;<font color="red">*</font></div>
                    <div class="js-form-field">
                        <?php
                        if (isset($formdata['name']))
                            $name = $formdata['name'];
                        elseif (isset(jssupportticket::$_data[0]->name))
                            $name = jssupportticket::$_data[0]->name;
                        else
                            $name = $loginuser_name;
                        echo JSSTformfield::text('name', $name, array('class' => 'inputbox', 'data-validation' => 'required'));
                        ?>
                    </div>
                </div>
                <?php
                break;
            case 'phone':
                ?>
                <div class="js-form-wrapper">
                    <div class="js-form-title"><?php echo __('Phone No', 'js-support-ticket'); ?><?php if ($field->required == 1) echo '&nbsp;<font color="red">*</font>'; ?></div>
                    <div class="js-form-field">
                        <?php
                        if (isset($formdata['phone']))
                            $phone = $formdata['phone'];
                        elseif (isset(jssupportticket::$_data[0]->phone))
                            $phone = jssupportticket::$_data[0]->phone;
                        else
                            $phone = '';
                        echo JSSTformfield::text('phone', $phone, array('class' => 'inputbox', 'data-validation' => ($field->required) ? 'required' : ''));
                        ?>
                    </div>
                </div>
                <div class="js-form-wrapper">
                    <div class="js-form-title"><?php echo __('Phone Ext', 'js-support-ticket'); ?></div>
                    <div class="js-form-field">
                        <?php
                        if (isset($formdata['phoneext']))
                            $phoneext = $formdata['phoneext'];
                        elseif (isset(jssupportticket::$_data[0]->phoneext))
                            $phoneext = jssupportticket::$_data[0]->phoneext;
                        else
                            $phoneext = '';
                        echo JSSTformfield::text('phoneext', $phoneext, array('class' => 'inputbox'));
                        ?>
                    </div>
                </div>
                <?php
                break;
            case 'department':
                ?>
                <div class="js-form-wrapper">
                    <div class="js-form-title"><?php echo __('Department', 'js-support-ticket'); ?><?php if ($field->required == 1) echo '&nbsp;<font color="red">*</font>'; ?></div>
                    <div class="js-form-field">
                        <?php
                        if (isset($formdata['departmentid']))
                            $departmentid = $formdata['departmentid'];
                        elseif (isset(jssupportticket::$_data[0]->departmentid))
                            $departmentid = jssupportticket::$_data[0]->departmentid;
                        else
                            $departmentid = '';
                        echo JSSTformfield::select('departmentid', JSSTincluder::getJSModel('department')->getDepartmentForCombobox(), $departmentid, __('Select Department', 'js-support-ticket'), array('class' => 'inputbox', 'onchange' => 'getHelpTopicByDepartment(this.value);', 'data-validation' => ($field->required) ? 'required' : ''));
                        ?>
                    </div>
                </div>
                <?php
                break;
            case 'priority':
                ?>
                <div class="js-form-wrapper">
                    <div class="js-form-title"><?php echo __('Priority', 'js-support-ticket'); ?>&nbsp;<font color="red">*</font></div>
                    <div class="js-form-field">
                        <?php
                        if (isset($formdata['priorityid']))
                            $priorityid = $formdata['priorityid'];
                        elseif (isset(jssupportticket::$_data[0]->priorityid))
                            $priorityid = jssupportticket::$_data[0]->priorityid;
                        else
                            $priorityid = JSSTincluder::getJSModel('priority')->getDefaultPriorityID();
                        echo JSSTformfield::select('priorityid', JSSTincluder::getJSModel('priority')->getPriorityForCombobox(), $priorityid, __('Select Priority', 'js-support-ticket'), array('class' => 'inputbox', 'data-validation' => 'required'));
                        ?>
                    </div>
                </div>
                <?php
                break;
            case 'status':
                ?>
                <div class="js-form-wrapper">
                    <div class="js-form-title"><?php echo __('Status', 'js-support-ticket'); ?><?php if ($field->required == 1) echo '&nbsp;<font color="red">*</font>'; ?></div>
                    <div class="js-form-field">
                        <?php
                        if (isset($formdata['status']))
                            $status = $formdata['status'];
                        elseif (isset(jssupportticket::$_data[0]->status))
                            $status = jssupportticket::$_data[0]->status;
                        else
                            $status = '1';
                        echo JSSTformfield::select('status', array((Object) array('id' => '0', 'text' => __('Active', 'js-support-ticket')), (Object) array('id' => '', 'text' => __('Disabled', 'js-support-ticket')), (Object) array('id' => '2', 'text' => __('Waiting admin reply', 'js-support-ticket')), (Object) array('id' => '3', 'text' => __('Waiting customer reply', 'js-support-ticket')), (Object) array('id' => '4', 'text' => __('Close ticket', 'js-support-ticket'))), $status, __('Select Status', 'js-support-ticket'), array('class' => 'radiobutton', 'data-validation' => ($field->required) ? 'required' : ''));
                        ?>
                    </div>
                </div>
                <?php
                break;
            case 'subject':
                ?>
                <div class="js-form-wrapper">
                    <div class="js-form-title"><?php echo __('Subject', 'js-support-ticket'); ?>&nbsp;<font color="red">*</font></div>
                    <div class="js-form-field">
                        <?php
                        if (isset($formdata['subject']))
                            $subject = $formdata['subject'];
                        elseif (isset(jssupportticket::$_data[0]->subject))
                            $subject = jssupportticket::$_data[0]->subject;
                        else
                            $subject = '';
                        echo JSSTformfield::text('subject', $subject, array('class' => 'inputbox', 'data-validation' => 'required', 'style' => 'width:100%;'));
                        ?>
                    </div>
                </div>
                <?php
                break;
            case 'issuesummary':
                ?>
                <div class="js-form-wrapper">
                    <div class="js-form-title"><?php echo __('Issue Summary', 'js-support-ticket'); ?>&nbsp;<font color="red">*</font></div>
                    <div class="js-form-field">
                        <?php
                        if (isset($formdata['message']))
                            $message = wpautop(wptexturize(stripslashes($formdata['message'])));
                        elseif (isset(jssupportticket::$_data[0]->message))
                            $message = jssupportticket::$_data[0]->message;
                        else
                            $message = '';
                        echo wp_editor($message, 'jsticket_message', array('media_buttons' => false));
                        ?>
                    </div>
                </div>
                <?php
                break;
            case 'attachments':
                ?>
                <div class="js-col-md-12 js-form-wrapper">
                    <div class="js-form-title"><?php echo __('Attachments', 'js-support-ticket'); ?><?php if ($field->required == 1) echo '&nbsp;<font color="red">*</font>'; ?></div>
                    <div class="js-form-field">
                        <div class="tk_attachment_value_wrapperform">
                            <span class="tk_attachment_value_text">
                                <input type="file" class="inputbox" name="filename[]" onchange="uploadfile(this, '<?php echo jssupportticket::$_config['file_maximum_size']; ?>', '<?php echo jssupportticket::$_config['file_extension']; ?>');" size="20" maxlenght='30'data-validation="<?php echo ($field->required == 1) ? 'required' : ''; ?>" />
                                <span class='tk_attachment_remove'></span>
                            </span>
                        </div>
                        <span class="tk_attachments_configform">
                            <small><?php echo __('Maximum File Size', 'js-support-ticket');
                echo ' (' . jssupportticket::$_config['file_maximum_size'];
                ?>KB)<br>
                        <?php echo __('File Extension Type', 'js-support-ticket');
                        echo ' (' . jssupportticket::$_config['file_extension'] . ')';
                        ?></small>
                        </span>
                        <span id="tk_attachment_add" class="tk_attachments_addform"><?php echo __('Add More File', 'js-support-ticket'); ?></span>
                        <?php
                        if (!empty(jssupportticket::$_data[5])) {
                            foreach (jssupportticket::$_data[5] AS $attachment) {
                                $ticketidattachment = isset(jssupportticket::$_data[0]->id) ? jssupportticket::$_data[0]->id : '';
                                echo '
                                            <div class="js_ticketattachment">
                                                    ' . $attachment->filename . ' ( ' . $attachment->filesize . ' ) ' . '
                                                    <a href="?page=attachment&task=deleteattachment&action=jstask&id=' . $attachment->id . '&ticketid=' . $ticketidattachment . '">' . __('Delete attachment', 'js-support-ticket') . '</a>
                                            </div>';
                            }
                        }
                        ?>
                    </div>
                </div>
                <?php
                break;
            default:
                ?>
                <?php
                if (isset(jssupportticket::$_data[3]))
                    foreach (jssupportticket::$_data[3] as $ufield) {
                        $userfeild = $ufield[0];
                        if ($field->field == $userfeild->id) {
                            $i++;
                            echo '<div class="js-form-wrapper">
                                        <div class="js-form-title">';
                            if ($field->required == 1) {
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
                                        <div class="js-form-field">';
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
                                    echo '<input type="text" id="userfeilds_' . $i . '" name="userfeilds_' . $i . '" size="' . $userfeild->size . '" value="' . $fvalue . '" ' . $cssclass . $maxlength . $readonly . $required . ' />';
                                    break;
                                case 'email':
                                    echo '<input type="text" id="userfeilds_' . $i . '" name="userfeilds_' . $i . '" size="' . $userfeild->size . '" value="' . $fvalue . '" ' . $cssclass . $maxlength . $readonly . $required . ' data-validation="email" />';
                                    break;
                                case 'date':
                                    $userfeildid = 'userfeilds_' . $i;
                                    $userfeildid = "'" . $userfeildid . "'";
                                    echo JSSTformfield::text('userfeilds_' . $i, $fvalue, array('class' => 'custom_date'));
                                    break;
                                case 'textarea':
                                    echo '<textarea name="userfeilds_' . $i . '" id="userfeilds_' . $i . '_field" cols="' . $userfeild->cols . '" rows="' . $userfeild->rows . '" ' . $readonly . $required . '>' . $fvalue . '</textarea>';
                                    break;
                                case 'checkbox':
                                    echo '<input type="checkbox" name="userfeilds_' . $i . '" id="userfeilds_' . $i . '_field" value="1" ' . 'checked="checked"' . '/>';
                                    break;
                                case 'select':
                                    $htm = '<select name="userfeilds_' . $i . '" id="userfeilds_' . $i . '" ' . $required . '>';
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
                        }
                    }
                ?>
                <?php
                break;
                ?>                        
            <?php
        }
    endforeach;
    echo '<input type="hidden" id="userfeilds_total" name="userfeilds_total"  value="' . $i . '"  />';
    ?>
    <?php echo JSSTformfield::hidden('id', isset(jssupportticket::$_data[0]->id) ? jssupportticket::$_data[0]->id : '') ?>
    <?php echo JSSTformfield::hidden('ticketid', isset(jssupportticket::$_data[0]->ticketid) ? jssupportticket::$_data[0]->ticketid : ''); ?>
    <?php echo JSSTformfield::hidden('created', isset(jssupportticket::$_data[0]->created) ? jssupportticket::$_data[0]->created : ''); ?>
    <?php echo JSSTformfield::hidden('lastreply', isset(jssupportticket::$_data[0]->lastreply) ? jssupportticket::$_data[0]->lastreply : ''); ?>
    <?php
    if (isset(jssupportticket::$_data[0]->uid))
        $uid = jssupportticket::$_data[0]->uid;
    else
        $uid = get_current_user_id();
    echo JSSTformfield::hidden('uid', $uid);
    ?>
<?php echo JSSTformfield::hidden('updated', isset(jssupportticket::$_data[0]->updated) ? jssupportticket::$_data[0]->updated : '' ); ?>
<?php echo JSSTformfield::hidden('action', 'ticket_saveticket'); ?>
<?php echo JSSTformfield::hidden('form_request', 'jssupportticket'); ?>
    <div class="js-form-button">
<?php echo JSSTformfield::submitbutton('save', __('Save Ticket', 'js-support-ticket'), array('class' => 'button')); ?>
    </div>
</form>	
