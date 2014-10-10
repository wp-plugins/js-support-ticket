<script type="text/javascript">
		function resetFrom(){
			document.getElementById('ticketid').value = ''; 
			document.getElementById('jssupportticketform').submit();
		}
</script>
<?php message::getMessage();?>
<span class="js-admin-title"><?php echo __('TICKETS','js-support-ticket'); ?></span>
<form class="js-filter-form" name="jssupportticketform" id="jssupportticketform" method="post" action="<?php echo admin_url("admin.php?page=ticket_tickets&task=ticket_tickets"); ?>">
	<?php echo formfield::text('ticketid',jssupportticket::$_data['ticketsubject'],array('placeholder'=>__('TICKET_ID_OR_SUBJECT','js-support-ticket'))); ?>
	<?php echo formfield::submitbutton(__('GO','js-support-ticket'),__('GO','js-support-ticket'),array('class'=>'button')); ?>
	<?php echo formfield::button(__('RESET','js-support-ticket'),__('RESET','js-support-ticket'),array('class'=>'button','onclick'=>'resetFrom();')); ?>
</form>
<a class="js-add-link button" href="?page=ticket_tickets&task=ticket_addticket"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/add_icon.png" /><?php echo __('ADD_NEW_TICKET','js-support-ticket'); ?></a>
<?php
	$link = '?page=ticket_tickets';
	if (jssupportticket::$_sortorder == 'ASC') $img = "sort0.png";
	else $img = "sort1.png";
?>
<div class="js-admin-sorting js-col-md-12">
	<span class="js-col-md-2 js-admin-sorting-link"><a href="<?php echo $link ?>&sortby=<?php echo jssupportticket::$_sortlinks['subject']; ?>" class="<?php if (jssupportticket::$_sorton == 'subject') echo 'selected' ?>"><?php echo __('SUBJECT','js-support-ticket'); ?><?php if (jssupportticket::$_sorton == 'subject') { ?> <img src="<?php echo jssupportticket::$_pluginpath.'includes/images/'.$img ?>"> <?php } ?></a></span>
	<span class="js-col-md-2 js-admin-sorting-link"><a href="<?php echo $link ?>&sortby=<?php echo jssupportticket::$_sortlinks['priority']; ?>" class="<?php if (jssupportticket::$_sorton == 'priority') echo 'selected' ?>"><?php echo __('PRIORITY','js-support-ticket'); ?><?php if (jssupportticket::$_sorton == 'priority') { ?> <img src="<?php echo jssupportticket::$_pluginpath.'includes/images/'.$img ?>"> <?php } ?></a></span>
	<span class="js-col-md-2 js-admin-sorting-link"><a href="<?php echo $link ?>&sortby=<?php echo jssupportticket::$_sortlinks['ticketid']; ?>" class="<?php if (jssupportticket::$_sorton == 'ticketid') echo 'selected' ?>"><?php echo __('TICKET_ID','js-support-ticket'); ?><?php if (jssupportticket::$_sorton == 'ticketid') { ?> <img src="<?php echo jssupportticket::$_pluginpath.'includes/images/'.$img ?>"> <?php } ?></a></span>
	<span class="js-col-md-2 js-admin-sorting-link"><a href="<?php echo $link ?>&sortby=<?php echo jssupportticket::$_sortlinks['isanswered']; ?>" class="<?php if (jssupportticket::$_sorton == 'isanswered') echo 'selected' ?>"><?php echo __('ANSWERED','js-support-ticket'); ?><?php if (jssupportticket::$_sorton == 'isanswered') { ?> <img src="<?php echo jssupportticket::$_pluginpath.'includes/images/'.$img ?>"> <?php } ?></a></span>
	<span class="js-col-md-2 js-admin-sorting-link"><a href="<?php echo $link ?>&sortby=<?php echo jssupportticket::$_sortlinks['status']; ?>" class="<?php if (jssupportticket::$_sorton == 'status') echo 'selected' ?>"><?php echo __('STATUS','js-support-ticket'); ?><?php if (jssupportticket::$_sorton == 'status') { ?> <img src="<?php echo jssupportticket::$_pluginpath.'includes/images/'.$img ?>"> <?php } ?></a></span>
	<span class="js-col-md-2 js-admin-sorting-link"><a href="<?php echo $link ?>&sortby=<?php echo jssupportticket::$_sortlinks['created']; ?>" class="<?php if (jssupportticket::$_sorton == 'created') echo 'selected' ?>"><?php echo __('CREATED','js-support-ticket'); ?><?php if (jssupportticket::$_sorton == 'created') { ?> <img src="<?php echo jssupportticket::$_pluginpath.'includes/images/'.$img ?>"> <?php } ?></a></span>
</div>
<?php
  	if(!empty(jssupportticket::$_data[0])){
?>
	<!-- Tabs Area -->
<?php  		
		foreach(jssupportticket::$_data[0] AS $ticket){	
			if ($ticket->status == 0){
				$style = "red;";
				$status = __('NEW','js-support-ticket');
			}elseif($ticket->status == 1){
				$style = "orange;";
				$status = __('WAITING_YOUR_REPLY','js-support-ticket');
			}elseif($ticket->status == 2){
				$style = "#FF7F50;";
				$status = __('IN_PROGRESS','js-support-ticket');
			}elseif($ticket->status == 3){
				$style = "green;";
				$status = __('WAITING_CUSTOMER_REPLY','js-support-ticket');
			}elseif($ticket->status == 4){
				$style = "blue;";
				$status = __('CLOSED','js-support-ticket');
			}
?>  		
			<div class="js-col-md-12 js-ticket-wrapper">
				<div class="js-col-md-12 js-ticket-toparea">
					<div class="js-col-md-1 js-ticket-pic">
						<img src="<?php echo jssupportticket::$_pluginpath.'includes/images/ticketman.png'; ?>" />
					</div>
					<div class="js-col-md-8 js-ticket-data">
						<div class="js-col-md-12">
							<span class="js-ticket-title"><?php echo __('SUBJECT','js-support-ticket'); ?>&nbsp;:&nbsp;</span>
							<a href="?page=ticket_tickets&task=ticket_ticketdetail&jssupportticket_ticketid=<?php echo $ticket->id; ?>"><?php echo $ticket->subject; ?></a>
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
					<div class="js-col-md-3 js-ticket-data1">
						<div class="js-row">
							<div class="js-col-md-6"><?php echo __('TICKET_ID','js-support-ticket'); ?></div>
							<div class="js-col-md-6"><?php echo $ticket->ticketid; ?></div>
						</div>
						<div class="js-row">
							<div class="js-col-md-6"><?php echo __('LAST_REPLY','js-support-ticket'); ?></div>
							<div class="js-col-md-6"><?php if(empty($ticket->lastreply)|| $ticket->lastreply == '0000-00-00 00:00:00') echo __('NO_LAST_REPLY','js-support-ticket'); else echo date(jssupportticket::$_config['date_format'],strtotime($ticket->lastreply)); ?></div>
						</div>
						<div class="js-row">
							<div class="js-col-md-6"><?php echo __('PRIORITY','js-support-ticket'); ?></div>
							<div class="js-col-md-6" style="background:<?php echo $ticket->prioritycolour; ?>;"><?php echo $ticket->priority; ?></div>
						</div>
					</div>
					<div class="js-ticket-bottom-line"></div>
				</div>
				<div class="js-col-md-12 js-ticket-bottom-data-part">
					<span class="js-ticket-created"><?php echo __('CREATED','js-support-ticket'); ?>&nbsp;:&nbsp;<?php echo date(jssupportticket::$_config['date_format'],strtotime($ticket->created));?></span>
					<a class="button" href="?page=ticket_tickets&task=ticket_deleteticket&action=deleteitem&ticketid=<?php echo $ticket->id; ?>"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/remove.png" /><?php echo __('DELETE','js-support-ticket'); ?></a>
					<a class="button" href="?page=ticket_tickets&task=ticket_addticket&jssupportticket_ticketid=<?php echo $ticket->id; ?>"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/edit.png" /><?php echo __('EDIT','js-support-ticket'); ?></a>
					<a class="button" href="?page=ticket_tickets&task=ticket_ticketdetail&jssupportticket_ticketid=<?php echo $ticket->id; ?>"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/detail.png" /><?php echo __('TICKET_DETAIL','js-support-ticket'); ?></a>
				</div>
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
