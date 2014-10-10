<?php
if( get_current_user_id() != 0 ){
	wp_enqueue_style('jquery-ui-css', jssupportticket::$_pluginpath.'includes/css/jquery-ui.css');
	wp_enqueue_script('formvalidate.js',jssupportticket::$_pluginpath.'includes/js/jquery.form-validator.js');
?>
<script type="text/javascript">
	jQuery(document).ready(function($){$.validate();})
</script>
<span class="js-admin-title"><?php echo __('ADD_NEW_DEPARTMENT','js-support-ticket'); ?></span>
<form method="post" action="<?php echo admin_url("admin.php?page=departmet_departmets&task=departmet_savedepartmet&action=admin_savedepartmet"); ?>">
		<div class="js-form-wrapper">
			<div class="js-form-title"><?php echo __('TITLE','js-support-ticket'); ?></div>
			<div class="js-form-field"><?php echo formfield::text('departmentname',isset(jssupportticket::$_data[0]->departmentname) ? jssupportticket::$_data[0]->departmentname : '',array('class'=>'inputbox','data-validation'=>'required')) ?></div>
		</div>
		<div class="js-form-wrapper">
			<div class="js-form-title"><?php echo __('OUT_GOING_EMAIL','js-support-ticket'); ?></div>
			<div class="js-form-field"><?php echo formfield::select('emailid',includer::getJSModel('email')->getEmailForDepartment(),isset(jssupportticket::$_data[0]->emailid) ? jssupportticket::$_data[0]->emailid : '',__('SELECT_EMAIL_ADDRESS','js-support-ticket'),array('class'=>'inputbox','data-validation'=>'required'));?></div>
		</div>
		<div class="js-form-wrapper">
			<div class="js-form-title"><?php echo __('IS_PUBLIC','js-support-ticket'); ?></div>
			<div class="js-form-field"><?php echo formfield::radiobutton('ispublic',array('1'=>__('PUBLIC','js-support-ticket'),'2'=>__('PRIVATE','js-support-ticket')),isset(jssupportticket::$_data[0]->ispublic) ? jssupportticket::$_data[0]->ispublic : '',array('class'=>'radiobutton','data-validation'=>'required'));?></div>
		</div>
		<?php /*
		<div class="js-form-wrapper">
			<div class="js-form-title"><?php echo __('SIGNATURE','js-support-ticket'); ?></div>
			<div class="js-form-field"><?php echo wp_editor(jssupportticket::$_data[0]->departmentsignature,'departmentsignature',array( 'media_buttons' => false ));?></div>
		</div>
		<div class="js-form-wrapper">
			<div class="js-form-title"><?php echo __('APPEND_SIGNATURE','js-support-ticket'); ?></div>
			<div class="js-form-field"><?php echo formfield::checkbox('canappendsignature',array('1'=>__('APPEND_SIGNATURE_WITH_REPLY','js-support-ticket')),1,array('class'=>'radiobutton'));?></div>
		</div>
		*/ ?>
		<div class="js-form-wrapper">
			<div class="js-form-title"><?php echo __('STATUS','js-support-ticket'); ?></div>
			<div class="js-form-field"><?php echo formfield::radiobutton('status',array('1'=>__('APPROVED','js-support-ticket'),'2'=>__('NOT_APPROVED','js-support-ticket')),isset(jssupportticket::$_data[0]->status) ? jssupportticket::$_data[0]->status : '',array('class'=>'radiobutton','data-validation'=>'required'));?></div>
		</div>
		<?php echo formfield::hidden('id',isset(jssupportticket::$_data[0]->id) ? jssupportticket::$_data[0]->id : ''); ?>
		<?php echo formfield::hidden('created',isset(jssupportticket::$_data[0]->created) ? jssupportticket::$_data[0]->created : ''); ?>
		<?php echo formfield::hidden('updated',isset(jssupportticket::$_data[0]->updated) ? jssupportticket::$_data[0]->updated : ''); ?>
		<?php echo formfield::hidden('action','department_savedepartment'); ?>
		<?php echo formfield::hidden('form_request','jssupportticket'); ?>
		<div class="js-form-button">
			<?php echo formfield::submitbutton('save',__('SAVE_DEPARTMENT','js-support-ticket'),array('class'=>'button')); ?>
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
	}
?>
