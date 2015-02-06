<script type="text/javascript">
		function resetFrom(){
			document.getElementById('email').value = ''; 
			document.getElementById('jssupportticketform').submit();
		}
	</script>
	<?php JSSTmessage::getMessage();?>
	<span class="js-admin-title"><?php echo __('SYSTEM_EMAILS','js-support-ticket'); ?></span>
	<span class="js-admin-infotitle"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/infoicon.png" /><?php echo __('SYSTEM_EMAILS_USED_FOR_SENDING_EMAIL','js-support-ticket'); ?></span>
	<form class="js-filter-form" name="jssupportticketform" id="jssupportticketform" method="post" action="<?php echo admin_url("admin.php?page=email&layout=emails"); ?>">
		<?php echo JSSTformfield::text('email',jssupportticket::$_data['filter']['email'],array('placeholder'=>__('EMAIL','js-support-ticket'))); ?>
		<?php echo JSSTformfield::hidden('JSST_form_search','JSST_SEARCH'); ?>
		<?php echo JSSTformfield::submitbutton('go',__('SEARCH','js-support-ticket'),array('class'=>'button')); ?>
		<?php echo JSSTformfield::button('reset',__('RESET','js-support-ticket'),array('class'=>'button','onclick'=>'resetFrom();')); ?>
	</form>
	<a class="js-add-link button" href="?page=email&layout=addemail"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/add_icon.png" /><?php echo __('ADD_EMAIL','js-support-ticket'); ?></a>
	<?php
  	if(!empty(jssupportticket::$_data[0])){ ?>  		
		<div class="js-filter-form-list">
			<div class="js-filter-form-head js-filter-form-head-xs">
		    	<div class="js-col-xs-12 js-col-md-6 first"><?php echo __('EMAIL_ADDRESS','js-support-ticket'); ?></div>
		        <div class="js-col-xs-12 js-col-md-2 js-textaligncenter second"><?php echo __('AUTORESPONSE','js-support-ticket'); ?></div>
		    	<!-- <div class="js-col-xs-12 js-col-md-2 third"><?php /* echo __('PRIORITY','js-support-ticket'); */ ?></div> -->
		    	<div class="js-col-xs-12 js-col-md-2 fourth"><?php echo __('CREATED','js-support-ticket'); ?></div>
		    	<div class="js-col-xs-12 js-col-md-2 fifth"><?php echo __('ACTION','js-support-ticket'); ?></div>
			</div>
			<?php		
			foreach(jssupportticket::$_data[0] AS $email){	
				$autoresponse = ($email->autoresponse == 1) ? 'yes.png': 'no.png';
				?>			
			    <div class="js-filter-form-data">
					<div class="js-col-xs-12 js-col-md-6 first"><span class="js-filter-form-data-xs"><?php echo __('EMAIL_ADDRESS','js-support-ticket');echo " : "; ?></span><a href="?page=email&layout=addemail&jssupportticketid=<?php echo $email->id; ?>"><?php echo $email->email; ?></a></div>
			    	<div class="js-col-xs-12 js-col-md-2 js-textaligncenter  second"><span class="js-filter-form-data-xs"><?php echo __('AUTO_RESPONSE','js-support-ticket');echo " : "; ?></span><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/<?php echo $autoresponse; ?>" /></div>
			    	<!-- <div class="js-col-xs-12 js-col-md-2 third"><span class="js-filter-form-data-xs"><?php /* echo __('PRIORITY','js-support-ticket');echo " : "; ?></span><?php echo $email->priority; */ ?></div> -->
			    	<div class="js-col-xs-12 js-col-md-2 fourth"><span class="js-filter-form-data-xs"><?php echo __('CREATED','js-support-ticket');echo " : "; ?></span><?php echo date(jssupportticket::$_config['date_format'],strtotime($email->created)); ?></div>
			     	<div class="js-col-xs-12 js-col-md-2 fifth js-filter-form-action-hl-xs">
			     		<a href="?page=email&layout=addemail&jssupportticketid=<?php echo $email->id; ?>"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/edit.png" /></a>
			     		<a onclick="return confirm('<?php echo __('ARE_YOU_SURE_TO_DELETE','js-support-ticket'); ?>');" href="?page=email&task=deleteemail&action=jstask&emailid=<?php echo $email->id; ?>"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/remove.png" /></a>
			     	</div>
				</div>
			    <?php				
			}  ?>
		</div>
		<?php
		if ( jssupportticket::$_data[1] ) {
		    echo '<div class="tablenav"><div class="tablenav-pages" style="margin: 1em 0">' . jssupportticket::$_data[1] . '</div></div>';
		}
	}else{// User is guest
    	JSSTlayout::getNoRecordFound();
	}
?>
