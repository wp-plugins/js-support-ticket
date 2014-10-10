<script type="text/javascript">
	function resetFrom(){
		document.getElementById('email').value = ''; 
		document.getElementById('jssupportticketform').submit();
	}
</script>
<?php message::getMessage();?>
<span class="js-admin-title"><?php echo __('SYSTEM_EMAILS','js-support-ticket'); ?></span>
<form class="js-filter-form" name="jssupportticketform" id="jssupportticketform" method="post" action="<?php echo admin_url("admin.php?page=email_emails&task=email_emails"); ?>">
	<input name="email" id="email" placeholder="<?php echo __('EMAIL_ADDRESS','js-support-ticket'); ?>" type="text" value="<?php echo jssupportticket::$_data['email']; ?>" />
	<input type="submit" value="Go" name="btnsubmit"/>
	<input type="button" value="Reset" onclick="resetFrom();" />
</form>
<a class="js-add-link button" href="?page=email_emails&task=email_addemail"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/add_icon.png" /><?php echo __('ADD_EMAIL','js-support-ticket'); ?></a>
<?php
  	if(!empty(jssupportticket::$_data[0])){
?>  		
		<table id="js-support-ticket-table">
			<tr>
		    	<th class="left"><?php echo __('EMAIL_ADDRESS','js-support-ticket'); ?></th>
		        <th><?php echo __('AUTORESPONSE','js-support-ticket'); ?></th>
		    	<th><?php echo __('PRIORITY','js-support-ticket'); ?></th>
		    	<th><?php echo __('CREATED','js-support-ticket'); ?></th>
		    	<th><?php echo __('ACTION','js-support-ticket'); ?></th>
			</tr>
<?php		
		foreach(jssupportticket::$_data[0] AS $email){	
			$autoresponse = ($email->autoresponse == 1) ? 'yes.png': 'no.png';
?>			
		    <tr>
				<td class="left"><a href="?page=email_emails&task=email_addemail&jssupportticket_emailid=<?php echo $email->id; ?>"><?php echo $email->email; ?></a></td>
		    	<td><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/<?php echo $autoresponse; ?>" /></td>
		    	<td><?php echo $email->priority; ?></td>
		    	<td><?php echo date(jssupportticket::$_config['date_format'],strtotime($email->created)); ?></td>
		     	<td>
		     		<a href="?page=email_emails&task=email_addemail&jssupportticket_emailid=<?php echo $email->id; ?>"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/edit.png" /></a>
		     		<a href="?page=email_emails&task=email_deleteemail&action=deleteitem&emailid=<?php echo $email->id; ?>"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/remove.png" /></a>
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
<?php	}	
?>
