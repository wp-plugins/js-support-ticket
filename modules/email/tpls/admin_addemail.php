<?php
	wp_enqueue_script('formvalidate.js',jssupportticket::$_pluginpath.'includes/js/jquery.form-validator.js');  
?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			$.validate();
		});
	</script>
	<span class="js-admin-title"><?php echo __('ADD_SYSTEM_EMAIL','js-support-ticket'); ?></span>
	<form method="post" action="<?php echo admin_url("?page=email&task=saveemail"); ?>">
		<div class="js-form-wrapper">
			<div class="js-form-title"><?php echo __('EMAIL','js-support-ticket'); ?>&nbsp;<font color="red">*</font></div>
			<div class="js-form-field"><?php echo JSSTformfield::text('email',isset(jssupportticket::$_data[0]->email ) ? jssupportticket::$_data[0]->email : '',array('class'=>'inputbox','data-validation'=>'email')) ?></div>
		</div>
		<div class="js-form-wrapper">
			<div class="js-form-title"><?php echo __('AUTO_RESPONSE','js-support-ticket'); ?></div>
		    <div class="js-form-field"><?php echo JSSTformfield::radiobutton('autoresponse',array('1'=>__('YES','js-support-ticket'),'0'=>__('NO','js-support-ticket')),isset(jssupportticket::$_data[0]->autoresponse ) ? jssupportticket::$_data[0]->autoresponse : '1',array('class'=>'radiobutton'));?></div>
		</div>
		<div class="js-form-wrapper">
			<div class="js-form-title"><?php echo __('STATUS','js-support-ticket'); ?></div>
			<div class="js-form-field"><?php echo JSSTformfield::radiobutton('status',array('1'=>__('ACTIVE','js-support-ticket'),'0'=>__('DISABLED','js-support-ticket')),isset(jssupportticket::$_data[0]->status ) ? jssupportticket::$_data[0]->status : '1',array('class'=>'radiobutton'));?></div>
		</div>
		<?php echo JSSTformfield::hidden('id',isset(jssupportticket::$_data[0]->id) ? jssupportticket::$_data[0]->id : '' ); ?>
		<?php echo JSSTformfield::hidden('created',isset(jssupportticket::$_data[0]->created) ? jssupportticket::$_data[0]->created : '' ); ?>
		<?php echo JSSTformfield::hidden('updated',isset(jssupportticket::$_data[0]->updated) ? jssupportticket::$_data[0]->updated : '' ); ?>
		<?php echo JSSTformfield::hidden('action','email_saveemail'); ?>
		<?php echo JSSTformfield::hidden('form_request','jssupportticket'); ?>
		<div class="js-form-button">
			<?php echo JSSTformfield::submitbutton('save',__('SAVE_EMAIL','js-support-ticket'),array('class'=>'button')); ?>
		</div>			
	</form>