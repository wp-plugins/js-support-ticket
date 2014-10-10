<?php
if( get_current_user_id() != 0 ){	
?>
<?php message::getMessage(); ?>
<span class="js-admin-title"><?php echo __('EMAIL_TEMPLATE','js-support-ticket') ?></span>

<form method="post" action="<?php echo admin_url("?page=emailtemplate_emailtemplates&task=emailtemplate_saveemailtmeplate&action=admin_saveemailtemplate"); ?>">
	<div class="js-email-menu">
		<span class="js-email-menu-link <?php if(jssupportticket::$_data[1] == 'tk-nw') echo 'selected'; ?>"><a class="js-email-link" href="?page=emailtemplate_emailtemplates&for=tk-nw"><?php echo __('NEW_TICKET','js-support-ticket'); ?></a></span>
		<span class="js-email-menu-link <?php if(jssupportticket::$_data[1] == 'sntk-tk') echo 'selected'; ?>"><a class="js-email-link" href="?page=emailtemplate_emailtemplates&for=sntk-tk"><?php echo __('STAFF_TICKET','js-support-ticket'); ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></a></span>
		<span class="js-email-menu-link <?php if(jssupportticket::$_data[1] == 'ew-md') echo 'selected'; ?>"><a class="js-email-link" href="?page=emailtemplate_emailtemplates&for=ew-md"><?php echo __('NEW_DEPARTMENT','js-support-ticket'); ?></a></span>
		<span class="js-email-menu-link <?php if(jssupportticket::$_data[1] == 'ew-gr') echo 'selected'; ?>"><a class="js-email-link" href="?page=emailtemplate_emailtemplates&for=ew-gr"><?php echo __('NEW_GROUP','js-support-ticket'); ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></a></span>
		<span class="js-email-menu-link <?php if(jssupportticket::$_data[1] == 'ew-sm') echo 'selected'; ?>"><a class="js-email-link" href="?page=emailtemplate_emailtemplates&for=ew-sm"><?php echo __('NEW_STAFF','js-support-ticket'); ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></a></span>
		<span class="js-email-menu-link <?php if(jssupportticket::$_data[1] == 'ew-ht') echo 'selected'; ?>"><a class="js-email-link" href="?page=emailtemplate_emailtemplates&for=ew-ht"><?php echo __('NEW_HELP_TOPIC','js-support-ticket'); ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></a></span>
		<span class="js-email-menu-link <?php if(jssupportticket::$_data[1] == 'rs-tk') echo 'selected'; ?>"><a class="js-email-link" href="?page=emailtemplate_emailtemplates&for=rs-tk"><?php echo __('REASSIGN_TICKET','js-support-ticket'); ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></a></span>
		<span class="js-email-menu-link <?php if(jssupportticket::$_data[1] == 'cl-tk') echo 'selected'; ?>"><a class="js-email-link" href="?page=emailtemplate_emailtemplates&for=cl-tk"><?php echo __('CLOSE_TICKET','js-support-ticket'); ?></a></span>
		<span class="js-email-menu-link <?php if(jssupportticket::$_data[1] == 'dl-tk') echo 'selected'; ?>"><a class="js-email-link" href="?page=emailtemplate_emailtemplates&for=dl-tk"><?php echo __('DELETE_TICKET','js-support-ticket'); ?></a></span>
		<span class="js-email-menu-link <?php if(jssupportticket::$_data[1] == 'mo-tk') echo 'selected'; ?>"><a class="js-email-link" href="?page=emailtemplate_emailtemplates&for=mo-tk"><?php echo __('MARK_OVERDUE_TICKET','js-support-ticket'); ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></a></span>
		<span class="js-email-menu-link <?php if(jssupportticket::$_data[1] == 'be-tk') echo 'selected'; ?>"><a class="js-email-link" href="?page=emailtemplate_emailtemplates&for=be-tk"><?php echo __('BAN_EMAIL','js-support-ticket'); ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></a></span>
		<span class="js-email-menu-link <?php if(jssupportticket::$_data[1] == 'be-trtk') echo 'selected'; ?>"><a class="js-email-link" href="?page=emailtemplate_emailtemplates&for=be-trtk"><?php echo __('BAN_EMAIL_TRY_CREATE_TICKET','js-support-ticket'); ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></a></span>
		<span class="js-email-menu-link <?php if(jssupportticket::$_data[1] == 'dt-tk') echo 'selected'; ?>"><a class="js-email-link" href="?page=emailtemplate_emailtemplates&for=dt-tk"><?php echo __('DEPARTMENT_TRANSFER','js-support-ticket'); ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></a></span>
		<span class="js-email-menu-link <?php if(jssupportticket::$_data[1] == 'ebct-tk') echo 'selected'; ?>"><a class="js-email-link" href="?page=emailtemplate_emailtemplates&for=ebct-tk"><?php echo __('EMAIL_BAN_CLOSE_TICKET','js-support-ticket'); ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></a></span>
		<span class="js-email-menu-link <?php if(jssupportticket::$_data[1] == 'ube-tk') echo 'selected'; ?>"><a class="js-email-link" href="?page=emailtemplate_emailtemplates&for=ube-tk"><?php echo __('UNBAN_EMAIL','js-support-ticket'); ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></a></span>
		<span class="js-email-menu-link <?php if(jssupportticket::$_data[1] == 'rsp-tk') echo 'selected'; ?>"><a class="js-email-link" href="?page=emailtemplate_emailtemplates&for=rsp-tk"><?php echo __('REPLY_TICKET_STAFF_ADMIN','js-support-ticket'); ?></a></span>
		<span class="js-email-menu-link <?php if(jssupportticket::$_data[1] == 'rpy-tk') echo 'selected'; ?>"><a class="js-email-link" href="?page=emailtemplate_emailtemplates&for=rpy-tk"><?php echo __('REPLY_TICKET','js-support-ticket'); ?></a></span>
		<span class="js-email-menu-link <?php if(jssupportticket::$_data[1] == 'tk-ew-ad') echo 'selected'; ?>"><a class="js-email-link" href="?page=emailtemplate_emailtemplates&for=tk-ew-ad"><?php echo __('NEW_TICKET_ADMIN_ALERT','js-support-ticket'); ?></a></span>
	</div>
	<div class="js-email-body">
		<div class="js-form-wrapper">
			<div class="a-js-form-title"><?php echo __('SUBJECT','js-support-ticket'); ?></div>
			<div class="a-js-form-field"><?php echo formfield::text('subject',jssupportticket::$_data[0]->subject,array('class'=>'inputbox','style'=>'width:100%;')) ?></div>
		</div>
		<div class="js-form-wrapper">
			<div class="a-js-form-title"><?php echo __('BODY','js-support-ticket'); ?></div>
			<div class="a-js-form-field"><?php echo wp_editor(jssupportticket::$_data[0]->body,'body',array( 'media_buttons' => false ));?></div>
		</div>
		<div class="js-email-parameters">
			<span class="js-email-parameter-heading"><?php echo __('PARAMETERS','js-support-ticket') ?></span>
			<?php 
				if(jssupportticket::$_data[1] == 'tk-nw'){
			?>
				<span class="js-email-paramater">{USERNAME} : <?php echo __('USERNAME','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{SUBJECT} : <?php echo __('SUBJECT','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{TRACKINGID} : <?php echo __('TRACKING_ID','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{HELP_TOPIC} : <?php echo __('HELP_TOPIC','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{EMAIL} : <?php echo __('EMAIL','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{MESSAGE} : <?php echo __('MESSAGE','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{TICKETURL} : <?php echo __('TICKET_URL','js-support-ticket'); ?></span>
			<?php
				}elseif(jssupportticket::$_data[1] == 'sntk-tk'){
			?>
				<span class="js-email-paramater">{USERNAME} : <?php echo __('USERNAME','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{SUBJECT} : <?php echo __('SUBJECT','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{TRACKINGID} : <?php echo __('TRACKING_ID','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{HELP_TOPIC} : <?php echo __('HELP_TOPIC','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{EMAIL} : <?php echo __('EMAIL','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{MESSAGE} : <?php echo __('MESSAGE','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{TICKETURL} : <?php echo __('TICKET_URL','js-support-ticket'); ?></span>
			<?php 
				}elseif(jssupportticket::$_data[1] == 'ew-md'){
			?>
				<span class="js-email-paramater">{DEPARTMENT_TITLE} : <?php echo __('DEPARTMENT_TITLE','js-support-ticket'); ?></span>
			<?php 
				}elseif(jssupportticket::$_data[1] == 'ew-gr'){
			?>
				<span class="js-email-paramater">{GROUP_TITLE} : <?php echo __('GROUP_TITLE','js-support-ticket'); ?></span>
			<?php 
				}elseif(jssupportticket::$_data[1] == 'ew-sm'){
			?>
				<span class="js-email-paramater">{STAFF_MEMBER_TITLE} : <?php echo __('STAFF_MEMBER_TITLE','js-support-ticket'); ?></span>
			<?php 
				}elseif(jssupportticket::$_data[1] == 'ew-ht'){
			?>
				<span class="js-email-paramater">{HELPTOPIC_TITLE} : <?php echo __('HELPTOPIC_TITLE','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{DEPARTMENT_TITLE} : <?php echo __('DEPARTMENT_TITLE','js-support-ticket'); ?></span>
			<?php 
				}elseif(jssupportticket::$_data[1] == 'rs-tk'){
			?>
				<span class="js-email-paramater">{TRACKINGID} : <?php echo __('TRACKING_ID','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{STAFF_MEMBER_TITLE} : <?php echo __('STAFF_MEMBER_TITLE','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{TICKETURL} : <?php echo __('TICKET_URL','js-support-ticket'); ?></span>
			<?php 
				}elseif(jssupportticket::$_data[1] == 'cl-tk'){
			?>
				<span class="js-email-paramater">{TRACKINGID} : <?php echo __('TRACKING_ID','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{TICKETURL} : <?php echo __('TICKET_URL','js-support-ticket'); ?></span>
			<?php 
				}elseif(jssupportticket::$_data[1] == 'dl-tk'){
			?>
				<span class="js-email-paramater">{TRACKINGID} : <?php echo __('TRACKING_ID','js-support-ticket'); ?></span>
			<?php 
				}elseif(jssupportticket::$_data[1] == 'mo-tk'){
			?>
				<span class="js-email-paramater">{TRACKINGID} : <?php echo __('TRACKING_ID','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{TICKETURL} : <?php echo __('TICKET_URL','js-support-ticket'); ?></span>
			<?php 
				}elseif(jssupportticket::$_data[1] == 'be-tk'){
			?>
				<span class="js-email-paramater">{EMAIL_ADDRESS} : <?php echo __('EMAIL_ADDRESS','js-support-ticket'); ?></span>
			<?php 
				}elseif(jssupportticket::$_data[1] == 'be-trtk'){
			?>
				<span class="js-email-paramater">{EMAIL_ADDRESS} : <?php echo __('EMAIL_ADDRESS','js-support-ticket'); ?></span>
			<?php 
				}elseif(jssupportticket::$_data[1] == 'dt-tk'){
			?>
				<span class="js-email-paramater">{TRACKINGID} : <?php echo __('TRACKING_ID','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{DEPARTMENT_TITLE} : <?php echo __('DEPARTMENT_TITLE','js-support-ticket'); ?></span>
			<?php 
				}elseif(jssupportticket::$_data[1] == 'ebct-tk'){
			?>
				<span class="js-email-paramater">{EMAIL_ADDRESS} : <?php echo __('EMAIL_ADDRESS','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{TICKETID} : <?php echo __('TICKET_ID','js-support-ticket'); ?></span>
			<?php 
				}elseif(jssupportticket::$_data[1] == 'ube-tk'){
			?>
				<span class="js-email-paramater">{EMAIL_ADDRESS} : <?php echo __('EMAIL_ADDRESS','js-support-ticket'); ?></span>
			<?php 
				}elseif(jssupportticket::$_data[1] == 'rsp-tk'){
			?>
				<span class="js-email-paramater">{USERNAME} : <?php echo __('USERNAME','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{SUBJECT} : <?php echo __('SUBJECT','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{TRACKINGID} : <?php echo __('TRACKING_ID','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{EMAIL} : <?php echo __('EMAIL','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{MESSAGE} : <?php echo __('MESSAGE','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{TICKETURL} : <?php echo __('TICKET_URL','js-support-ticket'); ?></span>
			<?php 
				}elseif(jssupportticket::$_data[1] == 'rpy-tk'){
			?>
				<span class="js-email-paramater">{USERNAME} : <?php echo __('USERNAME','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{SUBJECT} : <?php echo __('SUBJECT','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{TRACKINGID} : <?php echo __('TRACKING_ID','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{EMAIL} : <?php echo __('EMAIL','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{MESSAGE} : <?php echo __('MESSAGE','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{TICKETURL} : <?php echo __('TICKET_URL','js-support-ticket'); ?></span>
			<?php 
				}elseif(jssupportticket::$_data[1] == 'tk-ew-ad'){
			?>
				<span class="js-email-paramater">{USERNAME} : <?php echo __('USERNAME','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{SUBJECT} : <?php echo __('SUBJECT','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{TRACKINGID} : <?php echo __('TRACKING_ID','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{EMAIL} : <?php echo __('EMAIL','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{MESSAGE} : <?php echo __('MESSAGE','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{TICKETURL} : <?php echo __('TICKET_URL','js-support-ticket'); ?></span>
			<?php 
				}	
			?>
		</div>
		<div class="js-form-button">
			<?php echo formfield::submitbutton('save',__('SAVE_EMAIL_TEMPLATE','js-support-ticket'),array('class'=>'button')); ?>
		</div>		
		<div class="js-form-button">
			<?php echo '<font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font>'.__('PRO_VERSION_ONLY','js-support-ticket'); ?>
		</div>	
	</div>
	<?php echo formfield::hidden('id',jssupportticket::$_data[0]->id); ?>
	<?php echo formfield::hidden('created',jssupportticket::$_data[0]->created); ?>
	<?php echo formfield::hidden('templatefor',jssupportticket::$_data[0]->templatefor); ?>
	<?php echo formfield::hidden('for',jssupportticket::$_data[1]); ?>
	<?php echo formfield::hidden('action','emailtemplate_saveemailtemplate'); ?>
	<?php echo formfield::hidden('form_request','jssupportticket'); ?>
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
} ?>