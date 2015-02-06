
<script type="text/javascript">
	function resetFrom(){
		document.getElementById('name').value = ''; 
		document.getElementById('jssupportticketform').submit();
	}
</script>
<?php JSSTmessage::getMessage();?>
<span class="js-admin-title">User Feilds</span>
<form class="js-filter-form" name="jssupportticketform" id="jssupportticketform" method="post" action="<?php echo admin_url("admin.php?page=userfeild&layout=userfeilds"); ?>">
	<?php echo JSSTformfield::text('name',jssupportticket::$_data['filter']['name'],array('class'=>'inputbox','placeholder'=>__('FIELD_NAME','js-support-ticket'))); ?>
	<?php echo JSSTformfield::hidden('JSST_form_search','JSST_SEARCH'); ?>
	<?php echo JSSTformfield::submitbutton('go',__('SEARCH','js-support-ticket'),array('class'=>'button')); ?>
	<?php echo JSSTformfield::button(__('RESET','js-support-ticket'),__('RESET','js-support-ticket'),array('class'=>'button','onclick'=>'resetFrom();')); ?>
</form>
<a class="js-add-link button" href="?page=userfeild&layout=adduserfeild"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/add_icon.png" /><?php echo __('ADD_USER_FIELD','js-support-ticket'); ?></a>
<?php
  	if(!empty(jssupportticket::$_data[0])){
?>  	
		<div class="js-filter-form-list">
  				<div class="js-filter-form-head js-filter-form-head-xs">
			    	<div class="js-col-md-3 js-col-xs-12 first"><?php echo __('FIELD_NAME','js-support-ticket'); ?></div>
			    	<div class="js-col-md-3 js-col-xs-12 second js-textaligncenter"><?php echo __('FIELD_TITLE','js-support-ticket'); ?></div>
			    	<div class="js-col-md-1 js-col-xs-12 third js-textaligncenter"><?php echo __('TYPE','js-support-ticket'); ?></div>
			    	<div class="js-col-md-1 js-col-xs-12 fourth js-textaligncenter"><?php echo __('REQUIRED','js-support-ticket'); ?></div>
			    	<div class="js-col-md-1 js-col-xs-12 fifth"><?php echo __('READ_ONLY','js-support-ticket'); ?></div>
			    	<div class="js-col-md-1 js-col-xs-12 sixth"><?php echo __('PUBLISHED','js-support-ticket'); ?></div>
			    	<div class="js-col-md-2 js-col-xs-12 seventh"><?php echo __('ACTION','js-support-ticket'); ?></div>
				</div>	
		
<?php  				
		foreach(jssupportticket::$_data[0] AS $userfeild){	
			$published = ($userfeild->published == 1) ? 'yes.png': 'no.png';
			$required = ($userfeild->required == 1) ? 'yes.png': 'no.png';
			$readonly = ($userfeild->readonly == 1) ? 'yes.png': 'no.png';
?>			
			<div class="js-filter-form-data">
						<div class="js-col-md-3 js-col-xs-12 first"><span class="js-filter-form-data-xs"><?php echo __('FIELD_NAME','js-support-ticket');echo " : "; ?></span><a href="?page=userfeild&layout=adduserfeild&jssupportticketid=<?php echo $userfeild->id; ?>"><?php echo $userfeild->name; ?></a></div>
				    	<div class="js-col-md-3 js-col-xs-12 second js-textaligncenter"><span class="js-filter-form-data-xs"><?php echo __('FIELD_TITLE','js-support-ticket');echo " : "; ?></span><?php echo $userfeild->title; ?></div>
				    	<div class="js-col-md-1 js-col-xs-12 third js-textaligncenter"><span class="js-filter-form-data-xs"><?php echo __('TYPE','js-support-ticket');echo " : "; ?></span> <?php echo $userfeild->type; ?></div>
				    	<div class="js-col-md-1 js-col-xs-12 fourth js-textaligncenter"><span class="js-filter-form-data-xs"><?php echo __('REQUIRED','js-support-ticket');echo " : "; ?></span><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/<?php echo $required ; ?>" /></div>
				    	<div class="js-col-md-1 js-col-xs-12 fifth js-textaligncenter"><span class="js-filter-form-data-xs"><?php echo __('READ_ONLY','js-support-ticket');echo " : "; ?></span> <img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/<?php echo $readonly; ?>" /></div>
				    	<div class="js-col-md-1 js-col-xs-12 sixth js-textaligncenter"><span class="js-filter-form-data-xs"><?php echo __('PUBLISHED','js-support-ticket');echo " : "; ?></span><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/<?php echo $published; ?>" /></div>
				     	<div class="js-col-md-2 js-col-xs-12 seventh js-filter-form-action-hl-xs">
				     		<a href="?page=userfeild&layout=adduserfeild&jssupportticketid=<?php echo $userfeild->id; ?>"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/edit.png" /></a>
		     		<a onclick="return confirm('<?php echo __('ARE_YOU_SURE_TO_DELETE','js-support-ticket'); ?>');" href="?page=userfeild&task=deleteuserfeild&action=jstask&userfeildid=<?php echo $userfeild->id; ?>"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/remove.png" /></a>
		     	</div>
					</div>
		  
<?php				
		}
?>
</div>	
<?php
		if ( jssupportticket::$_data[1] ) {
		    echo '<div style="margin: 1em 0">' . jssupportticket::$_data[1] .'</div>';
		}
	}else{ // Record Not FOund
			JSSTlayout::getNoRecordFound();
	}	
?>
