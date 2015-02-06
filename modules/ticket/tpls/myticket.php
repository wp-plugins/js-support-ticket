<?php
if(jssupportticket::$_config['offline'] == 2){
	if(get_current_user_id() != 0){
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_style('jquery-ui-css', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');

?>
<script type="text/javascript">
	jQuery(document).ready(function($){
		$('.custom_date').datepicker({ dateFormat: 'yy-mm-dd'});
		var combinesearch = "<?php echo jssupportticket::$_data['filter']['combinesearch']; ?>";
		if(combinesearch){
			doVisible();
			$("#js-filter-wrapper-toggle-area").show();
		} 
		$("#js-filter-wrapper-toggle-btn").click(function(){			
			if($("#js-filter-wrapper-toggle-search").is(":visible")){
				doVisible();
			}else{
				$("#js-filter-wrapper-toggle-search").show();
				$("#js-filter-wrapper-toggle-ticketid").hide();
				$("#js-filter-wrapper-toggle-minus").hide();
				$("#js-filter-wrapper-toggle-plus").show();  						
			}
			$("#js-filter-wrapper-toggle-area").toggle();
		});
		function doVisible(){
			$("#js-filter-wrapper-toggle-search").hide();
			$("#js-filter-wrapper-toggle-ticketid").show();
			$("#js-filter-wrapper-toggle-minus").show();
			$("#js-filter-wrapper-toggle-plus").hide();
		}
	});
	function resetFrom(){
		document.getElementById('jsst-ticket').value = '';
		document.getElementById('jsst-ticketsearchkeys').value = '';
		document.getElementById('jsst-from').value = '';
		document.getElementById('jsst-email').value = '';
		document.getElementById('jsst-departmentid').value = ''; 
		document.getElementById('jsst-priorityid').value = '';
		document.getElementById('jsst-subject').value = '';
		document.getElementById('jsst-datestart').value = '';
		document.getElementById('jsst-dateend').value = '';
		return true;
	}
</script>

<?php JSSTmessage::getMessage();?>
<?php JSSTbreadcrumbs::getBreadcrumbs();?>
<?php
	$list = JSSTrequest::getVar('list',null,1);
	$open = ($list == 1) ? 'active' : '';
	$answered = ($list == 2) ? 'active' : '';
	$overdue = ($list == 3) ? 'active' : '';
	$myticket = ($list == 4) ? 'active' : '';
?>
<h1 class="js-ticket-heading"><?php echo __('MY_TICKETS', 'js-support-ticket') ?></h1>
<div class="js-row">
	<div class="js-col-xs-12 js-col-md-2 js-col-md-offset-3 js-myticket-link">
		<a class="js-myticket-link <?php echo $open; ?>" href="<?php echo site_url("?page_id=".jssupportticket::$_pageid."&module=ticket&layout=myticket&list=1"); ?>" ><?php echo __('OPEN','js-support-ticket'); ?></a>
	</div>
	<div class="js-col-xs-12 js-col-md-2 js-myticket-link">
		<a class="js-myticket-link <?php echo $answered; ?>" href="<?php echo site_url("?page_id=".jssupportticket::$_pageid."&module=ticket&layout=myticket&list=2"); ?>" ><?php echo __('CLOSED','js-support-ticket'); ?></a>
	</div>
	<div class="js-col-xs-12 js-col-md-2 js-myticket-link">
		<a class="js-myticket-link <?php echo $myticket; ?>" href="<?php echo site_url("?page_id=".jssupportticket::$_pageid."&module=ticket&layout=myticket&list=4"); ?>" ><?php echo __('MY_TICKETS','js-support-ticket'); ?></a>
	</div>
</div>
<form class="js-filter-form" name="jssupportticketform" id="jssupportticketform" method="POST" action="<?php echo site_url("?page_id=".jssupportticket::getPageId()."&module=ticket&layout=myticket"); ?>">
	<div class="js-col-md-12 js-filter-wrapper js-filter-wrapper-position">	
		<div class="js-col-md-12 js-filter-value" id="js-filter-wrapper-toggle-search"><?php echo JSSTformfield::text('jsst-ticketsearchkeys',isset(jssupportticket::$_data['filter']['ticketsearchkeys']) ? jssupportticket::$_data['filter']['ticketsearchkeys'] : '',array('placeholder'=>__('TICKET_ID','js-support-ticket').' '.__('OR','js-support-ticket').' '.__('EMAIL_ADDRESS','js-support-ticket').' '.__('OR','js-support-ticket').' '.__('SUBJECT','js-support-ticket'))); ?></div>
		<div class="js-col-md-12 js-filter-value" id="js-filter-wrapper-toggle-ticketid"><?php echo JSSTformfield::text('jsst-ticket',isset(jssupportticket::$_data['filter']['ticketid']) ? jssupportticket::$_data['filter']['ticketid'] : '',array('placeholder'=>__('TICKET_ID','js-support-ticket'))); ?></div>
		<div id="js-filter-wrapper-toggle-btn">
			<div id="js-filter-wrapper-toggle-plus">
				 <img src="<?php echo jssupportticket::$_pluginpath.'includes/images/plus.png'; ?>" />
			</div> 
			<div id="js-filter-wrapper-toggle-minus">
				 <img src="<?php echo jssupportticket::$_pluginpath.'includes/images/minus.png'; ?>" />
			</div>
		</div>
	</div>
	<div id="js-filter-wrapper-toggle-area">
		<div class="js-col-xs-12 js-col-md-12 js-filter-wrapper">	
			<div class="js-col-xs-12 js-col-md-6 js-filter-value"><?php echo JSSTformfield::text('jsst-from',isset(jssupportticket::$_data['filter']['from']) ? jssupportticket::$_data['filter']['from'] : '',array('placeholder'=>__('FROM','js-support-ticket'))); ?></div>
			<div class="js-col-xs-12 js-col-md-6 js-filter-value"><?php echo JSSTformfield::text('jsst-email',isset(jssupportticket::$_data['filter']['email'])  ? jssupportticket::$_data['filter']['email'] : '',array('placeholder'=>__('EMAIL','js-support-ticket'))); ?></div>
		</div>
		<div class="js-col-xs-12 js-col-md-12 js-filter-wrapper">	
			<div class="js-col-xs-12 js-col-md-6 js-filter-value"><?php echo JSSTformfield::select('jsst-departmentid', JSSTincluder::getJSModel('department')->getDepartmentForCombobox(),isset(jssupportticket::$_data['filter']['departmentid'])  ? jssupportticket::$_data['filter']['departmentid'] : '', __('SELECT_DEPARTMENT', 'js-support-ticket')); ?> </div>
			<div class="js-col-xs-12 js-col-md-6 js-filter-value"><?php echo JSSTformfield::select('jsst-priorityid', JSSTincluder::getJSModel('priority')->getPriorityForCombobox(),isset(jssupportticket::$_data['filter']['priorityid']) ? jssupportticket::$_data['filter']['priorityid'] : '', __('PROIRITY', 'js-support-ticket')); ?></div>
		</div>
		<div class="js-col-xs-12 js-col-md-12 js-filter-wrapper">	
			<div class="js-col-xs-12 js-col-md-12 js-filter-value"><?php echo JSSTformfield::text('jsst-subject',isset(jssupportticket::$_data['filter']['subject']) ? jssupportticket::$_data['filter']['subject'] : '',array('placeholder'=>__('SUBJECT','js-support-ticket'))); ?></div>
		</div>
		<div class="js-col-xs-12 js-col-md-12 js-filter-wrapper">	
			<div class="js-col-xs-12 js-col-md-4 js-filter-value"><?php echo JSSTformfield::text('jsst-datestart',isset(jssupportticket::$_data['filter']['datestart']) ? jssupportticket::$_data['filter']['datestart'] : '',array('class'=>'custom_date','placeholder'=>__('START_DATE','js-support-ticket'))); ?></div>
			<div class="js-col-md-4 js-ticket-special-character js-nullpadding">-</div>
			<div class="js-col-xs-12 js-col-md-4 js-filter-value"><?php echo JSSTformfield::text('jsst-dateend',isset(jssupportticket::$_data['filter']['dateend']) ? jssupportticket::$_data['filter']['dateend'] : '',array('class'=>'custom_date','placeholder'=>__('END_DATE','js-support-ticket'))); ?></div>
		</div>
	</div>
	<div class="js-col-xs-12 js-col-md-12 js-filter-wrapper">
		<div class="js-filter-button">
			<?php echo JSSTformfield::submitbutton('jsst-go',__('SEARCH','js-support-ticket'),array('class'=>'js-ticket-filter-button')); ?>
			<?php echo JSSTformfield::submitbutton('jsst-reset',__('RESET','js-support-ticket'),array('class'=>'js-ticket-filter-button','onclick'=>'return resetFrom();')); ?>
		</div>
	</div>
	<?php echo JSSTformfield::hidden('list',jssupportticket::$_data['list']); ?>
</form>

<?php
	$link = site_url('?page_id='.jssupportticket::$_pageid.'&module=ticket&layout=myticket&list='.jssupportticket::$_data['list']);
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
					<div class="js-col-xs-10 js-col-md-7 js-col-xs-10 js-ticket-data js-nullpadding">
						<div class="js-col-xs-12 js-col-md-12 js-ticket-padding-xs js-ticket-body-data-elipses">
							<span class="js-ticket-title"><?php echo __('SUBJECT','js-support-ticket'); ?>&nbsp;:&nbsp;</span>
							<a href="<?php echo site_url("?page_id=".jssupportticket::$_pageid."&module=ticket&layout=ticketdetail&jssupportticketid=".$ticket->id); ?>"><?php echo $ticket->subject; ?></a>
						</div>
						<div class="js-col-xs-12 js-col-md-12 js-ticket-padding-xs js-ticket-body-data-elipses">
							<span class="js-ticket-title"><?php echo __('FROM','js-support-ticket'); ?>&nbsp;:&nbsp;</span>
							<span class="js-ticket-value"><?php echo $ticket->name; ?></span>
						</div>
						<div class="js-col-xs-12 js-col-md-12 js-ticket-padding-xs js-ticket-body-data-elipses">
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
							<?php if($ticket->isoverdue == 1){ ?>
								<img class="ticketstatusimage <?php echo $counter; ?>" src="<?php echo jssupportticket::$_pluginpath."includes/images/mark_over_due.png"; ?>" title="<?php echo __('TICKET_MARKED_OVERDUE','js-support-ticket'); ?>" />
							<?php } ?>
							<?php echo $status; ?>
						</span>
					</div>
					<div class="js-col-xs-12 js-col-md-4 js-ticket-data1 js-ticket-padding-left-xs">
						<div class="js-row">
							<div class="js-col-xs-6 js-col-md-6 js-col-xs-6"><?php echo __('TICKET_ID','js-support-ticket'); ?></div>
							<div class="js-col-xs-6 js-col-md-6 js-col-xs-6"><?php echo $ticket->ticketid; ?></div>
						</div>
						<div class="js-row">
							<div class="js-col-xs-6 js-col-md-6 js-col-xs-6"><?php echo __('LAST_REPLY','js-support-ticket'); ?></div>
							<div class="js-col-xs-6 js-col-md-6 js-col-xs-6"><?php if(empty($ticket->lastreply)|| $ticket->lastreply == '0000-00-00 00:00:00') echo __('NO_LAST_REPLY','js-support-ticket'); else echo date(jssupportticket::$_config['date_format'],strtotime($ticket->lastreply)); ?></div>
						</div>
						<div class="js-row">
							<div class="js-col-xs-6 js-col-md-6 js-col-xs-6"><?php echo __('PRIORITY','js-support-ticket'); ?></div>
							<div class="js-col-xs-6 js-col-md-6 js-col-xs-6 js-ticket-wrapper-textcolor" style="color:#FFFFFF; background:<?php echo $ticket->prioritycolour; ?>;"><?php echo $ticket->priority; ?></div>
						</div>
					</div>
				</div>
			</div>
<?php			
		}

		if ( jssupportticket::$_data[1] ) {
		    echo '<div class="tablenav"><div class="tablenav-pages" style="margin: 1em 0">' . jssupportticket::$_data[1] . '</div></div>';
		}
	}else{ // Record Not FOund
			JSSTlayout::getNoRecordFound();
	}
	}else{// User is guest
		JSSTlayout::getUserGuest();
	}
   
}else{ // System is offline
	JSSTlayout::getSystemOffline();
}
?>