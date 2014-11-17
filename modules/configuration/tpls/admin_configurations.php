<?php
    wp_enqueue_script('jquery-ui-tabs');
    wp_enqueue_style('jquery-ui-css', 'http://www.example.com/your-plugin-path/css/jquery-ui.css');
    wp_enqueue_style('jquery-ui-css', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');    
?>
<script>
jQuery(document).ready(function(){
    jQuery("#tabs").tabs();
});
</script>
<?php
    $yesno = array(
                (object)array('id'=> '1','text'=>__('YES','js-support-ticket')),
                (object)array('id' => '2','text'=> __('NO','js-support-ticket'))
                );
    $enableddisabled = array(
                        (object)array('id'=> '1','text'=>__('ENABLED','js-support-ticket')),
                        (object)array('id' => '2','text'=> __('DISABLED','js-support-ticket'))
                        );
?>
<span class="js-admin-title"><?php echo __('CONFIGURATIONS','js-support-ticket'); ?></span>
<form method="post" action="<?php echo admin_url("?page=configuration_configurations&task=configuration_saveconfiguration&action=admin_saveconfiguration"); ?>">
        <div id="tabs" class="tabs">
            <ul>
                <li><a href="#general"><?php echo __('GENERAL_SETTING','js-support-ticket') ?></a></li>
                <li><a href="#ticketsettig"><?php echo __('TICKET_SETTING','js-support-ticket') ?></a></li>
                <li><a href="#staffmembers"><?php echo __('STAFF_MEMBERS','js-support-ticket') ?></a></li>
                 <li><a href="#defaultemail"><?php echo __('DEFAULT_SYSTEM_EMAIL','js-support-ticket') ?></a></li>
                <li><a href="#Knowledegebase"><?php echo __('KNOWLDEGE_BASE','js-support-ticket') ?></a></li>
                <li><a href="#mailsetting"><?php echo __('MAIL_SETTING','js-support-ticket'); ?></a></li>
            </ul>
                <div class="tabInner">
                    <div id="general">
                             <h1><?php echo __('GENERAL_SETTING','js-support-ticket') ?></H1>
                                <table >
                                    <tr>
                                        <th><?php echo __('TITLE','js-support-ticket') ?></th>
                                        <td><?php echo formfield::text('title',jssupportticket::$_data[0]['title'],array('class'=>'inputbox')) ?></td>
                                        <td><small><?php echo __('SET_THE_HEADING_OF_YOUR_PLUGIN','js-support-ticket'); ?></small></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __('OFFLINE','js-support-ticket') ?></th>
                                        <td><?php echo formfield::select('offline',array((object)array('id'=> '1','text'=>__('OFFLINE','js-support-ticket')),(object)array('id' => '2','text'=> __('ONLINE','js-support-ticket'))),jssupportticket::$_data[0]['offline']);?></td>
                                        <td><small><?php echo __('SET_YOUR_PLUGIN_OFFLINE_FOR_FRONT_END','js-support-ticket'); ?></small></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __('OFFLINE_MESSAGE','js-support-ticket') ?></th>
                                        <td><?php echo wp_editor(jssupportticket::$_data[0]['offline_message'],'offline_message',array( 'media_buttons' => false ));?></td>
                                        <td><small><?php echo __('SET_THE_OFFLINE_MESSAGE_FOR_YOUR_USER','js-support-ticket'); ?></small></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __('DATA_DIRECTORY','js-support-ticket') ?></th>
                                        <td><?php echo formfield::text('data_directory',jssupportticket::$_data[0]['data_directory'] ,array('class'=>'inputbox')) ?></td>
                                        <td><small><?php echo __('SET_THE_NAME_FOR_YOUR_DATA_DIRECTORY','js-support-ticket'); ?></small></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __('DATE_FORMAT','js-support-ticket') ?></th>
                                        <td><?php echo formfield::select('date_format',array((object)array('id'=> 'd-m-Y','text'=>"DD-MM-YYYY"),(object)array('id' => 'm-d-Y','text'=> "MM-DD-YYYY"),(object)array('id' => 'Y-m-d','text'=> "YYYY-MM-DD")),jssupportticket::$_data[0]['date_format']);?></td>
                                        <td><small><?php echo __('SET_THE_DEFAULT_DATE_FORMAT','js-support-ticket'); ?></small></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __('TICKET_OVERDUE','js-support-ticket') ?></th>
                                        <td><?php echo formfield::text('ticket_overdue',jssupportticket::$_data[0]['ticket_overdue'],array('class'=>'inputbox')) ?><?php echo __('DAYS','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></td>
                                        <td><small><?php echo __('SET_NO_OF_DAYS_TO_MARK_TICKET_AS_OVERDUE','js-support-ticket'); ?></small></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __('TICKET_AUTOCLOSE','js-support-ticket') ?></th>
                                        <td><?php echo formfield::text('ticket_auto_close',jssupportticket::$_data[0]['ticket_auto_close'],array('class'=>'inputbox')) ?><?php echo __('DAYS','js-support-ticket') ?></td>
                                        <td><small><?php echo __('TICKET_AUTOCLOSE_IF_USER_NOT_RESPOND_WITHIN_GIVEN_DAYS','js-support-ticket'); ?></small></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __('NO_OF_ATTACHMENT','js-support-ticket') ?></th>
                                        <td><?php echo formfield::text('no_of_attachement',jssupportticket::$_data[0]['no_of_attachement'],array('class'=>'inputbox')) ?></td>
                                        <td><small><?php echo __('NO_OF_ATTACHMENT_ALLOWED_AT_A_TIME','js-support-ticket'); ?></small></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __('FILE_MAXIMUM_SIZE','js-support-ticket') ?></th>
                                        <td><?php echo formfield::text('file_maximum_size',jssupportticket::$_data[0]['file_maximum_size'],array('class'=>'inputbox')) ?><?php echo __('KB','js-support-ticket') ?></td>
                                        <td><small><?php echo __('MAXIMUM_FILE_SIZE_IN_BYTES','js-support-ticket'); ?></small></td>
                                    </tr>
                                    <tr>
                                        <th><?php echo __('FILE_EXTENSION','js-support-ticket') ?></th>
                                        <td><?php echo formfield::textarea('file_extension',jssupportticket::$_data[0]['file_extension'],array('class'=>'inputbox')) ?></td>
                                        <td><small><?php echo __('FILE_EXTENSION_ALLOWED_TO_ATTACH','js-support-ticket'); ?></small></td>
                                    </tr>
                                </table>
                    </div>
                    <div id="ticketsettig">
                         <h1> <?php echo __('TICKET_SETTING','js-support-ticket') ?></h1>
                        <table >
                            <tr>
                                <th><?php echo __('MAXIMUM_OPEN_TICKET_PER_EMAIL','js-support-ticket') ?></th>
                                <td><?php echo formfield::text('maximum_open_ticket_per_email',jssupportticket::$_data[0]['maximum_open_ticket_per_email'],array('class'=>'inputbox')) ?></td>
                                <td><small><?php echo __('MAXIMUM_TICKET_CAN_BE_OPENED_BY_ONE_EMAIL','js-support-ticket'); ?></small></td>
                            </tr>
                            <tr>
                                <th><?php echo __('REOPEN_TICKET_WITHIN_DAYS','js-support-ticket') ?></th>
                                <td><?php echo formfield::text('reopen_ticket_within_days',jssupportticket::$_data[0]['reopen_ticket_within_days'],array('class'=>'inputbox')) ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></td>
                                <td><small><?php echo __('TICKET_CAN_BE_REOPEN_WITHIN_GIVEN_NUMBER_OF_DAYS','js-support-ticket'); ?></small></td>
                            </tr>
                            <tr>
                                <th><?php echo __('STAFF_CAN_LOCK_TICKET','js-support-ticket') ?></th>
                                <td><?php echo formfield::select('staff_can_lock_ticket',$yesno,jssupportticket::$_data[0]['staff_can_lock_ticket']);?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></td>
                                <td><small><?php echo __('CAN_STAFF_MEMBER_LOCK_TICKET_OR_NOT','js-support-ticket'); ?></small></td>
                            </tr>
                            <tr>
                                <th><?php echo __('VISITOR_CAN_CREATE_TICKET','js-support-ticket') ?></th>
                                <td><?php echo formfield::select('visitor_can_create_ticket',$yesno,jssupportticket::$_data[0]['visitor_can_create_ticket']);?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></td>
                                <td><small><?php echo __('CAN_VISITOR_CREATE_TICKET_OR_NOT','js-support-ticket'); ?></small></td>
                            </tr>
                            <tr>
                                <th><?php echo __('SHOW_CAPTCHA_ON_VISITOR_FORM_TICKET','js-support-ticket') ?></th>
                                <td><?php echo formfield::select('show_captcha_on_visitor_from_ticket',$yesno,jssupportticket::$_data[0]['show_captcha_on_visitor_from_ticket']);?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></td>
                                <td><small><?php echo __('SHOW_CAPTCHA_WHEN_VISITOR_WANT_TO_CREATE_TICKET','js-support-ticket'); ?></small></td>
                            </tr>
                            <tr>
                                <th><?php echo __('STAFF_IDENTITY','js-support-ticket') ?></th>
                                <td><?php echo formfield::select('staff_identity',$yesno,jssupportticket::$_data[0]['staff_identity']);?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></td>
                                <td><small><?php echo __('DESCRIPTION','js-support-ticket'); ?></small></td>
                            </tr>
                        </table>
                   </div>
                   <div id ="staffmembers">
                        <table>
                            <h1> <?php echo __('STAFF_MEMBERS','js-support-ticket') ?></H1>
                             <tr>
                                <th><?php echo __('VIEW_TICKETS','js-support-ticket') ?></th>
                                 <td><?php echo formfield::select('view_tickets',array((object)array('id'=> '1','text'=>__('SHOW_ALL_TICKETS','js-support-ticket')),(object)array('id' => '2','text'=> __('SHOW_ASSIGN_TICKETS','js-support-ticket'))),jssupportticket::$_data[0]['view_tickets']);?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></td>
                                 <td><small><?php echo __('SET_STAFF_MEMBER_CAN_SEE_TICKETS','js-support-ticket'); ?></small></td>
                             </tr>
                        </table>
                   </div>
                    <div id="defaultemail">
                        <fieldset>  
                            <legend><h1> <?php echo __('DEFAULT_EMAIL_SYSTEM','js-support-ticket') ?></H1></legend>
                            <table >
                                <tr>
                                    <th><?php echo __('DEFAULT_ALERT_EMAIL','js-support-ticket') ?></th>
                                    <td><?php echo formfield::select('default_alert_email',jssupportticket::$_data[1],jssupportticket::$_data[0]['default_alert_email']);?></td>
                                    <td><small><?php echo __('SET_DEFAULT_ALERT_EMAIL_TO_SEND_ALERTS','js-support-ticket'); ?></small></td>
                                </tr>
                                <tr>
                                    <th><?php echo __('DEFAULT_SYSTEM_EMAIL','js-support-ticket') ?></th>
                                    <td><?php echo formfield::select('default_system_email',jssupportticket::$_data[1],jssupportticket::$_data[0]['default_system_email']);?></td>
                                    <td><small><?php echo __('SET_DEFAULT_SYSTEM_EMAIL','js-support-ticket'); ?></small></td>
                                </tr>
                                <tr>
                                    <th><?php echo __('DEFAULT_ADMIN_EMAIL','js-support-ticket') ?></th>
                                    <td><?php echo formfield::select('default_admin_email',jssupportticket::$_data[1],jssupportticket::$_data[0]['default_admin_email']);?></td>
                                    <td><small><?php echo __('SET_DEFAULT_ADMIN_EMAIL_TO_RECEVICE_ADMIN_EMAILS','js-support-ticket'); ?></small></td>
                                </tr>
                                <tr>
                                <th><?php echo __('ARTICLES_PER_ROW','js-support-ticket') ?></th>
                                <td><?php echo formfield::text('articles_per_row',jssupportticket::$_data[0]['articles_per_row'],array('class'=>'inputbox')) ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></td>
                                <td><small><?php echo __('SET_HOW_MANY_ARTICLE_SHOW_PER_ROW','js-support-ticket'); ?></small></td>
                            </tr>
                            </table>
                        </fieldset>
                    </div>
                    <div id="Knowledegebase">
                        <fieldset> 
                            <legend><h1> <?php echo __('STAFF_MEMBER_KNOWLEDGEBASE_SETTING','js-support-ticket') ?></H1></legend>
                            <table >
                                <tr>
                                    <th><?php echo __('ENABLE','js-support-ticket') ?></th>
                                    <td><?php echo formfield::select('knowledge_base_enable',$yesno,jssupportticket::$_data[0]['knowledge_base_enable']);?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></td>
                                    <td><small><?php echo __('SET_KNOWLEDGEBASE_ENABLE_OR_DISABLE','js-support-ticket'); ?></small></td>
                                </tr>
                                <tr>
                                    <th><?php echo __('STAFF_CREATE_CATEGORIES','js-support-ticket') ?></th>
                                    <td><?php echo formfield::select('staff_create_categories',$yesno,jssupportticket::$_data[0]['staff_create_categories']);?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></td>
                                    <td><small><?php echo __('CAN_STAFF_MEMBER_CREATE_CATEGORIES_OR_NOT','js-support-ticket'); ?></small></td>
                                </tr>
                                <tr>
                                    <th><?php echo __('STAFF_CREATE_ARTICLES','js-support-ticket') ?></th>
                                    <td><?php echo formfield::select('staff_create_articles',$yesno,jssupportticket::$_data[0]['staff_create_articles']);?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></td>
                                    <td><small><?php echo __('CAN_STAFF_MEMBER_CREATE_ARTICLE_OR_NOT','js-support-ticket'); ?></small></td>
                                </tr>
                            </table>
                        </fieldset>
                    </div>
                    <div id="mailsetting">
                         <fieldset> 
                            <legend><h1><?php echo __('NEW_TICKET','js-support-ticket') ?></H1></legend>
                            <table >
                                <tr>
                                    <th><?php echo __('MAIL_TO_ADMIN','js-support-ticket') ?></th>
                                    <td><?php echo formfield::select('new_ticket_mail_to_admin',$enableddisabled,jssupportticket::$_data[0]['new_ticket_mail_to_admin']);?></td>
                                    <td><small><?php echo __('EMAIL_SEND_TO_ADMIN_WHEN_NEW_TICKET_CREATED','js-support-ticket'); ?></small></td>
                                </tr>
                                <tr>
                                    <th><?php echo __('MAIL_TO_STAFF_MEMBERS','js-support-ticket') ?></th>
                                    <td><?php echo formfield::select('new_ticket_mail_to_staff_members',$enableddisabled,jssupportticket::$_data[0]['new_ticket_mail_to_staff_members']);?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></td>
                                    <td><small><?php echo __('EMAIL_SEND_TO_STAFF_MEMBER_WHEN_NEW_TICKET_CREATED','js-support-ticket'); ?></small></td>
                                </tr>
                                <tr>
                                    <td colspan="3"><h1><?php echo __('BAN_EMAIL_NEW_TICKET','js-support-ticket') ?></H1></td>
                                </tr>
                                <tr>
                                    <th><?php echo __('MAIL_TO_ADMIN','js-support-ticket') ?></th>
                                    <td><?php echo formfield::select('banemail_mail_to_admin',$enableddisabled,jssupportticket::$_data[0]['banemail_mail_to_admin']);?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></td>
                                    <td><small><?php echo __('EMAIL_SEND_TO_ADMIN_WHEN_BANNED_EMAIL_TRY_TO_CREATE_TICKET','js-support-ticket'); ?></small></td>
                                </tr>
                            </table>
                            <table id="js-support-ticket-table">
                                <tr>
                                    <th><?php echo __('OPERATIONS','js-support-ticket') ?></th>
                                    <th><?php echo __('ADMIN','js-support-ticket') ?></th>
                                    <th><?php echo __('STAFF','js-support-ticket') ?></th>
                                    <th><?php echo __('USER','js-support-ticket') ?></th>
                                </tr>
                                <tr>
                                    <th><?php echo __('TICKET_REASSIGN','js-support-ticket') ?></th>
                                    <td><?php echo formfield::select('ticket_reassign_admin',$enableddisabled,jssupportticket::$_data[0]['ticket_reassign_admin']);?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></td>
                                    <td><?php echo formfield::select('ticket_reassign_staff',$enableddisabled,jssupportticket::$_data[0]['ticket_reassign_staff']);?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></td>
                                    <td><?php echo formfield::select('ticket_reassign_user',$enableddisabled,jssupportticket::$_data[0]['ticket_reassign_user']);?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></td>
                                </tr>
                                <tr>
                                    <th><?php echo __('TICKET_CLOSE','js-support-ticket') ?></th>
                                    <td><?php echo formfield::select('ticket_close_admin',$enableddisabled,jssupportticket::$_data[0]['ticket_close_admin']);?></td>
                                    <td><?php echo formfield::select('ticket_close_staff',$enableddisabled,jssupportticket::$_data[0]['ticket_close_staff']);?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></td>
                                    <td><?php echo formfield::select('ticket_close_user',$enableddisabled,jssupportticket::$_data[0]['ticket_close_user']);?></td>
                                </tr>
                                <tr>
                                    <th><?php echo __('TICKET_DELETE','js-support-ticket') ?></th>
                                    <td><?php echo formfield::select('ticket_delete_admin',$enableddisabled,jssupportticket::$_data[0]['ticket_delete_admin']);?></td>
                                    <td><?php echo formfield::select('ticket_delete_staff',$enableddisabled,jssupportticket::$_data[0]['ticket_delete_staff']);?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></td>
                                    <td><?php echo formfield::select('ticket_delete_user',$enableddisabled,jssupportticket::$_data[0]['ticket_delete_user']);?></td>
                                </tr>
                                <tr>
                                    <th><?php echo __('TICKET_MARK_OVERDUE','js-support-ticket') ?></th>
                                    <td><?php echo formfield::select('ticket_mark_overdue_admin',$enableddisabled,jssupportticket::$_data[0]['ticket_mark_overdue_admin']);?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></td>
                                    <td><?php echo formfield::select('ticket_mark_overdue_staff',$enableddisabled,jssupportticket::$_data[0]['ticket_mark_overdue_staff']);?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></td>
                                    <td><?php echo formfield::select('ticket_mark_overdue_user',$enableddisabled,jssupportticket::$_data[0]['ticket_mark_overdue_user']);?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></td>
                                </tr>
                                <tr>
                                    <th><?php echo __('TICKET_BAN_EMAIL','js-support-ticket') ?></th>
                                    <td><?php echo formfield::select('ticket_ban_email_admin',$enableddisabled,jssupportticket::$_data[0]['ticket_ban_email_admin']);?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></td>
                                    <td><?php echo formfield::select('ticket_ban_email_staff',$enableddisabled,jssupportticket::$_data[0]['ticket_ban_email_staff']);?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></td>
                                    <td><?php echo formfield::select('ticket_ban_email_user',$enableddisabled,jssupportticket::$_data[0]['ticket_ban_email_user']);?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></td>
                                </tr>
                                <tr>
                                    <th><?php echo __('TICKET_DEPARTMENT_TRANSFER','js-support-ticket') ?></th>
                                    <td><?php echo formfield::select('ticket_department_transfer_admin',$enableddisabled,jssupportticket::$_data[0]['ticket_department_transfer_admin']);?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></td>
                                    <td><?php echo formfield::select('ticket_department_transfer_staff',$enableddisabled,jssupportticket::$_data[0]['ticket_department_transfer_staff']);?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></td>
                                    <td><?php echo formfield::select('ticket_department_transfer_user',$enableddisabled,jssupportticket::$_data[0]['ticket_department_transfer_user']);?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></td>
                                </tr>
                                <tr>
                                    <th><?php echo __('TICKET_REPLY_(_TICKET_USER_)','js-support-ticket') ?></th>
                                    <td><?php echo formfield::select('ticket_reply_ticket_user_admin',$enableddisabled,jssupportticket::$_data[0]['ticket_reply_ticket_user_admin']);?></td>
                                    <td><?php echo formfield::select('ticket_reply_ticket_user_staff',$enableddisabled,jssupportticket::$_data[0]['ticket_reply_ticket_user_staff']);?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></td>
                                    <td><?php echo formfield::select('ticket_reply_ticket_user_user',$enableddisabled,jssupportticket::$_data[0]['ticket_reply_ticket_user_user']);?></td>
                                </tr>
                                <tr>
                                    <th><?php echo __('TICKET_RESPONSE_(_STAFF_)','js-support-ticket') ?></th>
                                    <td><?php echo formfield::select('ticket_response_to_staff_admin',$enableddisabled,jssupportticket::$_data[0]['ticket_response_to_staff_admin']);?></td>
                                    <td><?php echo formfield::select('ticket_response_to_staff_staff',$enableddisabled,jssupportticket::$_data[0]['ticket_response_to_staff_staff']);?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></td>
                                    <td><?php echo formfield::select('ticket_response_to_staff_user',$enableddisabled,jssupportticket::$_data[0]['ticket_response_to_staff_user']);?></td>
                                </tr>
                                <tr>
                                    <th><?php echo __('TICKET_BAN_EMAIL_AND_CLOSE_TICKET','js-support-ticket') ?></th>
                                    <td><?php echo formfield::select('ticker_ban_eamil_and_close_ticktet_admin',$enableddisabled,jssupportticket::$_data[0]['ticker_ban_eamil_and_close_ticktet_admin']);?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></td>
                                    <td><?php echo formfield::select('ticker_ban_eamil_and_close_ticktet_staff',$enableddisabled,jssupportticket::$_data[0]['ticker_ban_eamil_and_close_ticktet_staff']);?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></td>
                                    <td><?php echo formfield::select('ticker_ban_eamil_and_close_ticktet_user',$enableddisabled,jssupportticket::$_data[0]['ticker_ban_eamil_and_close_ticktet_user']);?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></td>
                                </tr>
                                <tr>
                                    <th><?php echo __('TICKET_UNBAN_EMAIL','js-support-ticket') ?></th>
                                    <td><?php echo formfield::select('unban_email_admin',$enableddisabled,jssupportticket::$_data[0]['unban_email_admin']);?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></td>
                                    <td><?php echo formfield::select('unban_email_staff',$enableddisabled,jssupportticket::$_data[0]['unban_email_staff']);?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></td>
                                    <td><?php echo formfield::select('unban_email_user',$enableddisabled,jssupportticket::$_data[0]['unban_email_user']);?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></td>
                                </tr>
                                
                            </table>
                        </fieldset>
                    </div>
                </div>
            </div>
    <?php echo formfield::hidden('action','configuration_saveconfiguration'); ?>
    <?php echo formfield::hidden('form_request','jssupportticket'); ?>
    <div class="js-form-button">
        <?php echo formfield::submitbutton('save',__('SAVE_CONFIGURATION','js-support-ticket') ,array('class'=>'button')); ?>
    </div>
    <div class="js-form-button">
    	<?php echo '<font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font>'.__('PRO_VERSION_ONLY','js-support-ticket'); ?>
    </div>
</form>