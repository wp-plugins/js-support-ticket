<script type="text/javascript">
		function resetFrom(){
			document.getElementById('departmentname').value = ''; 
			document.getElementById('jssupportticketform').submit();
		}
</script>
<?php message::getMessage(); ?>
<span class="js-admin-title"><?php echo __('DEPARTMENT','js-support-ticket')?></span>
<form class="js-filter-form" name="jssupportticketform" id="jssupportticketform" method="post" action="<?php echo admin_url("admin.php?page=department_departments&task=department_departments"); ?>">
	<input name="departmentname" id="departmentname" type="text" placeholder="<?php echo __('DEPARTMENT_NAME','js-support-ticket'); ?>" value="<?php echo jssupportticket::$_data['departmentname']; ?>" />
	<input type="submit" value="<?php echo __('GO','js-support-ticket')?>" name="btnsubmit"/>
	<input type="button" value="<?php echo __('RESET','js-support-ticket')?>" onclick="resetFrom();" />
</form>
<a class="js-add-link button" href="?page=department_departments&task=department_adddepartment"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/add_icon.png" /><?php echo __('ADD_DEPARTMENT','js-support-ticket')?></a>
<?php
  	if(!empty(jssupportticket::$_data[0])){
?>  		
		<table id="js-support-ticket-table">
			<tr>
		    	<th class="left"><?php echo __('DEPARTMENT_NAME','js-support-ticket'); ?></th>
		        <th><?php echo __('TYPE','js-support-ticket'); ?></th>
		    	<th><?php echo __('OUTGOING_EMAIL','js-support-ticket'); ?></th>
		    	<th><?php echo __('STATUS','js-support-ticket'); ?></th>
		    	<th><?php echo __('CREATED','js-support-ticket'); ?></th>
		    	<th><?php echo __('ACTION','js-support-ticket'); ?></th>
			</tr>
<?php				
		foreach(jssupportticket::$_data[0] AS $department){	
			$type = ($department->ispublic == 1) ? __('PUBLIC','js-support-ticket'): __('PRIVATE','js-support-ticket');
			$status = ($department->status == 1) ? 'yes.png': 'no.png';
?>			
		    <tr>
				<td class="left"><a href="?page=department_departments&task=department_adddepartment&jssupportticket_departmentid=<?php echo $department->id; ?>"><?php echo $department->departmentname; ?></a></td>
		    	<td><?php echo $type; ?></td>
		    	<td class="left"><?php echo $department->outgoingemail; ?></td>
		    	<td><img src="<?php echo jssupportticket::$_pluginpath.'includes/images/'.$status; ?>" /></td>
		    	<td><?php echo date(jssupportticket::$_config['date_format'],strtotime($department->created)); ?></td>
		     	<td>
		     		<a href="?page=department_departments&task=department_adddepartment&jssupportticket_departmentid=<?php echo $department->id; ?>"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/edit.png" /></a>&nbsp;&nbsp;
		     		<a href="?page=department_departments&task=department_deletedepartment&action=deleteitem&departmentid=<?php echo $department->id; ?>"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/remove.png" /></a>
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
