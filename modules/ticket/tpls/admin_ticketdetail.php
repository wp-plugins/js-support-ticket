<?php 
  message::getMessage(); 
  wp_enqueue_script('file_validate.js',jssupportticket::$_pluginpath.'includes/js/file_validate.js');
?>
<script type="text/javascript">
  jQuery(document).ready(function($) {
    jQuery("#tk_attachment_add").click(function(){
      var obj=this;
      var current_files=jQuery('input[type="file"]').length;
      var total_allow=<?php echo jssupportticket::$_config['no_of_attachement']; ?>;
      var append_text="<span class='tk_attachment_value_text'><input name='filename[]' type='file' onchange=\"uploadfile(this,'<?php echo jssupportticket::$_config['file_maximum_size']; ?>','<?php echo jssupportticket::$_config['file_extension']; ?>');\" size='20' maxlenght='30'  /><span  class='tk_attachment_remove'></span></span>";
      if(current_files < total_allow ){
        jQuery(".tk_attachment_value_wrapperform").append(append_text);
      }else if((current_files === total_allow) || (current_files > total_allow)){
        alert('<?php _e('FILE_UPLOAD_LIMIT_EXCEED','js-support-ticket'); ?>');
        obj.hide();
      }
    });
    jQuery( document ).delegate( ".tk_attachment_remove", "click", function( e ) {
      jQuery(this).parent().remove();
      var current_files=jQuery('input[type="file"]').length;
      var total_allow=<?php echo jssupportticket::$_config['no_of_attachement']; ?>;
      if(current_files < total_allow ){
        jQuery("#tk_attachment_add").show();
      }
    });
    jQuery("a#showhidedetail").click(function(e){
      e.preventDefault();
      var divid = jQuery(this).attr('data-divid');
      jQuery("div#"+divid).slideToggle();
      jQuery(this).find('img').toggleClass('js-hidedetail');
    });
  });
</script>
<span style="display:none" id="filesize"><?php echo __('ERROR_FILE_SIZE_TO_LARGE','js-support-ticket');?></span>
<span style="display:none" id="fileext"><?php echo __('ERROR_FILE_EXT_MISMATCH','js-support-ticket');?></span>
<span class="js-admin-title"><?php echo __('TICKET_DETAILS','js-support-ticket'); ?></span>
<?php
	if(!empty(jssupportticket::$_data[0])){
  if(jssupportticket::$_data[0]->lock==1){
    $style ="darkred;";
    $status = __('LOCK','js-support-ticket');
  }elseif(jssupportticket::$_data[0]->status==0){
    $style ="red;";
    $status = __('NEW','js-support-ticket');
  }elseif(jssupportticket::$_data[0]->status==1){
    $style = "orange;";
    $status = __('WAITING_REPLY','js-support-ticket');
  }elseif(jssupportticket::$_data[0]->status==2){
    $style = "#FF7F50;";
    $status = __('IN_PROGRESS','js-support-ticket');
  }elseif(jssupportticket::$_data[0]->status==3){
    $style ="green;";
    $status = __('REPLIED','js-support-ticket');
  }elseif(jssupportticket::$_data[0]->status==4){
    $style = "blue;";
    $status = __('CLOSED','js-support-ticket');
  }
  $cur_uid = get_current_user_id();
?>	
<form method="post" action="<?php echo admin_url("?page=reply_replies&task=reply_savereply&action=admin_savereply"); ?>" id="adminTicketform" enctype="multipart/form-data">
  
  <div class="js-col-md-12 js-ticket-detail-wrapper">
    <div class="js-row js-ticket-topbar">
      <div class="js-col-md-5 js-openclosed">
        <div class="js-col-md-4 js-ticket-openclosed">
          <?php echo (jssupportticket::$_data[0]->status == 4) ? __('CLOSED','js-support-ticket'):__('OPEN','js-support-ticket');?>
        </div>
        <div class="js-col-md-8">
          Calculate how to set due in 4 days by joomla's code.
        </div>
      </div>
      <div class="js-col-md-4">
        <div class="js-row js-margin-bottom">
          <div class="js-col-md-6 js-ticket-title"><?php echo __('TICKET_ID','js-support-ticket'); ?></div>
          <div class="js-col-md-5 js-ticket-value js-border-box"><?php echo jssupportticket::$_data[0]->ticketid; ?></div>
        </div>
        <div class="js-row">
          <div class="js-col-md-6 js-ticket-title"><?php echo __('PRIORITY','js-support-ticket'); ?></div>
          <div class="js-col-md-5 js-ticket-value" style="color:#ffffff;background:<?php echo jssupportticket::$_data[0]->prioritycolour; ?>;"><?php echo jssupportticket::$_data[0]->priority; ?></div>
        </div>
      </div>
      <div class="js-col-md-3 js-last-left">
        <div class="js-row">
          <div class="js-col-md-6 js-ticket-title"><?php echo __('LAST_REPLY','js-support-ticket'); ?></div>
          <div class="js-col-md-6 js-ticket-value"><?php if(empty(jssupportticket::$_data[0]->lastreply) || jssupportticket::$_data[0]->lastreply == '0000-00-00 00:00:00' ) echo __('NO_LAST_REPLY','js-support-ticket'); else echo date(jssupportticket::$_config['date_format'],strtotime(jssupportticket::$_data[0]->lastreply)); ?></div>
        </div>
        <div class="js-row">
          <div class="js-col-md-6 js-ticket-title"><?php echo __('CREATED','js-support-ticket'); ?></div>
          <div class="js-col-md-6 js-ticket-value"><?php echo date(jssupportticket::$_config['date_format'],strtotime(jssupportticket::$_data[0]->created)); ?></div>
        </div>
      </div>
    </div>
    <div class="js-row js-ticket-middlebar">
      <div class="js-col-md-8">
        <div class="js-col-md-12">
          <span class="js-ticket-title"><?php echo __('SUBJECT','js-support-ticket'); ?>&nbsp;:&nbsp;</span>
          <span class="js-ticket-value"><?php echo jssupportticket::$_data[0]->subject; ?></span>
        </div>
        <div class="js-col-md-12">
          <span class="js-ticket-title"><?php echo __('FROM','js-support-ticket'); ?>&nbsp;:&nbsp;</span>
          <span class="js-ticket-value"><?php echo jssupportticket::$_data[0]->name; ?></span>
        </div>
        <div class="js-col-md-12">
          <span class="js-ticket-title"><?php echo __('DEPARTMENT','js-support-ticket'); ?>&nbsp;:&nbsp;</span>
          <span class="js-ticket-value"><?php echo jssupportticket::$_data[0]->departmentname; ?></span>
        </div>
      </div>
      <div class="js-col-md-4 js-button-margin">
        <a class="button" href="?page=ticket_tickets&task=ticket_closeticket&action=deleteitem&ticketid=<?php echo jssupportticket::$_data[0]->id; ?>"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/remove.png" /><?php echo __('CLOSE_TICKET','js-support-ticket'); ?></a>
        <a class="button" href="?page=ticket_tickets&task=ticket_addticket&jssupportticket_ticketid=<?php echo jssupportticket::$_data[0]->id; ?>"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/edit.png" /><?php echo __('EDIT_TICKET','js-support-ticket'); ?></a>
      </div>
    </div>
    <div class="js-row js-ticket-requester"><?php echo __('REQUESTER_INFO','js-support-ticket'); ?></div>
    <div class="js-row js-ticket-bottombar">
      <div class="js-col-md-5">
        <img src="<?php echo jssupportticket::$_pluginpath.'includes/images/smallticketman.png';?>" />
        <?php echo jssupportticket::$_data[0]->name; ?>
      </div>
      <div class="js-col-md-5">
        <img src="<?php echo jssupportticket::$_pluginpath.'includes/images/smallmail.png';?>" />
        <?php echo jssupportticket::$_data[0]->email; ?>
      </div>
      <div class="js-col-md-2">
        <a href="#" id="showhidedetail" data-divid="js-hidden-ticket-data"><img class="js-showdetail" src="<?php echo jssupportticket::$_pluginpath.'includes/images/showhide.png';?>" /><?php echo __('SHOW_DETAIL','js-support-ticket'); ?></a>
      </div>
      <div id="js-hidden-ticket-data">
        <div class="js-row js-ticket-requester"><?php echo __('MORE_DETAIL','js-support-ticket'); ?></div>
        <div class="js-row">
          <div class="js-col-md-4 js-ticket-moredetail">
            <div class="js-col-md-6 js-ticket-data-title"><?php echo __('PHONE','js-support-ticket'); ?></div>
            <div class="js-col-md-6 js-ticket-data-value"><?php echo jssupportticket::$_data[0]->phone; ?></div>
          </div>
          <?php
            foreach(jssupportticket::$_data[2] as $ufield){
              echo '<div class="js-col-md-4 js-ticket-moredetail">';
              $userfield = $ufield[0];
              echo '<div class="js-col-md-6 js-ticket-data-title">'. $userfield->title .'</div>';
              if ($userfield->type == "checkbox"){
                if(isset($ufield[1])){ $fvalue = $ufield[1]->data; $userdataid = $ufield[1]->id;}  else {$fvalue=""; $userdataid = ""; }
                if ($fvalue == '1') $fvalue = __('TRUE','js-support-ticket'); else $fvalue = __('FALSE','js-support-ticket');
              }elseif ($userfield->type == "select"){
                if(isset($ufield[2])){ $fvalue = $ufield[2]->fieldtitle; $userdataid = $ufield[2]->id;} else {$fvalue=""; $userdataid = ""; }
              }else{
                if(isset($ufield[1])){ $fvalue = $ufield[1]->data; $userdataid = $ufield[1]->id;}  else {$fvalue=""; $userdataid = ""; }
              }
              if($fvalue == "") $fvalue = __('NOT_FILLED','js-support-ticket');
              echo '<div class="js-col-md-6 js-ticket-data-value">'.$fvalue.'</div></div>';
            }
            ?>
        </div>
      </div>
    </div>
  </div>
  <span class="js-admin-title"><?php echo __('TICKET_THREAD','js-support-ticket'); ?></span>
  <div class="js-col-md-2 js-ticket-thread-pic"><img src="<?php echo jssupportticket::$_pluginpath.'/includes/images/ticketmanbig.png'; ?>" /></div>
  <div class="js-col-md-10 js-ticket-thread-wrapper colored">
    <div class="js-ticket-detail-corner"></div>
    <div class="js-ticket-thread-upperpart">
      <span class="js-ticket-thread-replied"><?php echo __('REPLIED_BY','js-support-ticket'); ?>&nbsp;:&nbsp;</span>
      <span class="js-ticket-thread-person"><?php echo jssupportticket::$_data[0]->name; ?></span>
      <span class="js-ticket-thread-date">(&nbsp;<?php echo date("l F d, Y, h:i:s",strtotime(jssupportticket::$_data[0]->created)); ?>&nbsp;)</span>
    </div>
    <div class="js-ticket-thread-middlepart">
      <?php echo jssupportticket::$_data[0]->message; ?>
    </div>
      <?php
        if(!empty(jssupportticket::$_data['ticket_attachment'])){
          $datadirectory = jssupportticket::$_config['data_directory'];
          $path = 'wp-content/plugins/js-support-ticket/'.$datadirectory;
          $path= $path . '/attachmentdata';
          $path= $path . '/ticket/ticket_'.jssupportticket::$_data[0]->id.'/';
          foreach(jssupportticket::$_data['ticket_attachment'] AS $attachment){
            echo '
              <div class="js_ticketattachment">
                '.$attachment->filename.' ( '.$attachment->filesize.' ) '.'              
                <a class="button" target="_blank" href="'.site_url($path.$attachment->filename).'">'.__('DOWNLOAD','js-support-ticket').'</a>
              </div>';
          }
        }
      ?>
  </div>
  <?php 
    $colored = "colored";
    if(!empty(jssupportticket::$_data[4]))
      foreach(jssupportticket::$_data[4] AS $reply): 
        if($cur_uid == $reply->uid) $colored = '';
  ?>
        <div class="js-col-md-2 js-ticket-thread-pic"><img src="<?php echo jssupportticket::$_pluginpath.'/includes/images/ticketmanbig.png'; ?>" /></div>
        <div class="js-col-md-10 js-ticket-thread-wrapper <?php echo $colored; ?>">
          <div class="js-ticket-detail-corner"></div>
          <div class="js-ticket-thread-upperpart">
            <span class="js-ticket-thread-replied"><?php echo __('REPLIED_BY','js-support-ticket'); ?>&nbsp;:&nbsp;</span>
            <span class="js-ticket-thread-person"><?php echo $reply->name; ?></span>
            <span class="js-ticket-thread-date">(&nbsp;<?php echo date("l F d, Y, h:i:s",strtotime($reply->created)); ?>&nbsp;)</span>
          </div>
          <div class="js-ticket-thread-middlepart">
            <?php echo $reply->message; ?>
          </div>
            <?php
              if(!empty($reply->attachments)){
                $datadirectory = jssupportticket::$_config['data_directory'];
                $path = 'wp-content/plugins/js-support-ticket/'.$datadirectory;
                $path= $path . '/attachmentdata';
                $path= $path . '/ticket/ticket_'.jssupportticket::$_data[0]->id.'/';
                foreach($reply->attachments AS $attachment){
                  echo '
                    <div class="js_ticketattachment">
                      '.$attachment->filename.' ( '.$attachment->filesize.' ) '.'
                      <a class="button" target="_blank" href="'.site_url($path.$attachment->filename).'">'.__('DOWNLOAD','js-support-ticket').'</a>
                    </div>';
                }
              }
            ?>
        </div>
  <?php endforeach; ?>
  <?php // Reply Area ?>
  <span class="js-admin-title"><?php echo __('REPLY','js-support-ticket'); ?></span>
  <div id="postreply">
    <div class="js-form-wrapper">
      <div class="js-form-title"><label id="responcemsg" for="responce"><?php echo __('RESPONSE','js-support-ticket'); ?><font color="red">*</font></label></div>
      <div class="js-form-field"><?php echo wp_editor('','message',array( 'media_buttons' => false ));?></div>
    </div>
    <div class="js-form-wrapper">
      <div class="js-form-title"><?php echo __('ATTACHMENTS','js-support-ticket'); ?></div>
      <div class="js-form-field">
        <div class="tk_attachment_value_wrapperform">
            <span class="tk_attachment_value_text">
                <input type="file" class="inputbox" name="filename[]" onchange="uploadfile(this,'<?php echo jssupportticket::$_config['file_maximum_size']; ?>','<?php echo jssupportticket::$_config['file_extension']; ?>');" size="20" maxlenght='30'/>
                <span class='tk_attachment_remove'></span>
            </span>
        </div>
        <span class="tk_attachments_configform">
            <small><?php _e('MAXIMUM_FILE_SIZE','js-support-ticket'); echo ' ('.jssupportticket::$_config['file_maximum_size']; ?>KB)<br><?php _e('FILE_EXTENSION_TYPE','js-support-ticket'); echo ' ('.jssupportticket::$_config['file_extension'].')'; ?></small>
        </span>
        <div class="js-md-col-12"><span id="tk_attachment_add" class="tk_attachments_addform"><?php _e('ADD_MORE_FILE','js-support-ticket'); ?></span></div>
      </div>
    </div>
    <div class="js-form-button">
      <?php echo formfield::submitbutton('postreply',__('POST_REPLY','js-support-ticket'),array('class'=>'button')); ?>
    </div>      
  </div>

  <?php echo formfield::hidden('ticketid',jssupportticket::$_data[0]->id); ?>
  <?php echo formfield::hidden('created',jssupportticket::$_data[0]->created); ?>
  <?php echo formfield::hidden('uid', get_current_user_id() ); ?>
  <?php echo formfield::hidden('updated',jssupportticket::$_data[0]->updated); ?>
  <?php echo formfield::hidden('action','reply_savereply'); ?>
  <?php echo formfield::hidden('form_request','jssupportticket'); ?>

</form>
<?php }
?>