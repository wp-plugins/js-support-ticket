<?php wp_enqueue_script('formvalidate.js', jssupportticket::$_pluginpath . 'includes/js/jquery.form-validator.js'); ?>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $.validate();
    });
</script>
<script type="text/javascript">
    function getObject(obj) {
        var strObj;
        if (document.all) {
            strObj = document.all.item(obj);
        } else if (document.getElementById) {
            strObj = document.getElementById(obj);
        }
        return strObj;
    }

    function insertRow() {
        var oTable = getObject("fieldValuesBody");
        var oRow, oCell, oCellCont, oInput;
        var i, j;
        i = jQuery("#valueCount").val();
        i++;
        // Create and insert rows and cells into the first body.
        oRow = document.createElement("TR");
        jQuery(oRow).attr('id', "jstickets_trcust" + i);
        oTable.appendChild(oRow);

        oCell = document.createElement("TD");
        oInput = document.createElement("INPUT");
        oInput.name = "jsNames[" + i + "]";
        oInput.setAttribute('id', "jsNames_" + i);
        oCell.appendChild(oInput);
        oRow.appendChild(oCell);

        oCell = document.createElement("TD");
        oInput = document.createElement("INPUT");
        oInput.name = "jsValues[" + i + "]";
        oInput.setAttribute('id', "jsValues_" + i);
        oCell.appendChild(oInput);

        oSpan = document.createElement("SPAN");
        oSpan.setAttribute('style', "float:right;padding:4px;background:#b31212;");
        jQuery(oSpan).click(function () {
            jQuery('#jstickets_trcust' + i).remove();
            jQuery("#valueCount").val(jQuery("#valueCount").val() - 1);
        });
        oCell.appendChild(oSpan);
        oRow.appendChild(oCell);
        oInput.focus();
        jQuery("#valueCount").val(i);
    }

    function disableAll() {
        jQuery("#divValues").slideUp();
        jQuery("#divColsRows").slideUp();
        jQuery("#divText").slideUp();
    }
    function toggleType(type) {
        disableAll();
        setTimeout('selType( \'' + type + '\' )', 650);
    }
    function selType(sType) {
        var elem;

        switch (sType) {
            case 'editorta':
            case 'textarea':
                jQuery("#divText").slideDown();
                jQuery("#divColsRows").slideDown();
                break;
            case 'emailaddress':
            case 'password':
            case 'text':
                jQuery("#divText").slideDown();
                break;
            case 'select':
            case 'multiselect':
                jQuery("#divValues").slideDown();
                break;
            case 'radio':
            case 'multicheckbox':
                jQuery("#divColsRows").slideDown();
                jQuery("#divValues").slideDown();
                break;
            case 'delimiter':
            default:

        }
    }

    jQuery(document).ready(function () {
        toggleType(jQuery('#type').val());
    });
    jQuery("span.jquery_span_closetr").each(function () {
        var span = jQuery(this);
        jQuery(span).click(function () {
            var span_current = jQuery(this);
            if (jQuery(span_current).attr('data-optionid') != 'undefined') {
                jQuery.post("index.php?option=com_jstickets&c=tickets&task=deleteuserfieldoption", {id: jQuery(span_current).attr('data-optionid')}, function (data) {
                    if (data) {
                        var tr_id = jQuery(span_current).attr('data-rowid');
                        jQuery('#' + tr_id).remove();
                        document.adminForm.valueCount.value = document.adminForm.valueCount.value - 1;
                    } else {
                        alert('<?php echo __('Option value in use', 'js-support-ticket'); ?>');

                    }

                });
            } else {
                var tr_id = jQuery(span_current).attr('data-rowid');
                jQuery('#' + tr_id).remove();
                document.adminForm.valueCount.value = document.adminForm.valueCount.value - 1;
            }
        });
    });
</script>
<?php
$YesOrNo = array((object) array('id' => '1', 'text' => __('Yes', 'js-support-ticket')),
    (object) array('id' => '2', 'text' => __('No', 'js-support-ticket')));
$fieldtype = array((object) array('id' => 'text', 'text' => __('Text field', 'js-support-ticket')),
    (object) array('id' => 'select', 'text' => __('Drop down', 'js-support-ticket')),
    (object) array('id' => 'email', 'text' => __('Email Address', 'js-support-ticket')),
    (object) array('id' => 'checkbox', 'text' => __('Check box', 'js-support-ticket')),
    (object) array('id' => 'date', 'text' => __('Date', 'js-support-ticket')),
    (object) array('id' => 'textarea', 'text' => __('Text area', 'js-support-ticket'))
);
?>

<span class="js-admin-title"><?php echo __('Add User Field', 'js-support-ticket'); ?></span>
<form method="post" action="<?php echo admin_url("admin.php?page=userfeild&task=saveuserfeild"); ?>" id="adminForm">
    <div class="js-form-wrapper">
        <div class="js-form-title"><?php echo __('Field Type', 'js-support-ticket'); ?>&nbsp;<font color="red">*</font></div>
        <div class="js-form-field"><?php echo JSSTformfield::select('type', $fieldtype, isset(jssupportticket::$_data[0][0]->type) ? jssupportticket::$_data[0][0]->type : '', __('Select Type', 'js-support-ticket'), array('class' => 'inputbox', 'onchange' => 'toggleType(this.options[this.selectedIndex].value);', 'data-validation' => 'required')); ?></div>
        </div>
        <div class="js-form-wrapper">
            <div class="js-form-title"><?php echo __('Field Name', 'js-support-ticket'); ?>&nbsp;<font color="red">*</font></div>
            <div class="js-form-field"><?php echo JSSTformfield::text('name', isset(jssupportticket::$_data[0][0]->name) ? jssupportticket::$_data[0][0]->name : '', array('class' => 'inputbox', 'mosReq' => '1', 'mosLabel' => 'Name', 'data-validation' => 'required')); ?></div>
        </div>
        <div class="js-form-wrapper">
            <div class="js-form-title"><?php echo __('Field Title', 'js-support-ticket'); ?>&nbsp;<font color="red">*</font></div>
            <div class="js-form-field"><?php echo JSSTformfield::text('title', isset(jssupportticket::$_data[0][0]->title) ? jssupportticket::$_data[0][0]->title : '', array('class' => 'inputbox', 'data-validation' => 'required')); ?></td>
            </div>
            <div class="js-form-wrapper">
                <div class="js-form-title"><?php echo __('Required', 'js-support-ticket'); ?></div>
                <div class="js-form-field"><?php echo JSSTformfield::select('required', $YesOrNo, isset(jssupportticket::$_data[0][0]->required) ? jssupportticket::$_data[0][0]->required : '2', '', array('class' => 'inputbox')); ?></div>
            </div>
            <div class="js-form-wrapper">
                <div class="js-form-title"><?php echo __('Read Only', 'js-support-ticket'); ?></div>
                <div class="js-form-field"><?php echo JSSTformfield::select('readonly', $YesOrNo, isset(jssupportticket::$_data[0][0]->readonly) ? jssupportticket::$_data[0][0]->readonly : '2', '', array('class' => 'inputbox')); ?></div>
            </div>
            <div class="js-form-wrapper">
                <div class="js-form-title"><?php echo __('Published', 'js-support-ticket'); ?></div>
                <div class="js-form-field"><?php echo JSSTformfield::select('published', $YesOrNo, isset(jssupportticket::$_data[0][0]->published) ? jssupportticket::$_data[0][0]->published : '1', '', array('class' => 'inputbox')); ?></div>
            </div>
            <div class="js-form-wrapper">
                <div class="js-form-title"><?php echo __('Field Size', 'js-support-ticket'); ?></div>
                <div class="js-form-field"><?php echo JSSTformfield::text('size', isset(jssupportticket::$_data[0][0]->size) ? jssupportticket::$_data[0][0]->size : '', array('class' => 'inputbox')); ?></div>
            </div>
            <div id="page1"></div>
            <div id="divText">
                <div class="js-form-wrapper">
                    <div class="js-form-title"><?php echo __('Max Length', 'js-support-ticket'); ?></div>
                    <div class="js-form-field"><?php echo JSSTformfield::text('maxlength', isset(jssupportticket::$_data[0][0]->maxlenth) ? jssupportticket::$_data[0][0]->maxlenth : '', array('class' => 'inputbox')); ?></div>
                </div>
            </div>
            <div id="divColsRows">
                <div class="js-form-wrapper">
                    <div class="js-form-title"><?php echo __('Columns', 'js-support-ticket'); ?></div>
                    <div class="js-form-field"><?php echo JSSTformfield::text('cols', isset(jssupportticket::$_data[0][0]->cols) ? jssupportticket::$_data[0][0]->cols : '', array('class' => 'inputbox')); ?></div>
                </div>
                <div class="js-form-wrapper">
                    <div class="js-form-title"><?php echo __('Rows', 'js-support-ticket'); ?></div>
                    <div class="js-form-field"><?php echo JSSTformfield::text('rows', isset(jssupportticket::$_data[0][0]->rows) ? jssupportticket::$_data[0][0]->rows : '', array('class' => 'inputbox')); ?></div>
                </div>
            </div>
            <div id="divValues">
                <div><?php echo __('Use the table below to add new values', 'js-support-ticket'); ?></div>
                <input type="button" class="button" onclick="insertRow();" value="<?php echo __('Add a value', 'js-support-ticket'); ?>" />
                <table align=left id="divFieldValues" cellpadding="4" cellspacing="1" border="0" width="100%" class="adminform" >
                    <thead>
                    <th class="title" width="20%"><?php echo __('Title', 'js-support-ticket'); ?></th>
                    <th class="title" width="80%"><?php echo __('Value', 'js-support-ticket'); ?></th>
                    </thead>
                    <tbody id="fieldValuesBody">
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                        <?php
                        $i = 0;
                        if (isset(jssupportticket::$_data[0][0])) {
                            if (jssupportticket::$_data[0][0]->type == 'select') {
                                foreach (jssupportticket::$_data[1] as $value) {
                                    ?>
                                    <tr id="jstickets_trcust<?php echo $i; ?>">
                                <input type="hidden" value="<?php echo $value->id; ?>" name="jsIds[<?php echo $i; ?>]" />
                                <td width="20%"><input type="text" value="<?php echo $value->fieldtitle; ?>" name="jsNames[<?php echo $i; ?>]" /></td>
                                <td >
                                    <input type="text" value="<?php echo $value->fieldvalue; ?>" name="jsValues[<?php echo $i; ?>]" />
                                    <span class="jquery_span_closetr" data-rowid="jstickets_trcust<?php echo $i; ?>" data-optionid="<?php echo $value->id; ?>" style="float:right;padding:4px;background:#b31212;" ></span>
                                </td>

                                </tr>
                                <?php
                                $i++;
                            }
                            $i--;
                        }
                    } else {
                        ?>
                        <tr id="jsjobs_trcust0">
                            <td width="20%"><input type="text" value="" name="jsNames[0]" /></td>
                            <td >
                                <input type="text" value="" name="jsValues[0]" />
                                <span class="jquery_span_closetr" data-rowid="jstickets_trcust0" style="float:right;padding:4px;width:1%;background:#b31212;" ></span>  
                            </td>
                        </tr>
<?php } ?>
                    </tbody>
                </table>
            </div>
            <table class="adminform">
                <tr>
                    <td colspan="3">&nbsp;</td>
                </tr>

            </table>
            <?php echo JSSTformfield::hidden('id', isset(jssupportticket::$_data[0][0]->id) ? jssupportticket::$_data[0][0]->id : '' ); ?>
            <?php echo JSSTformfield::hidden('valueCount', $i); ?>
            <?php echo JSSTformfield::hidden('fieldfor', 1); ?>
                <?php echo JSSTformfield::hidden('action', 'userfeild_saveuserfeild'); ?>
                <?php echo JSSTformfield::hidden('form_request', 'jssupportticket'); ?>
            <div class="js-form-button">
<?php echo JSSTformfield::submitbutton('save', __('Save User Field', 'js-support-ticket'), array('class' => 'button')); ?>
            </div>
            </form>

            </table>
