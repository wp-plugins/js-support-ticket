<script type="text/javascript">
	function resetFrom(){
		document.getElementById('title').value = ''; 
		document.getElementById('jssupportticketform').submit();
	}
</script>
<?php message::getMessage();?>
<span class="js-admin-title"><?php echo __('PRIORITIES','js-support-ticket'); ?></span>
<form class="js-filter-form" name="jssupportticketform" id="jssupportticketform" method="post" action="<?php echo admin_url("admin.php?page=priority_priorities&task=priority_priorities"); ?>">
	<?php echo formfield::text('title',jssupportticket::$_data['prioritytitle'],array('class'=>'inputbox','placeholder'=>__('TITLE','js-support-ticket'))); ?>
	<?php echo formfield::submitbutton(__('GO','js-support-ticket'),__('GO','js-support-ticket'),array('class'=>'button')); ?>
	<?php echo formfield::button(__('RESET','js-support-ticket'),__('RESET','js-support-ticket'),array('class'=>'button','onclick'=>'resetFrom();')); ?>
</form>
<a class="js-add-link button" href="?page=priority_priorities&task=priority_addpriority"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/add_icon.png" /><?php echo __('ADD_PRIORITY','js-support-ticket'); ?></a>
<?php
  	if(!empty(jssupportticket::$_data[0])){ ?>
			<table id="js-support-ticket-table">
  				<tr>
			    	<th class="left"><?php echo __('TITLE','js-support-ticket'); ?></th>
			        <th><?php echo __('PUBLIC','js-support-ticket'); ?></th>
			        <th><?php echo __('DEFAULT','js-support-ticket'); ?></th>
			        <th><?php echo __('COLOR','js-support-ticket'); ?></th>
			    	<th><?php echo __('ACTION','js-support-ticket'); ?></th>
  				</tr>
<?php
		foreach(jssupportticket::$_data[0] AS $priority){	
			$isdefault = ($priority->isdefault == 1) ? 'yes.png': 'no.png';
			$ispublic = ($priority->ispublic == 1) ? 'yes.png': 'no.png';
?>
			    <tr>
					<td class="left"><a href="?page=priority_priorities&task=priority_addpriority&jssupportticket_priorityid=<?php echo $priority->id; ?>"><?php echo $priority->priority; ?></a></td>
			    	<td><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/<?php echo $ispublic; ?>" /></td>
			    	<td><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/<?php echo $isdefault; ?>" /></td>
			    	<td style="background:<?php echo $priority->prioritycolour; ?>;color:#ffffff;"><?php echo $priority->prioritycolour; ?></td>
			     	<td>
				     	<a href="?page=priority_priorities&task=priority_addpriority&jssupportticket_priorityid=<?php echo $priority->id; ?>" alt=""><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/edit.png" /></a>&nbsp;&nbsp;
				     	<a href="?page=priority_priorities&task=priority_deletepriority&action=deleteitem&priorityid=<?php echo $priority->id; ?>"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/remove.png" /></a>
			     	</td>
				</tr>
<?php				
		}
?>		
			</table>
<?php			
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