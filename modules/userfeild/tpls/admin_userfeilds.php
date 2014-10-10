<script type="text/javascript">
	function resetFrom(){
		document.getElementById('fieldname').value = ''; 
		document.getElementById('jssupportticketform').submit();
	}
</script>
<?php message::getMessage();?>
<span class="js-admin-title">User Feilds</span>
<form class="js-filter-form" name="jssupportticketform" id="jssupportticketform" method="post" action="<?php echo admin_url("admin.php?page=userfeild_userfeilds&task=userfeild_userfeilds"); ?>">
	<?php echo formfield::text('fieldname',jssupportticket::$_data['fieldname'],array('class'=>'inputbox','placeholder'=>__('FIELD_NAME','js-support-ticket'))); ?>
	<?php echo formfield::submitbutton(__('GO','js-support-ticket'),__('GO','js-support-ticket'),array('class'=>'button')); ?>
	<?php echo formfield::button(__('RESET','js-support-ticket'),__('RESET','js-support-ticket'),array('class'=>'button','onclick'=>'resetFrom();')); ?>
</form>
<a class="js-add-link button" href="?page=userfeild_userfeilds&task=userfeild_adduserfeild"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/add_icon.png" /><?php echo __('ADD_USER_FIELD','js-support-ticket'); ?></a>
<?php
  	if(!empty(jssupportticket::$_data[0])){
?>  		
		<table id="js-support-ticket-table">
			<tr>
				<th class="left"><?php echo __('FIELD_NAME','js-support-ticket'); ?></th>
			    <th><?php echo __('FIELD_TITLE','js-support-ticket'); ?></th>
				<th><?php echo __('FIELD_TYPE','js-support-ticket'); ?></th>
				<th><?php echo __('REQUIRED','js-support-ticket'); ?></th>
				<th><?php echo __('READ_ONLY','js-support-ticket'); ?></th>
				<th><?php echo __('PUBLISHED','js-support-ticket'); ?></th>
				<th><?php echo __('ACTION','js-support-ticket'); ?></th>
			</tr>
<?php  				
		foreach(jssupportticket::$_data[0] AS $userfeild){	
			$published = ($userfeild->published == 1) ? 'yes.png': 'no.png';
			$required = ($userfeild->required == 1) ? 'yes.png': 'no.png';
			$readonly = ($userfeild->readonly == 1) ? 'yes.png': 'no.png';
?>			
		    <tr>
				<td class="left"><a href="?page=userfeild_userfeilds&task=userfeild_adduserfeild&jssupportticket_userfeildid=<?php echo $userfeild->id; ?>"><?php echo $userfeild->name; ?></a></td>
				<td><?php echo $userfeild->title; ?></td>
				<td><?php echo $userfeild->type; ?></td>
		    	<td><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/<?php echo $required ; ?>" /></td>
		    	<td><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/<?php echo $readonly; ?>" /></td>
		    	<td><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/<?php echo $published; ?>" /></td>
		     	<td>
		     		<a href="?page=userfeild_userfeilds&task=userfeild_adduserfeild&jssupportticket_userfeildid=<?php echo $userfeild->id; ?>"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/edit.png" /></a>
		     		<a href="?page=userfeild_userfeilds&task=userfeild_deleteuserfeild&action=deleteitem&userfeildid=<?php echo $userfeild->id; ?>"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/remove.png" /></a>
		     	</td>
		    	
			</tr>
<?php				
		}
?>
		</table>		
<?php
		if (isset(jssupportticket::$_data[1])) {
		    echo '<div style="margin: 1em 0">' . jssupportticket::$_data[1] .'</div>';
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
