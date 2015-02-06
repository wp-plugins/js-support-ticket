<?php
    JSSTmessage::getMessage();
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
    $captchaselection = array(
                (object)array('id'=> '1','text'=>__('GOOGLE_RECAPTCHA','js-support-ticket')),
                (object)array('id' => '2','text'=> __('OWN_CAPTCHA','js-support-ticket'))
                );
    $owncaptchaoparend = array(
                (object)array('id'=> '2','text'=>__('2','js-support-ticket')),
                (object)array('id' => '3','text'=> __('3','js-support-ticket'))
                );
    $owncaptchatype = array(
                (object)array('id'=> '0','text'=>__('ANY','js-support-ticket')),
                (object)array('id'=> '1','text'=>__('ADDITION','js-support-ticket')),
                (object)array('id' => '2','text'=> __('SUBTRACTION','js-support-ticket'))
                );
    $yesno = array(
                (object)array('id'=> '1','text'=>__('YES','js-support-ticket')),
                (object)array('id' => '2','text'=> __('NO','js-support-ticket'))
                );
    $showhide = array(
                (object)array('id'=> '1','text'=>__('SHOW','js-support-ticket')),
                (object)array('id' => '2','text'=> __('HIDE','js-support-ticket'))
                );
    $enableddisabled = array(
                        (object)array('id'=> '1','text'=>__('ENABLED','js-support-ticket')),
                        (object)array('id' => '2','text'=> __('DISABLED','js-support-ticket'))
                        );
?>
<form method="post" action="<?php echo admin_url("?page=configuration&task=saveconfiguration"); ?>">
        <div id="tabs" class="tabs">
            <ul>
                <li><a href="#general"><?php echo __('GENERAL_SETTING','js-support-ticket') ?></a></li>
                <li><a href="#ticketsettig"><?php echo __('TICKET_SETTING','js-support-ticket') ?></a></li>
                 <li><a href="#defaultemail"><?php echo __('DEFAULT_SYSTEM_EMAIL','js-support-ticket') ?></a></li>
                 <?php /*
                <li><a href="#staffmembers"><?php echo __('STAFF_MEMBERS','js-support-ticket') ?></a></li>
                <li><a href="#Knowledegebase"><?php echo __('KNOWLDEGE_BASE','js-support-ticket') ?></a></li>
                  * 
                  */ ?>
                <li><a href="#mailsetting"><?php echo __('MAIL_SETTING','js-support-ticket'); ?></a></li>
                <li><a href="#menusetting"><?php echo __('MENU_SETTING','js-support-ticket'); ?></a></li>
            </ul>
                <div class="tabInner">
                    <div id="general">
                             <h3 class="js-ticket-configuration-heading-main"><?php echo __('GENERAL_SETTING','js-support-ticket') ?></h3>
                                <div class="js-ticket-configuration-table">
                                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('TITLE','js-support-ticket') ?></div>
                                        <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::text('title',jssupportticket::$_data[0]['title'],array('class'=>'inputbox')) ?></div>
                                        <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('SET_THE_HEADING_OF_YOUR_PLUGIN','js-support-ticket'); ?></small></div>
                                    </div>
                                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('OFFLINE','js-support-ticket') ?></div>
                                        <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::select('offline',array((object)array('id'=> '1','text'=>__('OFFLINE','js-support-ticket')),(object)array('id' => '2','text'=> __('ONLINE','js-support-ticket'))),jssupportticket::$_data[0]['offline']);?></div>
                                        <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('SET_YOUR_PLUGIN_OFFLINE_FOR_FRONT_END','js-support-ticket'); ?></small></div>
                                    </div>
                                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('OFFLINE_MESSAGE','js-support-ticket') ?></div>
                                        <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo wp_editor(jssupportticket::$_data[0]['offline_message'],'offline_message',array( 'media_buttons' => false ));?></div>
                                        <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('SET_THE_OFFLINE_MESSAGE_FOR_YOUR_USER','js-support-ticket'); ?></small></div>
                                    </div>
                                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('DATA_DIRECTORY','js-support-ticket') ?></div>
                                        <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::text('data_directory',jssupportticket::$_data[0]['data_directory'] ,array('class'=>'inputbox')) ?></div>
                                        <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('SET_THE_NAME_FOR_YOUR_DATA_DIRECTORY','js-support-ticket'); ?></small></div>
                                    </div>
                                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('DATE_FORMAT','js-support-ticket') ?></div>
                                        <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::select('date_format',array((object)array('id'=> 'd-m-Y','text'=>"DD-MM-YYYY"),(object)array('id' => 'm-d-Y','text'=> "MM-DD-YYYY"),(object)array('id' => 'Y-m-d','text'=> "YYYY-MM-DD")),jssupportticket::$_data[0]['date_format']);?></div>
                                        <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('SET_THE_DEFAULT_DATE_FORMAT','js-support-ticket'); ?></small></div>
                                    </div>
                                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('TICKET_OVERDUE','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                        <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::text('ticket_overdue',jssupportticket::$_data[0]['ticket_overdue'],array('class'=>'inputbox')) ?><?php echo __('DAYS','js-support-ticket') ?></div>
                                        <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('SET_NO_OF_DAYS_TO_MARK_TICKET_AS_OVERDUE','js-support-ticket'); ?></small></div>
                                    </div>
                                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('TICKET_AUTO_CLOSE','js-support-ticket') ?></div>
                                        <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::text('ticket_auto_close',jssupportticket::$_data[0]['ticket_auto_close'],array('class'=>'inputbox')) ?><?php echo __('DAYS','js-support-ticket') ?></div>
                                        <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('TICKET_AUTO_CLOSE_IF_USER_NOT_RESPOND_WITHIN_GIVEN_DAYS','js-support-ticket'); ?></small></div>
                                    </div>
                                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('NO_OF_ATTACHMENT','js-support-ticket') ?></div>
                                        <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::text('no_of_attachement',jssupportticket::$_data[0]['no_of_attachement'],array('class'=>'inputbox')) ?></div>
                                        <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('NO_OF_ATTACHMENT_ALLOWED_AT_A_TIME','js-support-ticket'); ?></small></div>
                                    </div>
                                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('FILE_MAXIMUM_SIZE','js-support-ticket') ?></div>
                                        <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::text('file_maximum_size',jssupportticket::$_data[0]['file_maximum_size'],array('class'=>'inputbox')) ?><?php echo __('KB','js-support-ticket') ?></div>
                                        <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('MAXIMUM_FILE_SIZE_IN_BYTES','js-support-ticket'); ?></small></div>
                                    </div>
                                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('FILE_EXTENSION','js-support-ticket') ?></div>
                                        <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::textarea('file_extension',jssupportticket::$_data[0]['file_extension'],array('class'=>'inputbox')); ?></div>
                                        <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('FILE_EXTENSION_ALLOWED_TO_ATTACH','js-support-ticket'); ?></small></div>
                                    </div>
                                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('PAGINATION_DEFAULT_PAGE_SIZE','js-support-ticket') ?></div>
                                        <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::text('pagination_default_page_size',jssupportticket::$_data[0]['pagination_default_page_size'],array('class'=>'inputbox')) ?></div>
                                        <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('SET_THE_NO_OF_RECORED_PER_PAGE','js-support-ticket'); ?></small></div>
                                    </div>
                                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('BREADCRUMBS','js-support-ticket') ?></div>
                                        <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::select('show_breadcrumbs',$showhide,jssupportticket::$_data[0]['show_breadcrumbs']) ?></div>
                                        <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('SHOW_HIDE_BREAD_CRUMBS_IN_PLUGIN','js-support-ticket'); ?></small></div>
                                    </div>
                                </div>
                    </div>
                    <div id="ticketsettig">
                         <h3 class="js-ticket-configuration-heading-main"><?php echo __('TICKET_SETTING','js-support-ticket') ?></h3>
                        <table >
                            <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('MAXIMUM_TICKETS','js-support-ticket') ?></div>
                                <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::text('maximum_tickets',jssupportticket::$_data[0]['maximum_tickets'],array('class'=>'inputbox')) ?></div>
                                <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('MAXIMUM_TICKETS_PER_USER','js-support-ticket'); ?></small></div>
                            </div>
                            <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('MAXIMUM_OPEN_TICKETS','js-support-ticket') ?></div>
                                <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::text('maximum_open_tickets',jssupportticket::$_data[0]['maximum_open_tickets'],array('class'=>'inputbox')) ?></div>
                                <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('MAXIMUM_OPENNED_TICKETS_PER_USER','js-support-ticket'); ?></small></div>
                            </div>
                            <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('REOPEN_TICKET_WITHIN_DAYS','js-support-ticket') ?></div>
                                <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::text('reopen_ticket_within_days',jssupportticket::$_data[0]['reopen_ticket_within_days'],array('class'=>'inputbox')) ?></div>
                                <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('TICKET_CAN_BE_REOPEN_WITHIN_GIVEN_NUMBER_OF_DAYS','js-support-ticket'); ?></small></div>
                            </div>
                            <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('VISITOR_CAN_CREATE_TICKET','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::select('visitor_can_create_ticket',$yesno,jssupportticket::$_data[0]['visitor_can_create_ticket']);?></div>
                                <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('CAN_VISITOR_CREATE_TICKET_OR_NOT','js-support-ticket'); ?></small></div>
                            </div>
                            <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('SHOW_CAPTCHA_ON_VISITOR_FORM_TICKET','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::select('show_captcha_on_visitor_from_ticket',$yesno,jssupportticket::$_data[0]['show_captcha_on_visitor_from_ticket']);?></div>
                                <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('SHOW_CAPTCHA_WHEN_VISITOR_WANT_TO_CREATE_TICKET','js-support-ticket'); ?></small></div>
                            </div>
                            <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('CAPTCHA_SELECTION','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::select('captcha_selection',$captchaselection,jssupportticket::$_data[0]['captcha_selection']);?></div>
                                <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('WHICH_CAPTCHA_YOU_WANT_TO_ADD','js-support-ticket'); ?></small></div>
                            </div>
                            <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('GOOGLE_RECAPTCHA_PUBLIC_KEY','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::text('recaptcha_publickey',jssupportticket::$_data[0]['recaptcha_publickey'],array('class'=>'inputbox')) ?></div>
                                <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('PLEASE_ENTER_THE_GOOGLE_RECAPTCHA_PUBLIC_KEY_FROM_https://www.google.com/recaptcha/admin','js-support-ticket'); ?></small></div>
                            </div>
                            <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('GOOGLE_RECAPTCHA_PRIVATE_KEY','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::text('recaptcha_privatekey',jssupportticket::$_data[0]['recaptcha_privatekey'],array('class'=>'inputbox')) ?></div>
                                <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('PLEASE_ENTER_THE_GOOGLE_RECAPTCHA_PRIVATE_KEY_FROM_https://www.google.com/recaptcha/admin','js-support-ticket'); ?></small></div>
                            </div>
                            <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('OWN_CAPTCHA_CALCULATION_TYPE','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::select('owncaptcha_calculationtype',$owncaptchatype,jssupportticket::$_data[0]['owncaptcha_calculationtype']);?></div>
                                <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('SELECT_CALCULATION_TYPE_ADDITION_OR_SUBTRACTION','js-support-ticket'); ?></small></div>
                            </div>
                            <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('OWN_CAPTCHA_OPERANDS','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::select('owncaptcha_totaloperand',$owncaptchaoparend,jssupportticket::$_data[0]['owncaptcha_totaloperand']);?></div>
                                <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('SELECT_THE_TOTAL_OPERANDS_TO_BE_GIVEN','js-support-ticket'); ?></small></div>
                            </div>
                            <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('OWN_CAPTCHA_SUBTRACTION_ANSWER_POSITVIE','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::select('owncaptcha_subtractionans',$yesno,jssupportticket::$_data[0]['owncaptcha_subtractionans']);?></div>
                                <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('IS_SUBTRACTION_ANSWER_SHOULD_BE_POSITIVE','js-support-ticket'); ?></small></div>
                            </div>
                            <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('NEW_TICKET_MESSAGE','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo wp_editor(jssupportticket::$_data[0]['new_ticket_message'],'new_ticket_message');?></div>
                                <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('THIS_MESSAGE_WILL_SHOW_ON_NEW_TICKET','js-support-ticket'); ?></small></div>
                            </div>
                        </table>
                   </div>
                    <div id="defaultemail">
                        <h3 class="js-ticket-configuration-heading-main"> <?php echo __('DEFAULT_EMAIL_SYSTEM','js-support-ticket') ?></h3>
                       
                            <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('DEFAULT_ALERT_EMAIL','js-support-ticket') ?></div>
                                <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-value"><?php echo JSSTformfield::select('default_alert_email',jssupportticket::$_data[1],jssupportticket::$_data[0]['default_alert_email']);?></div>
                                <div class="js-col-xs-12 js-col-md-4"><small><?php echo __('SET_DEFAULT_ALERT_EMAIL_TO_SEND_ALERTS','js-support-ticket'); ?></small></div>
                            </div>
                            <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('DEFAULT_ADMIN_EMAIL','js-support-ticket') ?></div>
                                <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-value"><?php echo JSSTformfield::select('default_admin_email',jssupportticket::$_data[1],jssupportticket::$_data[0]['default_admin_email']);?></div>
                                <div class="js-col-xs-12 js-col-md-4"><small><?php echo __('SET_DEFAULT_ADMIN_EMAIL_TO_RECEVICE_ADMIN_EMAILS','js-support-ticket'); ?></small></div>
                            </div>
                        <?php /*
                        <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                            <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('ARTICLES_PER_ROW','js-support-ticket') ?></div>
                            <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-value"><?php echo JSSTformfield::text('articles_per_row',jssupportticket::$_data[0]['articles_per_row'],array('class'=>'inputbox')) ?></div>
                            <div class="js-col-xs-12 js-col-md-4"><small><?php echo __('SET_HOW_MANY_ARTICLE_SHOW_PER_ROW','js-support-ticket'); ?></small></div>
                        </div>
                         * 
                         */ ?>
                    </div>
                    <div id="mailsetting">
                    <?php /*
                        <h3 class="js-ticket-configuration-heading-main"><?php echo __('NEW_TICKET','js-support-ticket') ?></h3>
                  
                        <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                            <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('MAIL_TO_ADMIN','js-support-ticket') ?></div>
                            <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-value"><?php echo JSSTformfield::select('new_ticket_mail_to_admin',$enableddisabled,jssupportticket::$_data[0]['new_ticket_mail_to_admin']);?></div>
                            <div class="js-col-xs-12 js-col-md-4"><small><?php echo __('EMAIL_SEND_TO_ADMIN_WHEN_NEW_TICKET_CREATED','js-support-ticket'); ?></small></div>
                        </div>
                        <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                            <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('MAIL_TO_STAFF_MEMBERS','js-support-ticket') ?></div>
                            <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-value"><?php echo JSSTformfield::select('new_ticket_mail_to_staff_members',$enableddisabled,jssupportticket::$_data[0]['new_ticket_mail_to_staff_members']);?></div>
                            <div class="js-col-xs-12 js-col-md-4"><small><?php echo __('EMAIL_SEND_TO_STAFF_MEMBER_WHEN_NEW_TICKET_CREATED','js-support-ticket'); ?></small></div>
                        </div>
                       
                        */ ?>
                        <h3 class="js-ticket-configuration-heading-main"><?php echo __('BAN_EMAIL_NEW_TICKET','js-support-ticket') ?></h3>
                      
                        <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                            <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('MAIL_TO_ADMIN','js-support-ticket') ?></div>
                            <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-value"><?php echo JSSTformfield::select('banemail_mail_to_admin',$enableddisabled,jssupportticket::$_data[0]['banemail_mail_to_admin']);?></div>
                            <div class="js-col-xs-12 js-col-md-4"><small><?php echo __('EMAIL_SEND_TO_ADMIN_WHEN_BANNED_EMAIL_TRY_TO_CREATE_TICKET','js-support-ticket'); ?></small></div>
                        </div>
                          
                            <table id="js-support-ticket-table">
                            <h3 class="js-ticket-configuration-heading-main"><?php echo __('OPERATIONS','js-support-ticket') ?></h3>
                                <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row js-ticket-config-xs-hide">
                                    <div class="js-col-xs-12 js-col-md-3"></div>
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-conf-text-sub"><?php echo __('ADMIN','js-support-ticket') ?></div>
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-conf-text-sub"><?php echo __('STAFF','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-conf-text-sub"><?php echo __('USER','js-support-ticket') ?></div>
                                </div>
                                <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('NEW_TICKET','js-support-ticket') ?></div>
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('ADMIN','js-support-ticket') ?></span><?php echo JSSTformfield::select('new_ticket_mail_to_admin',$enableddisabled,jssupportticket::$_data[0]['new_ticket_mail_to_admin']);?></div>
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('STAFF','js-support-ticket') ?></span><?php echo JSSTformfield::select('new_ticket_mail_to_staff_members',$enableddisabled,jssupportticket::$_data[0]['new_ticket_mail_to_staff_members']);?></div>
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('USER','js-support-ticket') ?></span></div>
                                </div>
                                <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('TICKET_REASSIGN','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('ADMIN','js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_reassign_admin',$enableddisabled,jssupportticket::$_data[0]['ticket_reassign_admin']);?></div>
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('STAFF','js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_reassign_staff',$enableddisabled,jssupportticket::$_data[0]['ticket_reassign_staff']);?></div>
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('USER','js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_reassign_user',$enableddisabled,jssupportticket::$_data[0]['ticket_reassign_user']);?></div>
                                </div>
                                <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('TICKET_CLOSE','js-support-ticket') ?></div>
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('ADMIN','js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_close_admin',$enableddisabled,jssupportticket::$_data[0]['ticket_close_admin']);?></div>
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('STAFF','js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_close_staff',$enableddisabled,jssupportticket::$_data[0]['ticket_close_staff']);?></div>
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('USER','js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_close_user',$enableddisabled,jssupportticket::$_data[0]['ticket_close_user']);?></div>
                                </div>
                                <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('TICKET_DELETE','js-support-ticket') ?></div>
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('ADMIN','js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_delete_admin',$enableddisabled,jssupportticket::$_data[0]['ticket_delete_admin']);?></div>
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('STAFF','js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_delete_staff',$enableddisabled,jssupportticket::$_data[0]['ticket_delete_staff']);?></div>
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('USER','js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_delete_user',$enableddisabled,jssupportticket::$_data[0]['ticket_delete_user']);?></div>
                                </div>
                                <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('TICKET_MARK_OVERDUE','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('ADMIN','js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_mark_overdue_admin',$enableddisabled,jssupportticket::$_data[0]['ticket_mark_overdue_admin']);?></div>
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('STAFF','js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_mark_overdue_staff',$enableddisabled,jssupportticket::$_data[0]['ticket_mark_overdue_staff']);?></div>
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('USER','js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_mark_overdue_user',$enableddisabled,jssupportticket::$_data[0]['ticket_mark_overdue_user']);?></div>
                                </div>
                                <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('TICKET_BAN_EMAIL','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('ADMIN','js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_ban_email_admin',$enableddisabled,jssupportticket::$_data[0]['ticket_ban_email_admin']);?></div>
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('STAFF','js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_ban_email_staff',$enableddisabled,jssupportticket::$_data[0]['ticket_ban_email_staff']);?></div>
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('USER','js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_ban_email_user',$enableddisabled,jssupportticket::$_data[0]['ticket_ban_email_user']);?></div>
                                </div>
                                <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('TICKET_DEPARTMENT_TRANSFER','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('ADMIN','js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_department_transfer_admin',$enableddisabled,jssupportticket::$_data[0]['ticket_department_transfer_admin']);?></div>
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('STAFF','js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_department_transfer_staff',$enableddisabled,jssupportticket::$_data[0]['ticket_department_transfer_staff']);?></div>
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('USER','js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_department_transfer_user',$enableddisabled,jssupportticket::$_data[0]['ticket_department_transfer_user']);?></div>
                                </div>
                                <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('TICKET_REPLY_(_TICKET_USER_)','js-support-ticket') ?></div>
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('ADMIN','js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_reply_ticket_user_admin',$enableddisabled,jssupportticket::$_data[0]['ticket_reply_ticket_user_admin']);?></div>
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('STAFF','js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_reply_ticket_user_staff',$enableddisabled,jssupportticket::$_data[0]['ticket_reply_ticket_user_staff']);?></div>
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('USER','js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_reply_ticket_user_user',$enableddisabled,jssupportticket::$_data[0]['ticket_reply_ticket_user_user']);?></div>
                                </div>
                                <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('TICKET_RESPONSE_(_STAFF_)','js-support-ticket') ?></div>
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('ADMIN','js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_response_to_staff_admin',$enableddisabled,jssupportticket::$_data[0]['ticket_response_to_staff_admin']);?></div>
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('STAFF','js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_response_to_staff_staff',$enableddisabled,jssupportticket::$_data[0]['ticket_response_to_staff_staff']);?></div>
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('USER','js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_response_to_staff_user',$enableddisabled,jssupportticket::$_data[0]['ticket_response_to_staff_user']);?></div>
                                </div>
                                <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('TICKET_BAN_EMAIL_AND_CLOSE_TICKET','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('ADMIN','js-support-ticket') ?></span><?php echo JSSTformfield::select('ticker_ban_eamil_and_close_ticktet_admin',$enableddisabled,jssupportticket::$_data[0]['ticker_ban_eamil_and_close_ticktet_admin']);?></div>
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('STAFF','js-support-ticket') ?></span><?php echo JSSTformfield::select('ticker_ban_eamil_and_close_ticktet_staff',$enableddisabled,jssupportticket::$_data[0]['ticker_ban_eamil_and_close_ticktet_staff']);?></div>
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('USER','js-support-ticket') ?></span><?php echo JSSTformfield::select('ticker_ban_eamil_and_close_ticktet_user',$enableddisabled,jssupportticket::$_data[0]['ticker_ban_eamil_and_close_ticktet_user']);?></div>
                                </div>
                                <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('TICKET_UNBAN_EMAIL','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('ADMIN','js-support-ticket') ?></span><?php echo JSSTformfield::select('unban_email_admin',$enableddisabled,jssupportticket::$_data[0]['unban_email_admin']);?></div>
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('STAFF','js-support-ticket') ?></span><?php echo JSSTformfield::select('unban_email_staff',$enableddisabled,jssupportticket::$_data[0]['unban_email_staff']);?></div>
                                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('USER','js-support-ticket') ?></span><?php echo JSSTformfield::select('unban_email_user',$enableddisabled,jssupportticket::$_data[0]['unban_email_user']);?></div>
                                </div>
                                
                            </table>
                        </fieldset>
                    </div>
                    <div id="menusetting">
                        <h3 class="js-ticket-configuration-heading-main"><?php echo __('STAFF_MEMBERS_CONTROL_PANEL_LINKS','js-support-ticket') ?></h3>
                        <div class="js-ticket-configuration-table">
                            <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('OPEN_TICKET','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_openticket_staff',$showhide,jssupportticket::$_data[0]['cplink_openticket_staff']) ?></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('MY_TICKETS','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_myticket_staff',$showhide,jssupportticket::$_data[0]['cplink_myticket_staff']) ?></div>
                            </div>
                            <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('ADD_ROLE','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_addrole_staff',$showhide,jssupportticket::$_data[0]['cplink_addrole_staff']) ?></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('ROLES','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_roles_staff',$showhide,jssupportticket::$_data[0]['cplink_roles_staff']) ?></div>
                            </div>
                            <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('ADD_STAFF','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_addstaff_staff',$showhide,jssupportticket::$_data[0]['cplink_addstaff_staff']) ?></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('STAFF','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_staff_staff',$showhide,jssupportticket::$_data[0]['cplink_staff_staff']) ?></div>
                            </div>
                            <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('ADD_DEPARTMENT','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_adddepartment_staff',$showhide,jssupportticket::$_data[0]['cplink_adddepartment_staff']) ?></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('DEPARTMENT','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_department_staff',$showhide,jssupportticket::$_data[0]['cplink_department_staff']) ?></div>
                            </div>
                            <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('ADD_CATEGORY','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_addcategory_staff',$showhide,jssupportticket::$_data[0]['cplink_addcategory_staff']) ?></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('CATEGORY','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_category_staff',$showhide,jssupportticket::$_data[0]['cplink_category_staff']) ?></div>
                            </div>
                            <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('ADD_KNOWLEDGE_BASE','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_addkbarticle_staff',$showhide,jssupportticket::$_data[0]['cplink_addkbarticle_staff']) ?></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('KNOWLEDGE_BASE','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_kbarticle_staff',$showhide,jssupportticket::$_data[0]['cplink_kbarticle_staff']) ?></div>
                            </div>
                            <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('ADD_DOWNLOAD','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_adddownload_staff',$showhide,jssupportticket::$_data[0]['cplink_adddownload_staff']) ?></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('DOWNLOAD','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_download_staff',$showhide,jssupportticket::$_data[0]['cplink_download_staff']) ?></div>
                            </div>
                            <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('ADD_ANNOUNCEMENT','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_addannouncement_staff',$showhide,jssupportticket::$_data[0]['cplink_addannouncement_staff']) ?></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('ANNOUNCEMENT','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_announcement_staff',$showhide,jssupportticket::$_data[0]['cplink_announcement_staff']) ?></div>
                            </div>
                            <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('ADD_FAQ','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_addfaq_staff',$showhide,jssupportticket::$_data[0]['cplink_addfaq_staff']) ?></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('FAQ','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_faq_staff',$showhide,jssupportticket::$_data[0]['cplink_faq_staff']) ?></div>
                            </div>
                            <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('MAIL','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_mail_staff',$showhide,jssupportticket::$_data[0]['cplink_mail_staff']) ?></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('MY_PROFILE','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_myprofile_staff',$showhide,jssupportticket::$_data[0]['cplink_myprofile_staff']) ?></div>
                            </div>
                        </div>
                        <h3 class="js-ticket-configuration-heading-main"><?php echo __('STAFF_TOP_MENU_LINKS','js-support-ticket') ?></h3>
                        <div class="js-ticket-configuration-table">
                            <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('HOME','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('tplink_home_staff',$showhide,jssupportticket::$_data[0]['tplink_home_staff']) ?></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('TICKETS','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('tplink_tickets_staff',$showhide,jssupportticket::$_data[0]['tplink_tickets_staff']) ?></div>
                            </div>
                            <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('KNOWLEDGE_BASE','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('tplink_knowledgebase_staff',$showhide,jssupportticket::$_data[0]['tplink_knowledgebase_staff']) ?></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('ANNOUNCEMENTS','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('tplink_announcements_staff',$showhide,jssupportticket::$_data[0]['tplink_announcements_staff']) ?></div>
                            </div>
                            <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('DOWNLOADS','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('tplink_downloads_staff',$showhide,jssupportticket::$_data[0]['tplink_downloads_staff']) ?></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('FAQS','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('tplink_faqs_staff',$showhide,jssupportticket::$_data[0]['tplink_faqs_staff']) ?></div>
                            </div>
                        </div>                        
                        <h3 class="js-ticket-configuration-heading-main"><?php echo __('USER_CONTROL_PANEL_LINKS','js-support-ticket') ?></h3>
                        <div class="js-ticket-configuration-table">
                            <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('OPEN_TICKET','js-support-ticket') ?></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_openticket_user',$showhide,jssupportticket::$_data[0]['cplink_openticket_user']) ?></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('MY_TICKETS','js-support-ticket') ?></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_myticket_user',$showhide,jssupportticket::$_data[0]['cplink_myticket_user']) ?></div>
                            </div>
                            <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('CHECK_TICKET_STATUS','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_checkticketstatus_user',$showhide,jssupportticket::$_data[0]['cplink_checkticketstatus_user']) ?></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('DOWNLOADS','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_downloads_user',$showhide,jssupportticket::$_data[0]['cplink_downloads_user']) ?></div>
                            </div>
                            <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('ANNOUNCEMENTS','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_announcements_user',$showhide,jssupportticket::$_data[0]['cplink_announcements_user']) ?></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('FAQS','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_faqs_user',$showhide,jssupportticket::$_data[0]['cplink_faqs_user']) ?></div>
                            </div>
                            <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('KNOWLEDGE_BASE','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_knowledgebase_user',$showhide,jssupportticket::$_data[0]['cplink_knowledgebase_user']) ?></div>
                            </div>
                        </div>
                        <h3 class="js-ticket-configuration-heading-main"><?php echo __('USER_TOP_MENU_LINKS','js-support-ticket') ?></h3>
                        <div class="js-ticket-configuration-table">
                            <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('HOME','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('tplink_home_user',$showhide,jssupportticket::$_data[0]['tplink_home_user']) ?></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('TICKETS','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('tplink_tickets_user',$showhide,jssupportticket::$_data[0]['tplink_tickets_user']) ?></div>
                            </div>
                            <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('KNOWLEDGE_BASE','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('tplink_knowledgebase_user',$showhide,jssupportticket::$_data[0]['tplink_knowledgebase_user']) ?></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('ANNOUNCEMENTS','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('tplink_announcements_user',$showhide,jssupportticket::$_data[0]['tplink_announcements_user']) ?></div>
                            </div>
                            <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('DOWNLOADS','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('tplink_downloads_user',$showhide,jssupportticket::$_data[0]['tplink_downloads_user']) ?></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('FAQS','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                                <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('tplink_faqs_user',$showhide,jssupportticket::$_data[0]['tplink_faqs_user']) ?></div>
                            </div>
                        </div>                        
                    </div>

                </div>
            </div>
    <?php echo JSSTformfield::hidden('action','configuration_saveconfiguration'); ?>
    <?php echo JSSTformfield::hidden('form_request','jssupportticket'); ?>
    <div class="js-form-button">
        <?php echo JSSTformfield::submitbutton('save',__('SAVE_CONFIGURATIONS','js-support-ticket') ,array('class'=>'button')); ?>
    </div>
     <div class="js-form-button">
        <?php echo '<font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font>'.__('PRO_VERSION_ONLY','js-support-ticket'); ?>
    </div>
</form>
