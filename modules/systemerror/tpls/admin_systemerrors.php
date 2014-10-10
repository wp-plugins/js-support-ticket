<script type="text/javascript">
		function resetFrom(){
			document.getElementById('error').value = ''; 
			document.getElementById('jssupportticketform').submit();
		}
</script>
<?php message::getMessage();?>
<span class="js-admin-title"><?php echo __('SYSTEM_ERRORS','js-support-ticket'); ?></span>
<form class="js-filter-form" name="jssupportticketform" id="jssupportticketform" method="post" action="<?php echo admin_url("admin.php?page=systemerror_systemerrors&task=systemerror_systemerrors"); ?>">
	<input name="error" id="error" type="text" placeholder="<?php echo __('ERROR','js-support-ticket'); ?>" value="<?php echo jssupportticket::$_data['error']; ?>" />
	<input type="submit" value="Go" name="btnsubmit"/>
	<input type="button" value="Reset" onclick="resetFrom();" />
</form>
<?php
  	if(!empty(jssupportticket::$_data[0])){
?>  		
		<table id="js-support-ticket-table">
			<tr>
		    	<th class="left"><?php echo __('ERROR','js-support-ticket'); ?></th>
		        <th><?php echo __('VIEW','js-support-ticket'); ?></th>
		    	<th><?php echo __('CREATED','js-support-ticket'); ?></th>
			</tr>
<?php  				
		foreach(jssupportticket::$_data[0] AS $systemerror){	
			$isview = ($systemerror->isview == 1) ? 'no.png': 'yes.png';
?>			
		    <tr>
				<td class="left"><?php echo $systemerror->error; ?></td>
		    	<td><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/<?php echo $isview; ?>" /></td>
		    	<td><?php echo date(jssupportticket::$_config['date_format'],strtotime($systemerror->created)); ?></td>
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
