<?php
if( get_current_user_id() != 0 ){
	wp_enqueue_script('colorpicker.js',jssupportticket::$_pluginpath.'includes/js/colorpicker.js');
	wp_enqueue_style('colorpicker', jssupportticket::$_pluginpath.'includes/css/colorpicker.css');
	wp_enqueue_style('jquery-ui-css', jssupportticket::$_pluginpath.'includes/css/jquery-ui.css');
	wp_enqueue_script('formvalidate.js',jssupportticket::$_pluginpath.'includes/js/jquery.form-validator.js');
?>
<script type="text/javascript">
	jQuery(document).ready(function($){$.validate();})
</script>
<span class="js-admin-title"><?php echo __('ADD_NEW_PRIORITY','js-support-ticket'); ?></span>
<form method="post" action="<?php echo admin_url("?page=priority_priorities&task=priority_savepriority&action=admin_savepriority"); ?>">
		<div class="js-form-wrapper">
			<div class="js-form-title"><?php echo __('PRIORITY','js-support-ticket'); ?></div>
			<div class="js-form-field"><?php echo formfield::text('priority',isset(jssupportticket::$_data[0]->priority) ? jssupportticket::$_data[0]->priority : '',array('class'=>'inputbox','data-validation'=>'required')) ?></div>
		</div>
		<div class="js-form-wrapper">
			<div class="js-form-title"><?php echo __('PRIORITY_COLOR','js-support-ticket'); ?></div>
			<div class="js-form-field"><?php echo formfield::text('prioritycolor',isset(jssupportticket::$_data[0]->prioritycolour) ? jssupportticket::$_data[0]->prioritycolour : '',array('class'=>'inputbox','data-validation'=>'required'));?></div>
		</div>
		<div class="js-form-wrapper">
			<div class="js-form-title"><?php echo __('PRIORITY_URGENCY','js-support-ticket'); ?></div>
			<div class="js-form-field"><?php echo formfield::text('priorityurgency',isset(jssupportticket::$_data[0]->priorityurgency) ? jssupportticket::$_data[0]->priorityurgency : '',array('class'=>'inputbox'));?></div>
		</div>
		<div class="js-form-wrapper">
			<div class="js-form-title"><?php echo __('IS_PUBLIC','js-support-ticket'); ?></div>
			<div class="js-form-field"><?php echo formfield::radiobutton('ispublic',array('1'=>__('YES','js-support-ticket'),'2'=>__('NO','js-support-ticket')),isset(jssupportticket::$_data[0]->ispublic) ? jssupportticket::$_data[0]->ispublic : '',array('class'=>'radiobutton','data-validation'=>'required'));?></div>
		</div>
		<div class="js-form-wrapper">
			<div class="js-form-title"><?php echo __('IS_DEFAULT','js-support-ticket'); ?></div>
			<div class="js-form-field"><?php echo formfield::radiobutton('isdefault',array('1'=>__('YES','js-support-ticket'),'2'=>__('NO','js-support-ticket')),isset(jssupportticket::$_data[0]->isdefault) ? jssupportticket::$_data[0]->isdefault : '',array('class'=>'radiobutton','data-validation'=>'required'));?></div>
		</div>
		<div class="js-form-wrapper">
			<div class="js-form-title"><?php echo __('STATUS','js-support-ticket'); ?></div>
			<div class="js-form-field"><?php echo formfield::radiobutton('status',array('1'=>__('APPROVED','js-support-ticket'),'2'=>__('NOT_APPROVED','js-support-ticket')),isset(jssupportticket::$_data[0]->status) ? jssupportticket::$_data[0]->status : '',array('class'=>'radiobutton','data-validation'=>'required'));?></div>
		</div>
	<?php echo formfield::hidden('id',isset(jssupportticket::$_data[0]->id) ? jssupportticket::$_data[0]->id : ''); ?>
	<?php echo formfield::hidden('action','priority_savepriority'); ?>
	<?php echo formfield::hidden('form_request','jssupportticket'); ?>
	<?php echo formfield::hidden('uid',get_current_user_id()); ?>
	<div class="js-form-button">
		<?php echo formfield::submitbutton('save',__('SAVE_PRIORITY','js-support-ticket'),array('class'=>'button')); ?>
	</div>	
</form>
<script type="text/javascript">
	jQuery(document).ready(function(){
	    jQuery('input#prioritycolor').ColorPicker({
	        color: jQuery('input#prioritycolor').val(),
	        onShow: function (colpkr) { jQuery(colpkr).fadeIn(500); return false; },
	        onHide: function (colpkr) { jQuery(colpkr).fadeOut(500); return false; },
	        onChange: function (hsb, hex, rgb) {
	            jQuery('input#prioritycolor').css('backgroundColor', '#' + hex).val('#' + hex);
	        }
	    });
	});
	
</script>		
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
