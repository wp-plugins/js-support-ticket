
<?php JSSTmessage::getMessage(); ?>
<span class="js-admin-title"><?php echo __('EMAIL_TEMPLATES','js-support-ticket') ?></span>

<form method="post" action="<?php echo admin_url("?page=emailtemplate&task=saveemailtemplate"); ?>">
	<div class="js-email-menu">
		<span class="js-email-menu-link <?php if(jssupportticket::$_data[1] == 'tk-nw') echo 'selected'; ?>"><a class="js-email-link" href="?page=emailtemplate&for=tk-nw"><?php echo __('NEW_TICKET','js-support-ticket'); ?></a></span>
		<span class="js-email-menu-link <?php if(jssupportticket::$_data[1] == 'cl-tk') echo 'selected'; ?>"><a class="js-email-link" href="?page=emailtemplate&for=cl-tk"><?php echo __('CLOSE_TICKET','js-support-ticket'); ?></a></span>
		<span class="js-email-menu-link <?php if(jssupportticket::$_data[1] == 'dl-tk') echo 'selected'; ?>"><a class="js-email-link" href="?page=emailtemplate&for=dl-tk"><?php echo __('DELETE_TICKET','js-support-ticket'); ?></a></span>
		<span class="js-email-menu-link <?php if(jssupportticket::$_data[1] == 'rsp-tk') echo 'selected'; ?>"><a class="js-email-link" href="?page=emailtemplate&for=rsp-tk"><?php echo __('RESPONSE_TICKET','js-support-ticket'); ?></a></span>
		<span class="js-email-menu-link <?php if(jssupportticket::$_data[1] == 'rpy-tk') echo 'selected'; ?>"><a class="js-email-link" href="?page=emailtemplate&for=rpy-tk"><?php echo __('REPLY_TICKET','js-support-ticket'); ?></a></span>
		<span class="js-email-menu-link <?php if(jssupportticket::$_data[1] == 'tk-ew-ad') echo 'selected'; ?>"><a class="js-email-link" href="?page=emailtemplate&for=tk-ew-ad"><?php echo __('NEW_TICKET_ADMIN_ALERT','js-support-ticket'); ?></a></span>
		<span class="js-email-menu-link <?php if(jssupportticket::$_data[1] == 'pc-tk') echo 'selected'; ?>"><a class="js-email-link" href="?page=emailtemplate&for=pc-tk"><?php echo __('TICKET_PRIORITY_CHANGE','js-support-ticket'); ?></a></span>
	</div>
	<div class="js-email-body">
		<div class="js-form-wrapper">
			<div class="a-js-form-title"><?php echo __('SUBJECT','js-support-ticket'); ?></div>
			<div class="a-js-form-field"><?php echo JSSTformfield::text('subject',jssupportticket::$_data[0]->subject,array('class'=>'inputbox','style'=>'width:100%;')) ?></div>
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
				}elseif(jssupportticket::$_data[1] == 'ew-md'){
			?>
				<span class="js-email-paramater">{DEPARTMENT_TITLE} : <?php echo __('DEPARTMENT_TITLE','js-support-ticket'); ?></span>
			<?php 
				}elseif(jssupportticket::$_data[1] == 'ew-gr'){
			?>
				<span class="js-email-paramater">{GROUP_TITLE} : <?php echo __('GROUP_TITLE','js-support-ticket'); ?></span>
			<?php 
				}elseif(jssupportticket::$_data[1] == 'cl-tk'){
			?>
				<span class="js-email-paramater">{SUBJECT} : <?php echo __('SUBJECT','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{TRACKINGID} : <?php echo __('TRACKING_ID','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{TICKETURL} : <?php echo __('TICKET_URL','js-support-ticket'); ?></span>
			<?php 
				}elseif(jssupportticket::$_data[1] == 'dl-tk'){
			?>
				<span class="js-email-paramater">{SUBJECT} : <?php echo __('SUBJECT','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{TRACKINGID} : <?php echo __('TRACKING_ID','js-support-ticket'); ?></span>
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
				}elseif(jssupportticket::$_data[1] == 'pc-tk'){
			?>
				<span class="js-email-paramater">{SUBJECT} : <?php echo __('SUBJECT','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{TRACKINGID} : <?php echo __('TRACKING_ID','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{PRIORITY_TITLE} : <?php echo __('PRIORITY','js-support-ticket'); ?></span>
				<span class="js-email-paramater">{TICKETURL} : <?php echo __('TICKET_URL','js-support-ticket'); ?></span>
			<?php 
				}	
			?>
		</div>
		<div class="js-form-button">
			<?php echo JSSTformfield::submitbutton('save',__('SAVE_EMAIL_TEMPLATE','js-support-ticket'),array('class'=>'button')); ?>
		</div>			
	</div>
	<?php echo JSSTformfield::hidden('id',jssupportticket::$_data[0]->id); ?>
	<?php echo JSSTformfield::hidden('created',jssupportticket::$_data[0]->created); ?>
	<?php echo JSSTformfield::hidden('templatefor',jssupportticket::$_data[0]->templatefor); ?>
	<?php echo JSSTformfield::hidden('for',jssupportticket::$_data[1]); ?>
	<?php echo JSSTformfield::hidden('action','emailtemplate_saveemailtemplate'); ?>
	<?php echo JSSTformfield::hidden('form_request','jssupportticket'); ?>
</form>
