<?php
JSSTmessage::getMessage();
wp_enqueue_script('jquery-ui-tabs');
wp_enqueue_style('jquery-ui-css', 'http://www.example.com/your-plugin-path/css/jquery-ui.css');
wp_enqueue_style('jquery-ui-css', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
?>
<script>
    jQuery(document).ready(function () {
        jQuery(".tabs").tabs();
    });
    function showhidehostname(value){
        if(value == 4){
            jQuery("div#tve_hostname").show();
        }else{
            jQuery("div#tve_hostname").hide();
        }
    }
</script>
<?php
$captchaselection = array(
    (object) array('id' => '1', 'text' => __('Google Recaptcha', 'js-support-ticket')),
    (object) array('id' => '2', 'text' => __('Own Captcha', 'js-support-ticket'))
);
$owncaptchaoparend = array(
    (object) array('id' => '2', 'text' => __('2', 'js-support-ticket')),
    (object) array('id' => '3', 'text' => __('3', 'js-support-ticket'))
);
$owncaptchatype = array(
    (object) array('id' => '0', 'text' => __('Any', 'js-support-ticket')),
    (object) array('id' => '1', 'text' => __('Addition', 'js-support-ticket')),
    (object) array('id' => '2', 'text' => __('Subtraction', 'js-support-ticket'))
);
$yesno = array(
    (object) array('id' => '1', 'text' => __('Yes', 'js-support-ticket')),
    (object) array('id' => '2', 'text' => __('No', 'js-support-ticket'))
);
$showhide = array(
    (object) array('id' => '1', 'text' => __('Show', 'js-support-ticket')),
    (object) array('id' => '2', 'text' => __('Hide', 'js-support-ticket'))
);
$enableddisabled = array(
    (object) array('id' => '1', 'text' => __('Enabled', 'js-support-ticket')),
    (object) array('id' => '2', 'text' => __('Disabled', 'js-support-ticket'))
);
$mailreadtype = array(
    (object) array('id' => '1', 'text' => __('Only New Tickets', 'js-support-ticket')),
    (object) array('id' => '2', 'text' => __('Only Replies', 'js-support-ticket')),
    (object) array('id' => '3', 'text' => __('Both', 'js-support-ticket'))
);
$hosttype = array(
    (object) array('id' => '1', 'text' => __('Gmail', 'js-support-ticket')),
    (object) array('id' => '2', 'text' => __('Yahoo', 'js-support-ticket')),
    (object) array('id' => '3', 'text' => __('Aol', 'js-support-ticket')),
    (object) array('id' => '4', 'text' => __('Other', 'js-support-ticket'))
);
?>
<form method="post" action="<?php echo admin_url("?page=configuration&task=saveconfiguration"); ?>">
    <div id="tabs" class="tabs">
        <ul>
            <li><a href="#general"><?php echo __('General Setting', 'js-support-ticket') ?></a></li>
            <li><a href="#ticketsettig"><?php echo __('Ticket Setting', 'js-support-ticket') ?></a></li>
            <li><a href="#defaultemail"><?php echo __('Default System Email', 'js-support-ticket') ?></a></li>
            <?php /*
              <li><a href="#staffmembers"><?php echo __('Staff Members','js-support-ticket') ?></a></li>
              <li><a href="#Knowledegebase"><?php echo __('Knowledge Base','js-support-ticket') ?></a></li>
             * 
             */ ?>
            <li><a href="#mailsetting"><?php echo __('Mail Setting', 'js-support-ticket'); ?></a></li>
            <li><a href="#ticketviaemail"><?php echo __('Ticket via Email', 'js-support-ticket'); ?></a></li>
            <li><a href="#menusetting"><?php echo __('Menu Setting', 'js-support-ticket'); ?></a></li>
        </ul>
        <div class="tabInner">
            <div id="general">
                <h3 class="js-ticket-configuration-heading-main"><?php echo __('General Setting', 'js-support-ticket') ?></h3>
                <div class="js-ticket-configuration-table">
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Title', 'js-support-ticket') ?></div>
                        <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::text('title', jssupportticket::$_data[0]['title'], array('class' => 'inputbox')) ?></div>
                        <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('Set the heading of your plugin', 'js-support-ticket'); ?></small></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Offline', 'js-support-ticket') ?></div>
                        <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::select('offline', array((object) array('id' => '1', 'text' => __('Offline', 'js-support-ticket')), (object) array('id' => '2', 'text' => __('Online', 'js-support-ticket'))), jssupportticket::$_data[0]['offline']); ?></div>
                        <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('Set your plugin offline for front end', 'js-support-ticket'); ?></small></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Offline Message', 'js-support-ticket') ?></div>
                        <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo wp_editor(jssupportticket::$_data[0]['offline_message'], 'offline_message', array('media_buttons' => false)); ?></div>
                        <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('Set the offline message for your user', 'js-support-ticket'); ?></small></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Data Directory', 'js-support-ticket') ?></div>
                        <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::text('data_directory', jssupportticket::$_data[0]['data_directory'], array('class' => 'inputbox')) ?></div>
                        <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('Set the name for your data directory', 'js-support-ticket'); ?></small></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Date Format', 'js-support-ticket') ?></div>
                        <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::select('date_format', array((object) array('id' => 'd-m-Y', 'text' => "DD-MM-YYYY"), (object) array('id' => 'm-d-Y', 'text' => "MM-DD-YYYY"), (object) array('id' => 'Y-m-d', 'text' => "YYYY-MM-DD")), jssupportticket::$_data[0]['date_format']); ?></div>
                        <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('Set the default date format', 'js-support-ticket'); ?></small></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Ticket Overdue','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::text('ticket_overdue', jssupportticket::$_data[0]['ticket_overdue'], array('class' => 'inputbox')) ?><?php echo __('Days', 'js-support-ticket') ?></div>
                        <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('Set no. of days to mark ticket as overdue', 'js-support-ticket'); ?></small></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Ticket auto close', 'js-support-ticket') ?></div>
                        <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::text('ticket_auto_close', jssupportticket::$_data[0]['ticket_auto_close'], array('class' => 'inputbox')) ?><?php echo __('Days', 'js-support-ticket') ?></div>
                        <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('Ticket auto close if user not respond within given days', 'js-support-ticket'); ?></small></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('No. of attachment', 'js-support-ticket') ?></div>
                        <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::text('no_of_attachement', jssupportticket::$_data[0]['no_of_attachement'], array('class' => 'inputbox')) ?></div>
                        <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('No. of attachment allowed at a time', 'js-support-ticket'); ?></small></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('File maximum size', 'js-support-ticket') ?></div>
                        <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::text('file_maximum_size', jssupportticket::$_data[0]['file_maximum_size'], array('class' => 'inputbox')) ?><?php echo __('Kb', 'js-support-ticket') ?></div>
                        <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('Maximum file size in bytes', 'js-support-ticket'); ?></small></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('File extension', 'js-support-ticket') ?></div>
                        <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::textarea('file_extension', jssupportticket::$_data[0]['file_extension'], array('class' => 'inputbox')); ?></div>
                        <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('File extension allowed to attach', 'js-support-ticket'); ?></small></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Pagination default page size', 'js-support-ticket') ?></div>
                        <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::text('pagination_default_page_size', jssupportticket::$_data[0]['pagination_default_page_size'], array('class' => 'inputbox')) ?></div>
                        <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('Set the no. of record per page', 'js-support-ticket'); ?></small></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Breadcrumbs', 'js-support-ticket') ?></div>
                        <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::select('show_breadcrumbs', $showhide, jssupportticket::$_data[0]['show_breadcrumbs']) ?></div>
                        <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('Show hide breadcrumbs in plugin', 'js-support-ticket'); ?></small></div>
                    </div>
                </div>
            </div>
            <div id="ticketsettig">
                <h3 class="js-ticket-configuration-heading-main"><?php echo __('Ticket Setting', 'js-support-ticket') ?></h3>
                <table >
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Maximum tickets', 'js-support-ticket') ?></div>
                        <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::text('maximum_tickets', jssupportticket::$_data[0]['maximum_tickets'], array('class' => 'inputbox')) ?></div>
                        <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('Maximum ticket per user', 'js-support-ticket'); ?></small></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Maximum open tickets', 'js-support-ticket') ?></div>
                        <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::text('maximum_open_tickets', jssupportticket::$_data[0]['maximum_open_tickets'], array('class' => 'inputbox')) ?></div>
                        <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('Maximum opened tickets per user', 'js-support-ticket'); ?></small></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Reopen ticket within days', 'js-support-ticket') ?></div>
                        <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::text('reopen_ticket_within_days', jssupportticket::$_data[0]['reopen_ticket_within_days'], array('class' => 'inputbox')) ?></div>
                        <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('Ticket can be reopen within given number of days', 'js-support-ticket'); ?></small></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Visitor can create ticket','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::select('visitor_can_create_ticket', $yesno, jssupportticket::$_data[0]['visitor_can_create_ticket']); ?></div>
                        <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('Can visitor created ticket or not', 'js-support-ticket'); ?></small></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Show captcha on visitor form ticket','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::select('show_captcha_on_visitor_from_ticket', $yesno, jssupportticket::$_data[0]['show_captcha_on_visitor_from_ticket']); ?></div>
                        <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('Show captcha when visitor want to create ticket', 'js-support-ticket'); ?></small></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Captcha selection','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::select('captcha_selection', $captchaselection, jssupportticket::$_data[0]['captcha_selection']); ?></div>
                        <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('Which captcha you want to add', 'js-support-ticket'); ?></small></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Google recaptcha public key','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::text('recaptcha_publickey', jssupportticket::$_data[0]['recaptcha_publickey'], array('class' => 'inputbox')) ?></div>
                        <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('Please enter the google recaptcha public key from','js-support-ticket').' https://www.google.com/recaptcha/admin '; ?></small></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Google recaptcha private key','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::text('recaptcha_privatekey', jssupportticket::$_data[0]['recaptcha_privatekey'], array('class' => 'inputbox')) ?></div>
                        <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('Please enter the google recaptcha private key from','js-support-ticket').' https://www.google.com/recaptcha/admin '; ?></small></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Own captcha calculation type','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::select('owncaptcha_calculationtype', $owncaptchatype, jssupportticket::$_data[0]['owncaptcha_calculationtype']); ?></div>
                        <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('Select calculation type addition or subtraction', 'js-support-ticket'); ?></small></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Own captcha operands','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::select('owncaptcha_totaloperand', $owncaptchaoparend, jssupportticket::$_data[0]['owncaptcha_totaloperand']); ?></div>
                        <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('Select the total operands to be given', 'js-support-ticket'); ?></small></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Own captcha subtraction answer positive','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo JSSTformfield::select('owncaptcha_subtractionans', $yesno, jssupportticket::$_data[0]['owncaptcha_subtractionans']); ?></div>
                        <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('Is subtraction answer should be positive', 'js-support-ticket'); ?></small></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('New ticket message','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-5 js-ticket-configuration-value"><?php echo wp_editor(jssupportticket::$_data[0]['new_ticket_message'], 'new_ticket_message'); ?></div>
                        <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-description"><small><?php echo __('This message will show on new ticket', 'js-support-ticket'); ?></small></div>
                    </div>
                </table>
            </div>
            <div id="defaultemail">
                <h3 class="js-ticket-configuration-heading-main"> <?php echo __('Default email system', 'js-support-ticket') ?></h3>

                <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Default alert email', 'js-support-ticket') ?></div>
                    <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-value"><?php echo JSSTformfield::select('default_alert_email', jssupportticket::$_data[1], jssupportticket::$_data[0]['default_alert_email']); ?></div>
                    <div class="js-col-xs-12 js-col-md-4"><small><?php echo __('Set default alert email to send alerts', 'js-support-ticket'); ?></small></div>
                </div>
                <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Default admin email', 'js-support-ticket') ?></div>
                    <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-value"><?php echo JSSTformfield::select('default_admin_email', jssupportticket::$_data[1], jssupportticket::$_data[0]['default_admin_email']); ?></div>
                    <div class="js-col-xs-12 js-col-md-4"><small><?php echo __('Set default admin email to receive admin emails', 'js-support-ticket'); ?></small></div>
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
                  <h3 class="js-ticket-configuration-heading-main"><?php echo __('New ticket','js-support-ticket') ?></h3>

                  <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                  <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Mail to admin','js-support-ticket') ?></div>
                  <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-value"><?php echo JSSTformfield::select('new_ticket_mail_to_admin',$enableddisabled,jssupportticket::$_data[0]['new_ticket_mail_to_admin']);?></div>
                  <div class="js-col-xs-12 js-col-md-4"><small><?php echo __('Email send to admin when new ticket created','js-support-ticket'); ?></small></div>
                  </div>
                  <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                  <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Mail to staff members','js-support-ticket') ?></div>
                  <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-value"><?php echo JSSTformfield::select('new_ticket_mail_to_staff_members',$enableddisabled,jssupportticket::$_data[0]['new_ticket_mail_to_staff_members']);?></div>
                  <div class="js-col-xs-12 js-col-md-4"><small><?php echo __('Email send to staff member when new ticket created','js-support-ticket'); ?></small></div>
                  </div>

                 */ ?>
                <h3 class="js-ticket-configuration-heading-main"><?php echo __('Ban email new ticket', 'js-support-ticket') ?></h3>

                <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Mail to admin', 'js-support-ticket') ?></div>
                    <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-value"><?php echo JSSTformfield::select('banemail_mail_to_admin', $enableddisabled, jssupportticket::$_data[0]['banemail_mail_to_admin']); ?></div>
                    <div class="js-col-xs-12 js-col-md-4"><small><?php echo __('Email send to admin when banned email try to create ticket', 'js-support-ticket'); ?></small></div>
                </div>

                <table id="js-support-ticket-table">
                    <h3 class="js-ticket-configuration-heading-main"><?php echo __('Operations', 'js-support-ticket') ?></h3>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row js-ticket-config-xs-hide">
                        <div class="js-col-xs-12 js-col-md-3"></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-conf-text-sub"><?php echo __('Admin', 'js-support-ticket') ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-conf-text-sub"><?php echo __('Staff','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-conf-text-sub"><?php echo __('User', 'js-support-ticket') ?></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('New ticket', 'js-support-ticket') ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('Admin', 'js-support-ticket') ?></span><?php echo JSSTformfield::select('new_ticket_mail_to_admin', $enableddisabled, jssupportticket::$_data[0]['new_ticket_mail_to_admin']); ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('Staff', 'js-support-ticket') ?></span><?php echo JSSTformfield::select('new_ticket_mail_to_staff_members', $enableddisabled, jssupportticket::$_data[0]['new_ticket_mail_to_staff_members']); ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('User', 'js-support-ticket') ?></span></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Ticket reassign','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('Admin', 'js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_reassign_admin', $enableddisabled, jssupportticket::$_data[0]['ticket_reassign_admin']); ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('Staff', 'js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_reassign_staff', $enableddisabled, jssupportticket::$_data[0]['ticket_reassign_staff']); ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('User', 'js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_reassign_user', $enableddisabled, jssupportticket::$_data[0]['ticket_reassign_user']); ?></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Ticket close', 'js-support-ticket') ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('Admin', 'js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_close_admin', $enableddisabled, jssupportticket::$_data[0]['ticket_close_admin']); ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('Staff', 'js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_close_staff', $enableddisabled, jssupportticket::$_data[0]['ticket_close_staff']); ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('User', 'js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_close_user', $enableddisabled, jssupportticket::$_data[0]['ticket_close_user']); ?></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Ticket delete', 'js-support-ticket') ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('Admin', 'js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_delete_admin', $enableddisabled, jssupportticket::$_data[0]['ticket_delete_admin']); ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('Staff', 'js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_delete_staff', $enableddisabled, jssupportticket::$_data[0]['ticket_delete_staff']); ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('User', 'js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_delete_user', $enableddisabled, jssupportticket::$_data[0]['ticket_delete_user']); ?></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Ticket mark overdue','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('Admin', 'js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_mark_overdue_admin', $enableddisabled, jssupportticket::$_data[0]['ticket_mark_overdue_admin']); ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('Staff', 'js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_mark_overdue_staff', $enableddisabled, jssupportticket::$_data[0]['ticket_mark_overdue_staff']); ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('User', 'js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_mark_overdue_user', $enableddisabled, jssupportticket::$_data[0]['ticket_mark_overdue_user']); ?></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Ticket ban email','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('Admin', 'js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_ban_email_admin', $enableddisabled, jssupportticket::$_data[0]['ticket_ban_email_admin']); ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('Staff', 'js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_ban_email_staff', $enableddisabled, jssupportticket::$_data[0]['ticket_ban_email_staff']); ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('User', 'js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_ban_email_user', $enableddisabled, jssupportticket::$_data[0]['ticket_ban_email_user']); ?></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Ticket department transfer','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('Admin', 'js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_department_transfer_admin', $enableddisabled, jssupportticket::$_data[0]['ticket_department_transfer_admin']); ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('Staff', 'js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_department_transfer_staff', $enableddisabled, jssupportticket::$_data[0]['ticket_department_transfer_staff']); ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('User', 'js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_department_transfer_user', $enableddisabled, jssupportticket::$_data[0]['ticket_department_transfer_user']); ?></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Ticket reply ( Ticket User )', 'js-support-ticket') ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('Admin', 'js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_reply_ticket_user_admin', $enableddisabled, jssupportticket::$_data[0]['ticket_reply_ticket_user_admin']); ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('Staff', 'js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_reply_ticket_user_staff', $enableddisabled, jssupportticket::$_data[0]['ticket_reply_ticket_user_staff']); ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('User', 'js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_reply_ticket_user_user', $enableddisabled, jssupportticket::$_data[0]['ticket_reply_ticket_user_user']); ?></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Ticket Response ( Staff )', 'js-support-ticket') ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('Admin', 'js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_response_to_staff_admin', $enableddisabled, jssupportticket::$_data[0]['ticket_response_to_staff_admin']); ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('Staff', 'js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_response_to_staff_staff', $enableddisabled, jssupportticket::$_data[0]['ticket_response_to_staff_staff']); ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('User', 'js-support-ticket') ?></span><?php echo JSSTformfield::select('ticket_response_to_staff_user', $enableddisabled, jssupportticket::$_data[0]['ticket_response_to_staff_user']); ?></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Ticket ban email and close ticket','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('Admin', 'js-support-ticket') ?></span><?php echo JSSTformfield::select('ticker_ban_eamil_and_close_ticktet_admin', $enableddisabled, jssupportticket::$_data[0]['ticker_ban_eamil_and_close_ticktet_admin']); ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('Staff', 'js-support-ticket') ?></span><?php echo JSSTformfield::select('ticker_ban_eamil_and_close_ticktet_staff', $enableddisabled, jssupportticket::$_data[0]['ticker_ban_eamil_and_close_ticktet_staff']); ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('User', 'js-support-ticket') ?></span><?php echo JSSTformfield::select('ticker_ban_eamil_and_close_ticktet_user', $enableddisabled, jssupportticket::$_data[0]['ticker_ban_eamil_and_close_ticktet_user']); ?></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Ticket unban email','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('Admin', 'js-support-ticket') ?></span><?php echo JSSTformfield::select('unban_email_admin', $enableddisabled, jssupportticket::$_data[0]['unban_email_admin']); ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('Staff', 'js-support-ticket') ?></span><?php echo JSSTformfield::select('unban_email_staff', $enableddisabled, jssupportticket::$_data[0]['unban_email_staff']); ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><span class="js-ticket-config-xs-show-hide"><?php echo __('User', 'js-support-ticket') ?></span><?php echo JSSTformfield::select('unban_email_user', $enableddisabled, jssupportticket::$_data[0]['unban_email_user']); ?></div>
                    </div>

                </table>
                </fieldset>
            </div>
            <div id="ticketviaemail">
                <h3 class="js-ticket-configuration-heading-main"><?php echo __('Ticket create via email', 'js-support-ticket') ?></h3>
                <?php /*
                if(jssupportticket::$_config['tve_enabled'] == 1){
                ?>
                <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Status', 'js-support-ticket') ?></div>
                    <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-value">
                        <?php 
                            
                                if(jssupportticket::$_config['lastEmailReadingTime'] == null || jssupportticket::$_config['lastEmailReadingTime'] == '' ){
                                    echo __('NOT_RUNNING','js-support-ticket');
                                    echo '<a target="_blank" href="'.admin_url('admin.php?page=ticketviaemail&action=jstask&task=registerReadEmails').'">'.__('START_SERVICE').'</a>';
                                }else{
                                    echo __('RUNNING','js-support-ticket');
                                }
                            ?>
                    </div>
                    <div class="js-col-xs-12 js-col-md-4"><small><?php echo __('CURRENT_STATUS', 'js-support-ticket'); ?></small></div>
                </div>
                <?php
                            }
                            ?>
                */ ?>
                <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Enabled', 'js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                    <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-value"><?php echo JSSTformfield::select('tve_enabled', $enableddisabled, jssupportticket::$_data[0]['tve_enabled']); ?></div>
                    <div class="js-col-xs-12 js-col-md-4"><small><?php echo __('Enable ticket via email', 'js-support-ticket'); ?></small></div>
                </div>
                <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Ticket Type', 'js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                    <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-value"><?php echo JSSTformfield::select('tve_mailreadtype', $mailreadtype, jssupportticket::$_data[0]['tve_mailreadtype']); ?></div>
                    <div class="js-col-xs-12 js-col-md-4"><small><?php echo __('Which email type to read', 'js-support-ticket'); ?></small></div>
                </div>
                <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Attachments', 'js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                    <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-value"><?php echo JSSTformfield::select('tve_attachment', $yesno, jssupportticket::$_data[0]['tve_attachment']); ?></div>
                    <div class="js-col-xs-12 js-col-md-4"><small><?php echo __('Save attachments if found in email', 'js-support-ticket'); ?></small></div>
                </div>
                <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Email Reading After', 'js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                    <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-value"><?php echo JSSTformfield::text('tve_emailreadingdelay', jssupportticket::$_data[0]['tve_emailreadingdelay']); echo __('Seconds','js-support-ticket'); ?></div>
                    <div class="js-col-xs-12 js-col-md-4"><small><?php echo __('Email reads after given seconds', 'js-support-ticket'); ?></small></div>
                </div>
                <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Host Type', 'js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                    <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-value"><?php echo JSSTformfield::select('tve_hosttype', $hosttype, jssupportticket::$_data[0]['tve_hosttype'],null,array('onchange'=>'showhidehostname(this.value);')); ?></div>
                    <div class="js-col-xs-12 js-col-md-4"><small><?php echo __('Select your email service provider', 'js-support-ticket'); ?></small></div>
                </div>
                <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row" id="tve_hostname">
                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Host Name', 'js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                    <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-value"><?php echo JSSTformfield::text('tve_hostname', jssupportticket::$_data[0]['tve_hostname']); ?></div>
                    <div class="js-col-xs-12 js-col-md-4"><small><?php echo __('Host Name','js-support-ticket').' www.joomsky.com '.__('Or','js-support-ticket').' www.abc.com'; ?></small></div>
                </div>
                <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Email Address', 'js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                    <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-value"><?php echo JSSTformfield::text('tve_emailaddress', jssupportticket::$_data[0]['tve_emailaddress']); ?></div>
                    <div class="js-col-xs-12 js-col-md-4"><small><?php echo __('Email address to read emails', 'js-support-ticket'); ?></small></div>
                </div>
                <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                    <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Password', 'js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                    <div class="js-col-xs-12 js-col-md-4 js-ticket-configuration-value"><?php echo JSSTformfield::password('tve_emailpassword', jssupportticket::$_data[0]['tve_emailpassword']); ?></div>
                    <div class="js-col-xs-12 js-col-md-4"><small><?php echo __('Password for given email address', 'js-support-ticket'); ?></small></div>
                </div>
                </fieldset>
            </div>
            <div id="menusetting">
                <h3 class="js-ticket-configuration-heading-main"><?php echo __('Staff members control panel links', 'js-support-ticket') ?></h3>
                <div class="js-ticket-configuration-table">
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Open Ticket','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_openticket_staff', $showhide, jssupportticket::$_data[0]['cplink_openticket_staff']) ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('My Tickets','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_myticket_staff', $showhide, jssupportticket::$_data[0]['cplink_myticket_staff']) ?></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Add Role','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_addrole_staff', $showhide, jssupportticket::$_data[0]['cplink_addrole_staff']) ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Roles','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_roles_staff', $showhide, jssupportticket::$_data[0]['cplink_roles_staff']) ?></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Add Staff','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_addstaff_staff', $showhide, jssupportticket::$_data[0]['cplink_addstaff_staff']) ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Staff','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_staff_staff', $showhide, jssupportticket::$_data[0]['cplink_staff_staff']) ?></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Add Department','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_adddepartment_staff', $showhide, jssupportticket::$_data[0]['cplink_adddepartment_staff']) ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Department','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_department_staff', $showhide, jssupportticket::$_data[0]['cplink_department_staff']) ?></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Add Category','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_addcategory_staff', $showhide, jssupportticket::$_data[0]['cplink_addcategory_staff']) ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Category','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_category_staff', $showhide, jssupportticket::$_data[0]['cplink_category_staff']) ?></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Add Knowledge Base','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_addkbarticle_staff', $showhide, jssupportticket::$_data[0]['cplink_addkbarticle_staff']) ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Knowledge Base','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_kbarticle_staff', $showhide, jssupportticket::$_data[0]['cplink_kbarticle_staff']) ?></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Add Download','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_adddownload_staff', $showhide, jssupportticket::$_data[0]['cplink_adddownload_staff']) ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Download','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_download_staff', $showhide, jssupportticket::$_data[0]['cplink_download_staff']) ?></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Add Announcement','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_addannouncement_staff', $showhide, jssupportticket::$_data[0]['cplink_addannouncement_staff']) ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Announcement','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_announcement_staff', $showhide, jssupportticket::$_data[0]['cplink_announcement_staff']) ?></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Add FAQ','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_addfaq_staff', $showhide, jssupportticket::$_data[0]['cplink_addfaq_staff']) ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __("FAQ's",'js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_faq_staff', $showhide, jssupportticket::$_data[0]['cplink_faq_staff']) ?></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Mail','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_mail_staff', $showhide, jssupportticket::$_data[0]['cplink_mail_staff']) ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('My Profile','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_myprofile_staff', $showhide, jssupportticket::$_data[0]['cplink_myprofile_staff']) ?></div>
                    </div>
                </div>
                <h3 class="js-ticket-configuration-heading-main"><?php echo __('Staff top menu links', 'js-support-ticket') ?></h3>
                <div class="js-ticket-configuration-table">
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Home','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('tplink_home_staff', $showhide, jssupportticket::$_data[0]['tplink_home_staff']) ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Tickets','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('tplink_tickets_staff', $showhide, jssupportticket::$_data[0]['tplink_tickets_staff']) ?></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Knowledge Base','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('tplink_knowledgebase_staff', $showhide, jssupportticket::$_data[0]['tplink_knowledgebase_staff']) ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Announcements','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('tplink_announcements_staff', $showhide, jssupportticket::$_data[0]['tplink_announcements_staff']) ?></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Downloads','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('tplink_downloads_staff', $showhide, jssupportticket::$_data[0]['tplink_downloads_staff']) ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __("FAQ's",'js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('tplink_faqs_staff', $showhide, jssupportticket::$_data[0]['tplink_faqs_staff']) ?></div>
                    </div>
                </div>                        
                <h3 class="js-ticket-configuration-heading-main"><?php echo __('User control panel links', 'js-support-ticket') ?></h3>
                <div class="js-ticket-configuration-table">
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Open Ticket', 'js-support-ticket') ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_openticket_user', $showhide, jssupportticket::$_data[0]['cplink_openticket_user']) ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('My Tickets', 'js-support-ticket') ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_myticket_user', $showhide, jssupportticket::$_data[0]['cplink_myticket_user']) ?></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Check Ticket Status','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_checkticketstatus_user', $showhide, jssupportticket::$_data[0]['cplink_checkticketstatus_user']) ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Downloads','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_downloads_user', $showhide, jssupportticket::$_data[0]['cplink_downloads_user']) ?></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Announcements','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_announcements_user', $showhide, jssupportticket::$_data[0]['cplink_announcements_user']) ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __("FAQ's",'js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_faqs_user', $showhide, jssupportticket::$_data[0]['cplink_faqs_user']) ?></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Knowledge Base','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('cplink_knowledgebase_user', $showhide, jssupportticket::$_data[0]['cplink_knowledgebase_user']) ?></div>
                    </div>
                </div>
                <h3 class="js-ticket-configuration-heading-main"><?php echo __('User top menu links', 'js-support-ticket') ?></h3>
                <div class="js-ticket-configuration-table">
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Home','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('tplink_home_user', $showhide, jssupportticket::$_data[0]['tplink_home_user']) ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Tickets','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('tplink_tickets_user', $showhide, jssupportticket::$_data[0]['tplink_tickets_user']) ?></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Knowledge Base','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('tplink_knowledgebase_user', $showhide, jssupportticket::$_data[0]['tplink_knowledgebase_user']) ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Announcements','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('tplink_announcements_user', $showhide, jssupportticket::$_data[0]['tplink_announcements_user']) ?></div>
                    </div>
                    <div class="js-col-xs-12 js-col-md-12 js-ticket-configuration-row">
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __('Downloads','js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('tplink_downloads_user', $showhide, jssupportticket::$_data[0]['tplink_downloads_user']) ?></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-title"><?php echo __("FAQ's",'js-support-ticket') ?><font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font></div>
                        <div class="js-col-xs-12 js-col-md-3 js-ticket-configuration-value"><?php echo JSSTformfield::select('tplink_faqs_user', $showhide, jssupportticket::$_data[0]['tplink_faqs_user']) ?></div>
                    </div>
                </div>                        
            </div>

        </div>
    </div>
    <?php echo JSSTformfield::hidden('action', 'configuration_saveconfiguration'); ?>
    <?php echo JSSTformfield::hidden('form_request', 'jssupportticket'); ?>
    <div class="js-form-button">
        <?php echo JSSTformfield::submitbutton('save', __('Save Configurations', 'js-support-ticket'), array('class' => 'button')); ?>
    </div>
     <div class="js-form-button">
        <?php echo '<font style="color:#1C6288;font-size:20px;margin:0px 5px;">*</font>'.__('Pro version only','js-support-ticket'); ?>
    </div>
</form>
