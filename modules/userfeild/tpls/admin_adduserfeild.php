<?php
  if( get_current_user_id() != 0 ){
?>
<script type="text/javascript">
    function getObject(obj) {
      var strObj;
      if (document.all) {
        strObj = document.all.item(obj);
      } else if (document.getElementById) {
        strObj = document.getElementById(obj);
      }
      return strObj;
    }

    function insertRow() {
      var oTable = getObject("fieldValuesBody");
      var oRow, oCell ,oCellCont, oInput;
      var i, j;
      i=jQuery("#valueCount").val();
      i++;
      // Create and insert rows and cells into the first body.
      oRow = document.createElement("TR");
      jQuery(oRow).attr('id',"jstickets_trcust"+i);
      oTable.appendChild(oRow);

      oCell = document.createElement("TD");
      oInput=document.createElement("INPUT");
      oInput.name="jsNames["+i+"]";
      oInput.setAttribute('id',"jsNames_"+i);
      oCell.appendChild(oInput);
      oRow.appendChild(oCell);

      oCell = document.createElement("TD");
      oInput=document.createElement("INPUT");
      oInput.name="jsValues["+i+"]";
                  oInput.setAttribute('id',"jsValues_"+i);
      oCell.appendChild(oInput);
                  
      oSpan=document.createElement("SPAN");
      oSpan.setAttribute('style',"float:right;padding:4px;background:#b31212;");
      jQuery(oSpan).click(function(){
        jQuery('#jstickets_trcust'+i).remove();
        jQuery("#valueCount").val(jQuery("#valueCount").val() - 1);
      });
      oCell.appendChild(oSpan);
      oRow.appendChild(oCell);
      oInput.focus();
      jQuery("#valueCount").val(i);
    }

    function disableAll() {
      jQuery("#divValues").slideUp();
      jQuery("#divColsRows").slideUp();
      jQuery("#divText").slideUp();
    }
    function toggleType( type ) {
      disableAll();
      setTimeout( 'selType( \'' + type + '\' )', 650 );
    }
    function selType(sType) {
      var elem;

      switch (sType) {
        case 'editorta':
        case 'textarea':
          jQuery("#divText").slideDown();
          jQuery("#divColsRows").slideDown();
        break;
        case 'emailaddress':
        case 'password':
        case 'text':
          jQuery("#divText").slideDown();
        break;
        case 'select':
        case 'multiselect':
          jQuery("#divValues").slideDown();
        break;
        case 'radio':
        case 'multicheckbox':
          jQuery("#divColsRows").slideDown();
          jQuery("#divValues").slideDown();
        break;
        case 'delimiter':
        default:

      }
    }

    jQuery(document).ready(function(){
        toggleType(jQuery('#type').val());
    });
    jQuery("span.jquery_span_closetr").each(function(){
      var span = jQuery(this);
      jQuery(span).click(function(){
        var span_current=jQuery(this);
        if(jQuery(span_current).attr('data-optionid')!='undefined'){
          jQuery.post("index.php?option=com_jstickets&c=tickets&task=deleteuserfieldoption",{id:jQuery(span_current).attr('data-optionid')},function(data){
            if(data){
              var tr_id=jQuery(span_current).attr('data-rowid');
              jQuery('#'+tr_id).remove();
              document.adminForm.valueCount.value=document.adminForm.valueCount.value-1;
            }else{
              alert('<?php echo __('JS_OPTION_VALUE_IN_USE','js-support-ticket');?>');
              
            }
            
          });
        }else{
          var tr_id=jQuery(span_current).attr('data-rowid');
          jQuery('#'+tr_id).remove();
          document.adminForm.valueCount.value=document.adminForm.valueCount.value-1;
        }
      });
    });
</script>
<span class="js-admin-title"><?php echo __('ADD_NEW_USER_FIELD','js-support-ticket'); ?></span>
<form method="post" action="<?php echo admin_url("admin.php?page=userfeild_userfeilds&task=userfeild_saveuserfeild&action=admin_saveuserfeild"); ?>" id="adminForm">
		<div class="js-form-wrapper">
			<div class="js-form-title"><?php echo __('FIELD_TYPE','js-support-ticket'); ?></div>
			<div class="js-form-field"><?php echo formfield::select('type',array((object)array('id'=> 'text','text'=>__('TEXT_FIELD','js-support-ticket')),(object)array('id' => 'select','text'=> __('DROP_DOWN','js-support-ticket')),(object)array('id' => 'email','text'=> __('EMAIL_ADDRESS','js-support-ticket')),(object)array('id' => 'checkbox','text'=> __('CHECK_BOX','js-support-ticket')),(object)array('id' => 'date','text'=> __('DATE','js-support-ticket')),(object)array('id' => 'textarea','text'=> __('TEXT_AREA','js-support-ticket'))),isset(jssupportticket::$_data[0][0]->type) ? jssupportticket::$_data[0][0]->type : '','',array('onchange'=>'toggleType(this.options[this.selectedIndex].value);'));?></td>
		</div>
		<div class="js-form-wrapper">
			<div class="js-form-title"><?php echo __('FIELD_NAME','js-support-ticket'); ?></div>
			<div class="js-form-field"><?php echo formfield::text('name',isset(jssupportticket::$_data[0][0]->name) ? jssupportticket::$_data[0][0]->name : '',array('mosReq'=>'1','mosLabel'=>'Name'));?></div>
		</div>
		<div class="js-form-wrapper">
			<div class="js-form-title"><?php echo __('FIELD_TITLE','js-support-ticket'); ?></div>
			<div class="js-form-field"><?php echo formfield::text('title',isset(jssupportticket::$_data[0][0]->title) ? jssupportticket::$_data[0][0]->title : '',array('class'=>'inputbox')) ?></td>
		</div>
		<div class="js-form-wrapper">
			<div class="js-form-title"><?php echo __('REQUIRED','js-support-ticket'); ?></div>
			<div class="js-form-field"><?php echo formfield::select('required',array((object)array('id'=> '1','text'=>__('YES','js-support-ticket')),(object)array('id' => '2','text'=> __('NO','js-support-ticket'))),isset(jssupportticket::$_data[0][0]->required) ? jssupportticket::$_data[0][0]->required : '');?></div>
		</div>
		<div class="js-form-wrapper">
			<div class="js-form-title"><?php echo __('READ_ONLY','js-support-ticket'); ?></div>
			<div class="js-form-field"><?php echo formfield::select('readonly',array((object)array('id'=> '1','text'=>__('YES','js-support-ticket')),(object)array('id' => '2','text'=> __('NO','js-support-ticket'))),isset(jssupportticket::$_data[0][0]->readonly) ? jssupportticket::$_data[0][0]->readonly : '');?></div>
		</div>
		<div class="js-form-wrapper">
      <div class="js-form-title"><?php echo __('PUBLISHED','js-support-ticket'); ?></div>
      <div class="js-form-field"><?php echo formfield::select('published',array((object)array('id'=> '1','text'=>__('YES','js-support-ticket')),(object)array('id' => '2','text'=> __('NO','js-support-ticket'))),isset(jssupportticket::$_data[0][0]->published) ? jssupportticket::$_data[0][0]->published : '');?></div>
    </div>
		<div class="js-form-wrapper">
			<div class="js-form-title"><?php echo __('FIELD_SIZE','js-support-ticket'); ?></div>
			<div class="js-form-field"><?php echo formfield::text('size',isset(jssupportticket::$_data[0][0]->size) ? jssupportticket::$_data[0][0]->size : '',array('class'=>'inputbox')) ?></div>
		</div>
		<div id="page1"></div>
			<div id="divText">
				<div class="js-form-wrapper">
					<div class="js-form-title"><?php echo __('MAX_LENGTH','js-support-ticket'); ?></div>
					<div class="js-form-field"><?php echo formfield::text('maxlength',isset(jssupportticket::$_data[0][0]->maxlenth) ? jssupportticket::$_data[0][0]->maxlenth : '',array('class'=>'inputbox')) ?></div>
				</div>
			</div>
			<div id="divColsRows">
				<div class="js-form-wrapper">
					<div class="js-form-title"><?php echo __('COLUMNS','js-support-ticket'); ?></div>
					<div class="js-form-field"><?php echo formfield::text('cols',isset(jssupportticket::$_data[0][0]->cols) ? jssupportticket::$_data[0][0]->cols : '',array('class'=>'inputbox')) ?></div>
				</div>
				<div class="js-form-wrapper">
					<div class="js-form-title"><?php echo __('ROWS','js-support-ticket'); ?></div>
					<div class="js-form-field"><?php echo formfield::text('rows',isset(jssupportticket::$_data[0][0]->rows) ? jssupportticket::$_data[0][0]->rows : '',array('class'=>'inputbox')) ?></div>
				</div>
			</div>
			<div id="divValues">
				<div><?php echo __('USE_THE_TABLE_BELOW_TO_ADD_NEW_VALUES','js-support-ticket'); ?></div>
				<input type="button" class="button" onclick="insertRow();" value="<?php echo __('ADD_A_VALUE','js-support-ticket'); ?>" />
				<table align=left id="divFieldValues" cellpadding="4" cellspacing="1" border="0" width="100%" class="adminform" >
				<thead>
					<th class="title" width="20%"><?php echo __('TITLE','js-support-ticket'); ?></th>
					<th class="title" width="80%"><?php echo __('VALUE','js-support-ticket'); ?></th>
				</thead>
				<tbody id="fieldValuesBody">
				<tr>
					<td>&nbsp;</td>
				</tr>
				<?php
					$i = 0;
          if(isset(jssupportticket::$_data[0][0])){
              if (jssupportticket::$_data[0][0]->type == 'select') {
                      foreach (jssupportticket::$_data[1] as $value){	?>
                              <tr id="jstickets_trcust<?php echo $i; ?>">
                                      <input type="hidden" value="<?php echo $value->id; ?>" name="jsIds[<?php echo $i; ?>]" />
                                      <td width="20%"><input type="text" value="<?php echo $value->fieldtitle; ?>" name="jsNames[<?php echo $i; ?>]" /></td>
                                      <td >
                                          <input type="text" value="<?php echo $value->fieldvalue; ?>" name="jsValues[<?php echo $i; ?>]" />
                                          <span class="jquery_span_closetr" data-rowid="jstickets_trcust<?php echo $i; ?>" data-optionid="<?php echo $value->id;?>" style="float:right;padding:4px;background:#b31212;" ></span>
                                       </td>

                              </tr>
          <?php	$i++;
                      }
                      $i--;
              }
          }else { ?>
						<tr id="jsjobs_trcust0">
							<td width="20%"><input type="text" value="" name="jsNames[0]" /></td>
							<td >
                <input type="text" value="" name="jsValues[0]" />
                <span class="jquery_span_closetr" data-rowid="jstickets_trcust0" style="float:right;padding:4px;width:1%;background:#b31212;" ></span>  
              </td>
						</tr>
					<?php } ?>
				</tbody>
				</table>
			</div>
				  <table class="adminform">
						<tr>
							<td colspan="3">&nbsp;</td>
						</tr>

				  </table>
          <?php echo formfield::hidden('id',isset(jssupportticket::$_data[0][0]->id) ? jssupportticket::$_data[0][0]->id : ''); ?>
          <?php echo formfield::hidden('valueCount', $i); ?>
          <?php echo formfield::hidden('fieldfor', 1); ?>
		      <?php echo formfield::hidden('action','userfeild_saveuserfeild'); ?>
          <?php echo formfield::hidden('form_request','jssupportticket'); ?>
          <div class="js-form-button">
            <?php echo formfield::submitbutton('save',__('SAVE_USER_FIELD','js-support-ticket'),array('class'=>'button')); ?>
          </div>
			</form>
		
</table>
<?php }else{ ?>
        <div class="js_job_error_messages_wrapper">
            <div class="js_job_messages_image_wrapper">
                <img class="js_job_messages_image" src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/errors/1.png"/>
            </div>
            <div class="js_job_messages_data_wrapper">
                <span class="js_job_messages_main_text">
                    <?php echo __('NOT_LOGIN','js-support-ticket'); ?>
                </span>
                <span class="js_job_messages_block_text">
                    <?php echo __('YOU_ARE_NOT_ALLOWED_TO_VIEW','js-support-ticket'); ?>
                </span>
            </div>
        </div>
<?php
}
?>
