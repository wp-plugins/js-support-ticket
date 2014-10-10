<?php
	if( get_current_user_id() != 0 ){
	wp_enqueue_style('jquery-ui-css', jssupportticket::$_pluginpath.'includes/css/jquery-ui.css');
	wp_enqueue_script('formvalidate.js',jssupportticket::$_pluginpath.'includes/js/jquery.form-validator.js');
?>
<script type="text/javascript">
	jQuery(document).ready(function($){$.validate();})
</script>
<span class="js-admin-title"><?php echo __('ADD_NEW_SYSTEM_EMAIL','js-support-ticket'); ?></span>
<form method="post" action="<?php echo admin_url("?page=email_emails&task=email_saveemail&action=admin_saveemail"); ?>">
	<div class="js-form-wrapper">
		<div class="js-form-title"><?php echo __('EMAIL','js-support-ticket'); ?></div>
		<div class="js-form-field"><?php echo formfield::text('email',isset(jssupportticket::$_data[0]->email) ? jssupportticket::$_data[0]->email : '',array('class'=>'inputbox','data-validation'=>'required')) ?></div>
	</div>
	<div class="js-form-wrapper">
		<div class="js-form-title"><?php echo __('PRIORITY','js-support-ticket'); ?></div>
		<div class="js-form-field"><?php echo formfield::select('priority',includer::getJSModel('priority')->getPriorityForCombobox(),isset(jssupportticket::$_data[0]->priorityid) ? jssupportticket::$_data[0]->priorityid : includer::getJSModel('priority')->getDefaultPriorityId(),__('SELECT_PRIORITY','js-support-ticket'),array('class'=>'inputbox','data-validation'=>'required'));?></div>
	</div>
	<div class="js-form-wrapper">
		<div class="js-form-title"><?php echo __('AUTO_RESPONSE','js-support-ticket'); ?></div>
		<div class="js-form-field"><?php echo formfield::radiobutton('autoresponse',array('1'=>__('YES','js-support-ticket'),'2'=>__('NO','js-support-ticket')),isset(jssupportticket::$_data[0]->autoresponse) ? jssupportticket::$_data[0]->autoresponse : '',array('class'=>'radiobutton','data-validation'=>'required'));?></div>
	</div>
	<div class="js-form-wrapper">
		<div class="js-form-title"><?php echo __('STATUS','js-support-ticket'); ?></div>
		<div class="js-form-field"><?php echo formfield::radiobutton('status',array('1'=>__('ACTIVE','js-support-ticket'),'2'=>__('DISABLED','js-support-ticket')),isset(jssupportticket::$_data[0]->status) ? jssupportticket::$_data[0]->status : '',array('class'=>'radiobutton','data-validation'=>'required'));?></div>
	</div>
	<?php echo formfield::hidden('id',isset(jssupportticket::$_data[0]->id) ? jssupportticket::$_data[0]->id : ''); ?>
	<?php echo formfield::hidden('created',isset(jssupportticket::$_data[0]->created) ? jssupportticket::$_data[0]->created : ''); ?>
	<?php echo formfield::hidden('updated',isset(jssupportticket::$_data[0]->updated) ? jssupportticket::$_data[0]->updated : ''); ?>
	<?php echo formfield::hidden('action','email_saveemail'); ?>
	<?php echo formfield::hidden('form_request','jssupportticket'); ?>
	<div class="js-form-button">
		<?php echo formfield::submitbutton('save',__('SAVE_EMAIL','js-support-ticket'),array('class'=>'button')); ?>
	</div>			
</form>
<?php }else { ?>
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
} ?>
