<?php
if(jssupportticket::$_config['offline'] == 2){
	if( get_current_user_id() != 0 ){
?>
<script type="text/javascript">
		function resetFrom(){
			document.getElementById('ticketid').value = ''; 
			document.getElementById('jssupportticketform').submit();
		}
</script>
<?php message::getMessage();?>
<h1 class="js-ticket-heading"><?php echo __('TICKETS','js-support-ticket'); ?></h1>
<div class="js-row">
	<div class="js-col-md-3 js-col-xs-6 js-myticket-link">
		<a class="js-myticket-link" href="<?php echo site_url("?page_id=".jssupportticket::$_pageid."&task=ticket_myticket&list=1"); ?>" ><?php echo __('OPEN','js-support-ticket'); ?></a>
	</div>
	<div class="js-col-md-3 js-col-xs-6 js-myticket-link">
		<a class="js-myticket-link" href="<?php echo site_url("?page_id=".jssupportticket::$_pageid."&task=ticket_myticket&list=2"); ?>" ><?php echo __('CLOSED','js-support-ticket'); ?></a>
	</div>
	<div class="js-col-md-3 js-col-xs-6 js-myticket-link">
		<a class="js-myticket-link" href="<?php echo site_url("?page_id=".jssupportticket::$_pageid."&task=ticket_myticket&list=3"); ?>" ><?php echo __('ANSWERED','js-support-ticket'); ?></a>
	</div>
	<div class="js-col-md-3 js-col-xs-6 js-myticket-link">
		<a class="js-myticket-link" href="<?php echo site_url("?page_id=".jssupportticket::$_pageid."&task=ticket_myticket&list=4"); ?>" ><?php echo __('MY_TICKETS','js-support-ticket'); ?></a>
	</div>
</div>
<form class="js-filter-form" name="jssupportticketform" id="jssupportticketform" method="post" action="<?php echo site_url("?page_id=".jssupportticket::$_pageid."&task=ticket_myticket"); ?>">
	<?php echo formfield::text('ticketid',isset(jssupportticket::$_data['filter_ticketid']) ? jssupportticket::$_data['filter_ticketid'] : '',array('placeholder'=>__('TICKET_ID_OR_SUBJECT','js-support-ticket'))); ?>
	<?php echo formfield::hidden('list',jssupportticket::$_data['list']); ?>
	<?php echo formfield::submitbutton(__('GO','js-support-ticket'),__('GO','js-support-ticket'),array('class'=>'js-ticket-filter-button')); ?>
	<?php echo formfield::button(__('RESET','js-support-ticket'),__('RESET','js-support-ticket'),array('class'=>'js-ticket-filter-button','onclick'=>'resetFrom();')); ?>
</form>
<?php
	$link = site_url('?page_id='.jssupportticket::$_pageid.'&task=ticket_myticket&list='.jssupportticket::$_data['list']);
	if (jssupportticket::$_sortorder == 'ASC') $img = "sort0.png";
	else $img = "sort1.png";
?>
<div class="js-ticket-sorting js-col-md-12">
	<span class="js-col-md-2 js-ticket-sorting-link"><a href="<?php echo $link ?>&sortby=<?php echo jssupportticket::$_sortlinks['subject']; ?>" class="<?php if (jssupportticket::$_sorton == 'subject') echo 'selected' ?>"><?php echo __('SUBJECT','js-support-ticket'); ?><?php if (jssupportticket::$_sorton == 'subject') { ?> <img src="<?php echo jssupportticket::$_pluginpath.'includes/images/'.$img ?>"> <?php } ?></a></span>
	<span class="js-col-md-2 js-ticket-sorting-link"><a href="<?php echo $link ?>&sortby=<?php echo jssupportticket::$_sortlinks['priority']; ?>" class="<?php if (jssupportticket::$_sorton == 'priority') echo 'selected' ?>"><?php echo __('PRIORITY','js-support-ticket'); ?><?php if (jssupportticket::$_sorton == 'priority') { ?> <img src="<?php echo jssupportticket::$_pluginpath.'includes/images/'.$img ?>"> <?php } ?></a></span>
	<span class="js-col-md-2 js-ticket-sorting-link"><a href="<?php echo $link ?>&sortby=<?php echo jssupportticket::$_sortlinks['ticketid']; ?>" class="<?php if (jssupportticket::$_sorton == 'ticketid') echo 'selected' ?>"><?php echo __('TICKET_ID','js-support-ticket'); ?><?php if (jssupportticket::$_sorton == 'ticketid') { ?> <img src="<?php echo jssupportticket::$_pluginpath.'includes/images/'.$img ?>"> <?php } ?></a></span>
	<span class="js-col-md-2 js-ticket-sorting-link"><a href="<?php echo $link ?>&sortby=<?php echo jssupportticket::$_sortlinks['isanswered']; ?>" class="<?php if (jssupportticket::$_sorton == 'isanswered') echo 'selected' ?>"><?php echo __('ANSWERED','js-support-ticket'); ?><?php if (jssupportticket::$_sorton == 'isanswered') { ?> <img src="<?php echo jssupportticket::$_pluginpath.'includes/images/'.$img ?>"> <?php } ?></a></span>
	<span class="js-col-md-2 js-ticket-sorting-link"><a href="<?php echo $link ?>&sortby=<?php echo jssupportticket::$_sortlinks['status']; ?>" class="<?php if (jssupportticket::$_sorton == 'status') echo 'selected' ?>"><?php echo __('STATUS','js-support-ticket'); ?><?php if (jssupportticket::$_sorton == 'status') { ?> <img src="<?php echo jssupportticket::$_pluginpath.'includes/images/'.$img ?>"> <?php } ?></a></span>
	<span class="js-col-md-2 js-ticket-sorting-link"><a href="<?php echo $link ?>&sortby=<?php echo jssupportticket::$_sortlinks['created']; ?>" class="<?php if (jssupportticket::$_sorton == 'created') echo 'selected' ?>"><?php echo __('CREATED','js-support-ticket'); ?><?php if (jssupportticket::$_sorton == 'created') { ?> <img src="<?php echo jssupportticket::$_pluginpath.'includes/images/'.$img ?>"> <?php } ?></a></span>
</div>
<?php
  	if(!empty(jssupportticket::$_data[0])){
		foreach(jssupportticket::$_data[0] AS $ticket){	
			if ($ticket->status == 0){
				$style = "red;";
				$status = __('NEW','js-support-ticket');
			}elseif($ticket->status == 1){
				$style = "orange;";
				$status = __('WAITING_STAFF_REPLY','js-support-ticket');
			}elseif($ticket->status == 2){
				$style = "#FF7F50;";
				$status = __('IN_PROGRESS','js-support-ticket');
			}elseif($ticket->status == 3){
				$style = "green;";
				$status = __('WAITING_YOUR_REPLY','js-support-ticket');
			}elseif($ticket->status == 4){
				$style = "blue;";
				$status = __('CLOSED','js-support-ticket');
			}
?>  		
			<div class="js-col-md-12 js-ticket-wrapper">
				<div class="js-col-md-12 js-ticket-toparea">
					<div class="js-col-md-1 js-col-xs-2 js-ticket-pic">
						<img src="<?php echo jssupportticket::$_pluginpath.'includes/images/ticketman.png'; ?>" />
					</div>
					<div class="js-col-md-7 js-col-xs-10 js-ticket-data">
						<div class="js-col-md-12">
							<span class="js-ticket-title"><?php echo __('SUBJECT','js-support-ticket'); ?>&nbsp;:&nbsp;</span>
							<a href="<?php echo site_url("?page_id=".jssupportticket::$_pageid."&task=ticket_ticketdetail&jssupportticket_ticketid=".$ticket->id); ?>"><?php echo $ticket->subject; ?></a>
						</div>
						<div class="js-col-md-12">
							<span class="js-ticket-title"><?php echo __('FROM','js-support-ticket'); ?>&nbsp;:&nbsp;</span>
							<span class="js-ticket-value"><?php echo $ticket->name; ?></span>
						</div>
						<div class="js-col-md-12">
							<span class="js-ticket-title"><?php echo __('DEPARTMENT','js-support-ticket'); ?>&nbsp;:&nbsp;</span>
							<span class="js-ticket-value"><?php echo $ticket->departmentname; ?></span>
						</div>
						<span class="js-ticket-status" style="background:<?php echo $style; ?>"><?php echo $status; ?></span>
					</div>
					<div class="js-col-md-4 js-ticket-data1">
						<div class="js-row">
							<div class="js-col-md-6 js-col-xs-6"><?php echo __('TICKET_ID','js-support-ticket'); ?></div>
							<div class="js-col-md-6 js-col-xs-6"><?php echo $ticket->ticketid; ?></div>
						</div>
						<div class="js-row">
							<div class="js-col-md-6 js-col-xs-6"><?php echo __('LAST_REPLY','js-support-ticket'); ?></div>
							<div class="js-col-md-6 js-col-xs-6"><?php if(empty($ticket->lastreply)|| $ticket->lastreply == '0000-00-00 00:00:00') echo __('NO_LAST_REPLY','js-support-ticket'); else echo date(jssupportticket::$_config['date_format'],strtotime($ticket->lastreply)); ?></div>
						</div>
						<div class="js-row">
							<div class="js-col-md-6 js-col-xs-6"><?php echo __('PRIORITY','js-support-ticket'); ?></div>
							<div class="js-col-md-6 js-col-xs-6" style="background:<?php echo $ticket->prioritycolour; ?>;"><?php echo $ticket->priority; ?></div>
						</div>
					</div>
				</div>
<?php /*				
				<div class="js-col-md-12 js-ticket-bottom-data-part">
					<span class="js-ticket-created"><?php echo __('CREATED','js-support-ticket'); ?>&nbsp;:&nbsp;<?php echo date(jssupportticket::$_config['date_format'],strtotime($ticket->created));?></span>
					<a class="button" href="?page=ticket_tickets&task=ticket_deleteticket&action=deleteitem&ticketid=<?php echo $ticket->id; ?>"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/remove.png" /><?php echo __('REMOVE','js-support-ticket'); ?></a>
					<a class="button" href="?page=ticket_tickets&task=ticket_addticket&jssupportticket_ticketid=<?php echo $ticket->id; ?>"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/edit.png" /><?php echo __('EDIT','js-support-ticket'); ?></a>
					<a class="button" href="?page=ticket_tickets&task=ticket_ticketdetail&jssupportticket_ticketid=<?php echo $ticket->id; ?>"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/detail.png" /><?php echo __('TICKET_DETAIL','js-support-ticket'); ?></a>
				</div>
*/ ?>				
			</div>
<?php			
		}
		if ( jssupportticket::$_data[1] ) {
		    echo '<div class="tablenav"><div class="tablenav-pages" style="margin: 1em 0">' . jssupportticket::$_data[1] . '</div></div>';
		}
	}else{ ?>
        <div class="js_job_error_messages_wrapper">
            <div class="js_job_messages_image_wrapper">
                <img class="js_job_messages_image" src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/errors/2.png"/>
            </div>
            <div class="js_job_messages_data_wrapper">
                <span class="js_job_messages_main_text">
                    <?php echo __('NO_RECORED_FOUND','js-support-ticket'); ?>
                </span>
                <span class="js_job_messages_block_text">
                    <?php echo __('NO_RECORED_FOUNT_TO_VIEW','js-support-ticket'); ?>
                </span>
            </div>
        </div>
<?php        
	}	
?>

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