<script type="text/javascript">
		function resetFrom(){
			document.getElementById('subject').value = '';
			document.getElementById('name').value = ''; 
			document.getElementById('email').value = ''; 
			document.getElementById('ticketid').value = ''; 
			document.getElementById('jssupportticketform').submit();
		}
</script>
<?php JSSTmessage::getMessage();?>
<span class="js-admin-title"><?php echo __('TICKETS','js-support-ticket'); ?></span>
<?php
	$list = JSSTrequest::getVar('list',null,1);
	$open = ($list == 1) ? 'active' : '';
	$answered = ($list == 2) ? 'active' : '';
	$closed = ($list == 4) ? 'active' : '';
	$alltickets = ($list == 5) ? 'active' : '';
?>
<form class="js-filter-form" name="jssupportticketform" id="jssupportticketform" method="post" action="<?php echo admin_url("admin.php?page=ticket&layout=tickets&list=".$list); ?>">
	<?php echo JSSTformfield::text('subject',jssupportticket::$_data['filter']['subject'],array('placeholder'=>__('SUBJECT','js-support-ticket'))); ?>
	<?php echo JSSTformfield::text('name',jssupportticket::$_data['filter']['name'],array('placeholder'=>__('FROM','js-support-ticket'))); ?>
	<?php echo JSSTformfield::text('email',jssupportticket::$_data['filter']['email'],array('placeholder'=>__('EMAIL','js-support-ticket'))); ?>
	<?php echo JSSTformfield::text('ticketid',jssupportticket::$_data['filter']['ticketid'],array('placeholder'=>__('TICKET_ID','js-support-ticket'))); ?>
	<?php echo JSSTformfield::hidden('JSST_form_search','JSST_SEARCH'); ?>
	<?php echo JSSTformfield::submitbutton('go',__('SEARCH','js-support-ticket'),array('class'=>'button')); ?>
	<?php echo JSSTformfield::button(__('RESET','js-support-ticket'),__('RESET','js-support-ticket'),array('class'=>'button','onclick'=>'resetFrom();')); ?>
</form>
<a class="js-add-link button" href="?page=ticket&layout=addticket"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/add_icon.png" /><?php echo __('ADD_TICKET','js-support-ticket'); ?></a>
<div class="js-col-md-12" style = "margin-bottom:10px;margin-top:10px;">
	<div class="js-col-md-2 js-myticket-link js-col-md-offset-2">
		<a class="js-myticket-link <?php echo $open; ?>" href="<?php echo admin_url("admin.php?page=ticket&layout=tickets&list=1"); ?>" ><?php echo __('OPEN','js-support-ticket'); ?></a>
	</div>
	<div class="js-col-md-2 js-myticket-link">
		<a class="js-myticket-link <?php echo $answered; ?>" href="<?php echo admin_url("admin.php?page=ticket&layout=tickets&list=2"); ?>" ><?php echo __('ANSWERED','js-support-ticket'); ?></a>
	</div>
	<div class="js-col-md-2 js-myticket-link">
		<a class="js-myticket-link <?php echo $closed; ?>" href="<?php echo admin_url("admin.php?page=ticket&layout=tickets&list=4"); ?>" ><?php echo __('CLOSED','js-support-ticket'); ?></a>
	</div>
	<div class="js-col-md-2 js-myticket-link">
		<a class="js-myticket-link <?php echo $alltickets; ?>" href="<?php echo admin_url("admin.php?page=ticket&layout=tickets&list=5"); ?>" ><?php echo __('ALL_TICKETS','js-support-ticket'); ?></a>
	</div>
</div>

<?php
	$link = '?page=ticket';
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
				$style = "#9ACC00;";
				$status = __('NEW','js-support-ticket');
			}elseif($ticket->status == 1){
				$style = "#217ac3;";
				$status = __('WAITING_YOUR_REPLY','js-support-ticket');
			}elseif($ticket->status == 2){
				$style = "#FE7C2C;";
				$status = __('IN_PROGRESS','js-support-ticket');
			}elseif($ticket->status == 3){
				$style = "#FFB613;";
				$status = __('WAITING_CUSTOMER_REPLY','js-support-ticket');
			}elseif($ticket->status == 4){
				$style = "#F04646;";
				$status = __('CLOSED','js-support-ticket');
			}
?>  		
			<div class="js-col-xs-12 js-col-md-12 js-ticket-wrapper">
				<div class="js-col-xs-12 js-col-md-12 js-ticket-toparea">
					<div class="js-col-xs-2 js-col-md-1 js-ticket-pic">
								<img src="<?php echo jssupportticket::$_pluginpath.'includes/images/ticketman.png'; ?>" />
					</div>
					<div class="js-col-xs-10 js-col-md-8 js-ticket-data js-nullpadding">
						<div class="js-col-xs-12 js-col-md-12 js-ticket-body-data-elipses">
							<span class="js-ticket-title"><?php echo __('SUBJECT','js-support-ticket'); ?>&nbsp;:&nbsp;</span>
							<a href="?page=ticket&layout=ticketdetail&jssupportticketid=<?php echo $ticket->id; ?>"><?php echo $ticket->subject; ?></a>
						</div>
						<div class="js-col-xs-12 js-col-md-12">
							<span class="js-ticket-title"><?php echo __('FROM','js-support-ticket'); ?>&nbsp;:&nbsp;</span>
							<span class="js-ticket-value"><?php echo $ticket->name; ?></span>
						</div>
						<div class="js-col-xs-12 js-col-md-12">
							<span class="js-ticket-title"><?php echo __('DEPARTMENT','js-support-ticket'); ?>&nbsp;:&nbsp;</span>
							<span class="js-ticket-value"><?php echo $ticket->departmentname; ?></span>
						</div>
						<span class="js-ticket-value js-ticket-creade-via-email-spn"><?php echo $ticketviamail; ?></span>
						<span class="js-ticket-status" style="background:<?php echo $style; ?>">
							<?php 
							$counter = 'one';
							if($ticket->lock == 1){ ?>
								<img class="ticketstatusimage <?php echo $counter; $counter = 'two';?>" src="<?php echo jssupportticket::$_pluginpath."includes/images/lockstatus.png"; ?>" title="<?php echo __('TICKET_LOCKED','js-support-ticket'); ?>" />
							<?php } ?>
							<?php echo $status; ?>
						</span>
					</div>
					<div class="js-col-xs-12 js-col-md-3 js-ticket-data1">
						<div class="js-row">
							<div class="js-col-xs-6 js-col-md-6"><?php echo __('TICKET_ID','js-support-ticket'); ?></div>
							<div class="js-col-xs-6 js-col-md-6"><?php echo $ticket->ticketid; ?></div>
						</div>
						<div class="js-row">
							<div class="js-col-xs-6 js-col-md-6"><?php echo __('LAST_REPLY','js-support-ticket'); ?></div>
							<div class="js-col-xs-6 js-col-md-6"><?php if(empty($ticket->lastreply)|| $ticket->lastreply == '0000-00-00 00:00:00') echo __('NO_LAST_REPLY','js-support-ticket'); else echo date(jssupportticket::$_config['date_format'],strtotime($ticket->lastreply)); ?></div>
						</div>
						<div class="js-row">
							<div class="js-col-xs-6 js-col-md-6"><?php echo __('PRIORITY','js-support-ticket'); ?></div>
							<div class="js-col-xs-6 js-col-md-6 js-ticket-wrapper-textcolor" style="background:<?php echo $ticket->prioritycolour; ?>;"><?php echo $ticket->priority; ?></div>
						</div>
					</div>
					<div class="js-ticket-bottom-line"></div>
				</div>
				<div class="js-col-xs-12 js-col-md-12 js-ticket-bottom-data-part">
					<span class="js-ticket-created"><?php echo __('CREATED','js-support-ticket'); ?>&nbsp;:&nbsp;<?php echo date(jssupportticket::$_config['date_format'],strtotime($ticket->created));?></span>
					<div class="js-ticket-datapart-buttons-action">	
						<a class="js-ticket-bottom-data-part-action-button button"  onclick="return confirm('<?php echo __('ARE_YOU_SURE_TO_DELETE','js-support-ticket'); ?>');" href="?page=ticket&task=deleteticket&action=jstask&ticketid=<?php echo $ticket->id; ?>"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/remove.png" /><?php echo __('DELETE','js-support-ticket'); ?></a>
						<a class="js-ticket-bottom-data-part-action-button button" href="?page=ticket&layout=addticket&jssupportticketid=<?php echo $ticket->id; ?>"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/edit.png" /><?php echo __('EDIT','js-support-ticket'); ?></a>
					</div>
					<div class="js-ticket-datapart-buttons-detail">
						<a class="js-ticket-bottom-data-part-action-button button" href="?page=ticket&layout=ticketdetail&jssupportticketid=<?php echo $ticket->id; ?>"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/detail.png" /><?php echo __('TICKET_DETAIL','js-support-ticket'); ?></a>
					</div>
				</div>
			</div>
<?php			
		}
		if ( jssupportticket::$_data[1] ) {
		    echo '<div class="tablenav"><div class="tablenav-pages" style="margin: 1em 0">' . jssupportticket::$_data[1] . '</div></div>';
		}
	}else{ 	
		JSSTlayout::getNoRecordFound();
	}	
?>
