<?php
if( get_current_user_id() != 0 ){
	wp_enqueue_script('jquery-ui-datepicker');
	wp_enqueue_script('file_validate.js',jssupportticket::$_pluginpath.'includes/js/file_validate.js');
	wp_enqueue_style('jquery-ui-css', jssupportticket::$_pluginpath.'includes/css/jquery-ui.css');
	wp_enqueue_script('formvalidate.js',jssupportticket::$_pluginpath.'includes/js/jquery.form-validator.js');
?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('.custom_date').datepicker({
			dateFormat : 'yy-mm-dd'
		});
	    jQuery("#tk_attachment_add").click(function(){
	        var obj=this;
	        var current_files=jQuery('input[type="file"]').length;
	        var total_allow=<?php echo jssupportticket::$_config['no_of_attachement']; ?>;
	        var append_text="<span class='tk_attachment_value_text'><input name='filename[]' type='file' onchange=\"uploadfile(this,'<?php echo jssupportticket::$_config['file_maximum_size']; ?>','<?php echo jssupportticket::$_config['file_extension']; ?>');\" size='20' maxlenght='30'  /><span  class='tk_attachment_remove'></span></span>";
	        if(current_files < total_allow ){
	            jQuery(".tk_attachment_value_wrapperform").append(append_text);
	        }else if((current_files === total_allow) || (current_files > total_allow)){
	            alert('<?php echo __('FILE_UPLOAD_LIMIT_EXCEED','js-support-ticket'); ?>');
	            obj.hide();
	        }
	    });
	    jQuery( document ).delegate( ".tk_attachment_remove", "click", function( e ) {
	        jQuery(this).parent().remove();
	        var current_files=jQuery('input[type="file"]').length;
	        var total_allow=<?php echo jssupportticket::$_config['no_of_attachement']; ?>;
	        if(current_files < total_allow ){
	            jQuery("#tk_attachment_add").show();
	        }
	    });
	    $.validate();
	});
</script>
<span style="display:none" id="filesize"><?php echo __('ERROR_FILE_SIZE_TO_LARGE','js-support-ticket');?></span>
<span style="display:none" id="fileext"><?php echo __('ERROR_FILE_EXT_MISMATCH','js-support-ticket');?></span>

<span class="js-admin-title"><?php echo __('ADD_NEW_TICKET','js-support-ticket'); ?></span>
<form method="post" action="<?php echo admin_url("?page=ticket_tickets&task=ticket_saveticket&action=admin_saveticket"); ?>" id="adminTicketform" enctype="multipart/form-data">
	<div class="js-form-wrapper">
		<div class="js-form-title"><?php echo __('EMAIL','js-support-ticket'); ?></div>
		<div class="js-form-field"><?php echo formfield::text('email',isset(jssupportticket::$_data[0]->email) ? jssupportticket::$_data[0]->email : '',array('class'=>'inputbox','data-validation'=>'email')) ?></div>
	</div>
	<div class="js-form-wrapper">
		<div class="js-form-title"><?php echo __('FULL_NAME','js-support-ticket'); ?></div>
		<div class="js-form-field"><?php echo formfield::text('name',isset(jssupportticket::$_data[0]->name) ? jssupportticket::$_data[0]->name : '',array('class'=>'inputbox','data-validation'=>'required')) ?></div>
	</div>
	<div class="js-form-wrapper">
		<div class="js-form-title"><?php echo __('PHONE_NOE','js-support-ticket'); ?></div>
		<div class="js-form-field"><?php echo formfield::text('phone',isset(jssupportticket::$_data[0]->phone) ? jssupportticket::$_data[0]->phone : '',array('class'=>'inputbox')) ?></div>
	</div>
	<div class="js-form-wrapper">
		<div class="js-form-title"><?php echo __('PHONE_EXT','js-support-ticket'); ?></div>
		<div class="js-form-field"><?php echo formfield::text('phoneext',isset(jssupportticket::$_data[0]->phoneext) ? jssupportticket::$_data[0]->phoneext : '',array('class'=>'inputbox')) ?></div>
	</div>
	<div class="js-form-wrapper">
		<div class="js-form-title"><?php echo __('DEPARTMENT','js-support-ticket'); ?></div>
		<div class="js-form-field"><?php echo formfield::select('departmentid',includer::getJSModel('department')->getDepartmentForCombobox(),isset(jssupportticket::$_data[0]->departmentid) ? jssupportticket::$_data[0]->departmentid : '',__('SELECT_DEPARTMENT','js-support-ticket'),array('class'=>'inputbox'));?></div>
	</div>
	<div class="js-form-wrapper">
		<div class="js-form-title"><?php echo __('PRIORITY','js-support-ticket'); ?></div>
		<div class="js-form-field"><?php echo formfield::select('priorityid',includer::getJSModel('priority')->getPriorityForCombobox(),isset(jssupportticket::$_data[0]->priorityid) ? jssupportticket::$_data[0]->priorityid : includer::getJSModel('priority')->getDefaultPriorityId(),__('SELECT_PRIORITY','js-support-ticket'),array('class'=>'inputbox'));?></div>
	</div>
	<div class="js-form-wrapper">
		<div class="js-form-title"><?php echo __('SUBJECT','js-support-ticket'); ?></div>
		<div class="js-form-field"><?php echo formfield::text('subject',isset(jssupportticket::$_data[0]->subject) ? jssupportticket::$_data[0]->subject : '',array('class'=>'inputbox','data-validation'=>'required')) ?></div>
	</div>
	<div class="js-form-wrapper">
		<div class="js-form-title"><?php echo __('ISSUE_SUMMARY','js-support-ticket'); ?></div>
		<div class="js-form-field"><?php echo wp_editor(isset(jssupportticket::$_data[0]->message) ? jssupportticket::$_data[0]->message : '','message',array( 'media_buttons' => false ));?></div>
	</div>
	<div class="js-form-wrapper">
		<div class="js-form-title"><?php echo __('ATTACHMENTS','js-support-ticket'); ?></div>
		<div class="js-form-field">
	        <div class="tk_attachment_value_wrapperform">
	            <span class="tk_attachment_value_text">
	                <input type="file" class="inputbox" name="filename[]" onchange="uploadfile(this,'<?php echo jssupportticket::$_config['file_maximum_size']; ?>','<?php echo jssupportticket::$_config['file_extension']; ?>');" size="20" maxlenght='30'/>
	                <span class='tk_attachment_remove'></span>
	            </span>
	        </div>
	        <span class="tk_attachments_configform">
	            <small><?php echo __('MAXIMUM_FILE_SIZE','js-support-ticket'); echo ' ('.jssupportticket::$_config['file_maximum_size']; ?>KB)<br><?php echo __('FILE_EXTENSION_TYPE','js-support-ticket'); echo ' ('.jssupportticket::$_config['file_extension'].')'; ?></small>
	        </span>
	        <span id="tk_attachment_add" class="tk_attachments_addform"><?php echo __('ADD_MORE_FILE','js-support-ticket'); ?></span>
        	<?php 
        		if(!empty(jssupportticket::$_data[5])){
        			foreach(jssupportticket::$_data[5] AS $attachment){
        				echo '
        					<div class="js_ticketattachment">
        						'.$attachment->filename.' ( '.$attachment->filesize.' ) '.'
        						<a href="?page=attachment_attachments&task=attachment_deleteattachment&action=deleteitem&id='.$attachment->id.'&ticketid='.jssupportticket::$_data[0]->id.'">'._('DELETE_ATTACHMENT').'</a>
        					</div>';
        			}
        		}
        	?>
		</div>
	</div>
	<?php /*
	<div class="js-form-wrapper">
		<div class="js-form-title"><?php echo __('DUE_DATE','js-support-ticket'); ?></div>
		<div class="js-form-field"><?php echo formfield::text('duedate',jssupportticket::$_data[0]->duedate,array('class'=>'custom_date')); ?></div>
	</div>
	*/ ?>
	<div class="js-form-wrapper">
		<div class="js-form-title"><?php echo __('STATUS','js-support-ticket'); ?></div>
		<div class="js-form-field"><?php echo formfield::radiobutton('status',array('0'=>__('ACTIVE','js-support-ticket'),'4'=>__('DISABLED','js-support-ticket')),isset(jssupportticket::$_data[0]->status) ? jssupportticket::$_data[0]->status : 0,array('class'=>'radiobutton'));?></div>
	</div>
<?php
$i = 0;
 foreach( jssupportticket::$_data[3] as $ufield){ 
			$userfield = $ufield[0];
            $i++;
            echo '<div class="js-form-wrapper">
            		<div class="js-form-title">';
            			$required = 0;
			            if($userfield->required == 1){
			            	$required = 1;
		                    echo '<label id="'.$userfield->name.'"msg for="'.$userfield->name.'">'.$userfield->title.'</label>:&nbsp;<font color="red">*</font>';
		                    if($userfield->type == 'emailaddress') $cssclass = 'class ="inputbox required validate-email"';
		                    else $cssclass = 'class="inputbox required"';
			            }else{
		                    echo $userfield->title.":&nbsp;";
		                    if($userfield->type == 'emailaddress') $cssclass = 'class="inputbox validate-email"';
		                    else  $cssclass = 'class="inputbox"';
			            }
            echo '	</div>
            		<div class="js-form-field">';
	                    $readonly = $userfield->readonly ? ' readonly="readonly"' : '';
	                    $maxlength = $userfield->maxlength ? 'maxlength="'.$userfield->maxlength.'"' : '';
	                    if(isset($ufield[1])){ $fvalue = $ufield[1]->data; $userdataid = $ufield[1]->id;}  else {$fvalue=""; $userdataid = ""; }
	                    echo '<input type="hidden" id="userfields_'.$i.'_id" name="userfields_'.$i.'_id"  value="'.$userfield->id.'"  />';
	                    echo '<input type="hidden" id="userdata_'.$i.'_id" name="userdata_'.$i.'_id"  value="'.$userdataid.'"  />';
	                    switch( $userfield->type ) {
	                        case 'text':
	                        	if($required == 1)
	                        		$fieldrequired = 'data-validation="required"';
	                        	else
	                        		$fieldrequired = '';
                                echo '<input type="text" id="userfields_'.$i.'" '.$fieldrequired.' name="userfields_'.$i.'" size="'.$userfield->size.'" value="'. $fvalue .'" '.$cssclass .$maxlength . $readonly . ' />';
                            break;
	                        case 'emailaddress':
                                echo '<input type="text" data-validation="email" id="userfields_'.$i.'" name="userfields_'.$i.'" size="'.$userfield->size.'" value="'. $fvalue .'" '.$cssclass .$maxlength . $readonly . ' />';
                            break;
	                        case 'date':
                                $userfieldid = 'userfields_'.$i;
                                $userfieldid = "'".$userfieldid."'";
                                if($required == 1)
                                	echo formfield::text('userfields_'.$i,$fvalue,array('class'=>'custom_date','data-validation'=>'date'));
                            	else
                                	echo formfield::text('userfields_'.$i,$fvalue,array('class'=>'custom_date'));
                            break;
	                        case 'textarea':
	                        	if($required == 1)
	                        		$fieldrequired = 'data-validation="required"';
                                echo '<textarea name="userfields_'.$i.'" '.$fieldrequired.' id="userfields_'.$i.'_field" cols="'.$userfield->cols.'" rows="'.$userfield->rows.'" '.$readonly.'>'.$fvalue.'</textarea>';
                            break;
	                        case 'checkbox':
	                        	if($required == 1)
	                        		$fieldrequired = 'data-validation="required"';
                                echo '<input type="checkbox" '.$fieldrequired.' name="userfields_'.$i.'" id="userfields_'.$i.'_field" value="1" '.  'checked="checked"' .'/>';
                            break;
	                        case 'select':
	                        	if($required == 1)
	                        		$fieldrequired = 'data-validation="required"';
                                $htm = '<select name="userfields_'.$i.'" '.$fieldrequired.' id="userfields_'.$i.'" >';
                                if (isset ($ufield[2])){
                                        foreach($ufield[2] as $opt){
                                                if ($opt->id == $fvalue)
                                                        $htm .= '<option value="'.$opt->id.'" selected="yes">'. $opt->fieldtitle .' </option>';
                                                else
                                                        $htm .= '<option value="'.$opt->id.'">'. $opt->fieldtitle .' </option>';
                                        }
                                }
                                $htm .= '</select>';
                                echo $htm;
                            break;
                        }
            echo '	</div>
            	</div>';
}
        echo '<input type="hidden" id="userfields_total" name="userfields_total"  value="'.$i.'"  />';
      ?>
	<?php echo formfield::hidden('id',isset(jssupportticket::$_data[0]->id) ? jssupportticket::$_data[0]->id : ''); ?>
	<?php echo formfield::hidden('ticketid',isset(jssupportticket::$_data[0]->ticketid) ? jssupportticket::$_data[0]->ticketid : ''); ?>
	<?php echo formfield::hidden('created',isset(jssupportticket::$_data[0]->created) ? jssupportticket::$_data[0]->created : ''); ?>
	<?php echo formfield::hidden('lastreply',isset(jssupportticket::$_data[0]->lastreply) ? jssupportticket::$_data[0]->lastreply : ''); ?>
	<?php 
		if(isset(jssupportticket::$_data[0]->uid)) $uid = jssupportticket::$_data[0]->uid;
		else $uid = get_current_user_id();
		echo formfield::hidden('uid', $uid ); 
	?>
	<?php echo formfield::hidden('updated',isset(jssupportticket::$_data[0]->updated) ? jssupportticket::$_data[0]->updated : ''); ?>
	<?php echo formfield::hidden('action','ticket_saveticket'); ?>
	<?php echo formfield::hidden('form_request','jssupportticket'); ?>
	<div class="js-form-button">
		<?php echo formfield::submitbutton('save',__('SAVE_TICKET','js-support-ticket'),array('class'=>'button')); ?>
	</div>
</form>
		
<?php }else{ ?>
        <div class="js_job_error_messages_wrapper">
            <div class="js_job_messages_image_wrapper">
                <img class="js_job_messages_image" src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/errors/1.png"/>
            </div>
            <div class="js_job_messages_data_wrapper">
                <span class="js_job_messages_main_text">
                    <?php echo __('NOT_LOGIN','js-support-ticket'); ?>
                </span>
                <span class="js_job_messages_block_text">
                    <?php echo __('YOU_ARE_NOT_ALLOWED_TO_VIEW','js-support-ticket'); ?>
                </span>
            </div>
        </div>
<?php
}
?>
