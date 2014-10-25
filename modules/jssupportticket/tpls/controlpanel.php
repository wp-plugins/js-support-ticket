<?php
if(jssupportticket::$_config['offline'] == 2){
  if( get_current_user_id() != 0 ){
?>
<h1 class="js-ticket-heading"><?php echo jssupportticket::$_config['title']; ?></h1>
<div class="js-row js-ticket-wrapper js-controlpanel">
	<a class="js-col-md-5 js-col-xs-12 js-ticket-cp-link" href="<?php echo site_url("?page_id=".jssupportticket::$_pageid."&task=ticket_addticket"); ?>">
		<div class="js-col-md-8 js-col-xs-8">
			<h3 class="js-ticket-h3"><?php echo __('OPEN_TICKET','js-support-ticket'); ?></h3>
			<div class="js-ticket-description"><?php echo __('PLEASE_PROVIDE_AS_MUCH_DETAIL_AS_POSSIBLE_SO_WE_CAN_BEST_ASIST_YOU.','js-support-ticket')?></div>
		</div>
		<div class="js-col-md-4 js-col-xs-4"><img src="<?php echo jssupportticket::$_pluginpath.'includes/images/newticket.png'; ?>" /></div>
	</a>
	<a class="js-col-md-5 js-col-xs-12 js-col-md-offset-2 js-ticket-cp-link" href="?page_id=<?php echo jssupportticket::$_pageid; ?>&task=ticket_myticket">
		<div class="js-col-md-8 js-col-xs-8">
			<h3 class="js-ticket-h3"><?php echo __('MY_TICKETS','js-support-ticket'); ?></h3>
			<div class="js-ticket-description"><?php echo __('WE_PROVIDE_ARCHIVES_AND_HISTORY_OF_ALL_YOUR_SUPPORT_REQUESTS_COMPLETE_WITH_RESPONSES.','js-support-ticket')?></div>
		</div>
		<div class="js-col-md-4 js-col-xs-4"><img src="<?php echo jssupportticket::$_pluginpath.'includes/images/myticket.png'; ?>" /></div>
	</a>
</div>
<?php 
}else{ ?>
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
}else{ ?>
        <div class="js_job_error_messages_wrapper">
            <div class="js_job_messages_image_wrapper">
                <img class="js_job_messages_image" src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/errors/1.png"/>
            </div>
            <div class="js_job_messages_data_wrapper">
                <span class="js_job_messages_main_text">
                    <?php echo __('SYSTEM_OFFLINE','js-support-ticket'); ?>
                </span>
                <span class="js_job_messages_block_text">
                    <?php echo jssupportticket::$_config['offline_message']; ?>
                </span>
            </div>
        </div>
<?php  
}
?>