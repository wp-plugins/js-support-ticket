<?php
if (jssupportticket::$_config['offline'] == 2) {
    if( get_current_user_id() != 0 ){    ?>
        <?php 
        JSSTmessage::getMessage();
        wp_enqueue_script('file_validate.js', jssupportticket::$_pluginpath . 'includes/js/file_validate.js');
        wp_enqueue_script('jquery-ui-tabs');
        wp_enqueue_script('jquery.cluetip.min.js', jssupportticket::$_pluginpath . 'includes/js/jquery.cluetip.min.js');
        wp_enqueue_script('jquery.hoverIntent.js', jssupportticket::$_pluginpath . 'includes/js/jquery.hoverIntent.js');
        wp_enqueue_style('jquery.cluetip', jssupportticket::$_pluginpath . 'includes/css/jquery.cluetip.css');
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                //$('img.tooltip').cluetip({splitTitle: '|'});
                jQuery("#tabs").tabs();
                jQuery("#tk_attachment_add").click(function () {
                    var obj = this;
                    var current_files = jQuery('input[type="file"]').length;
                    var total_allow =<?php echo jssupportticket::$_config['no_of_attachement']; ?>;
                    var append_text = "<span class='tk_attachment_value_text'><input name='filename[]' type='file' onchange=\"uploadfile(this,'<?php echo jssupportticket::$_config['file_maximum_size']; ?>','<?php echo jssupportticket::$_config['file_extension']; ?>');\" size='20' maxlenght='30'  /><span  class='tk_attachment_remove'></span></span>";
                    if (current_files < total_allow) {
                        jQuery(".tk_attachment_value_wrapperform").append(append_text);
                    } else if ((current_files === total_allow) || (current_files > total_allow)) {
                        alert('<?php echo __('File upload limit exceed', 'js-support-ticket'); ?>');
                        obj.hide();
                    }
                });
                jQuery(document).delegate(".tk_attachment_remove", "click", function (e) {
                    jQuery(this).parent().remove();
                    var current_files = jQuery('input[type="file"]').length;
                    var total_allow =<?php echo jssupportticket::$_config['no_of_attachement']; ?>;
                    if (current_files < total_allow) {
                        jQuery("#tk_attachment_add").show();
                    }
                });
                jQuery("a#showhidedetail").click(function (e) {
                    e.preventDefault();
                    var divid = jQuery(this).attr('data-divid');
                    jQuery("div#" + divid).slideToggle();
                    jQuery(this).find('img').toggleClass('js-hidedetail');
                });
                jQuery("a#showaction").click(function (e) {
                    e.preventDefault();
                    jQuery("div#action-div").slideToggle();
                });
                jQuery("div#popup-back,span.close-history").click(function (e) {
                    jQuery("div#userpopup").slideUp('slow');
                    setTimeout(function () {
                        jQuery('div#popup-back').hide();
                    }, 700);
                });
            });
            function actionticket(action) {
                /*  Action meaning
                 * 1 -> Change Priority
                 * 2 -> Close Ticket
                 * 2 -> Reopen Ticket
                 */
                jQuery("input#actionid").val(action);
                jQuery("form#adminTicketform").submit();
            }
            function checktinymcebyid(id) {
                var content = tinymce.get(id).getContent({format: 'text'});
                if (jQuery.trim(content) == '')
                {
                    alert('<?php echo __('Please fill message field', 'js-support-ticket'); ?>');
                    return false;
                }
                return true;
            }
        </script>
        <div id="popup-back" style="display:none;"> </div>
        <span style="display:none" id="filesize"><?php echo __('Error file size to large', 'js-support-ticket'); ?></span>
        <span style="display:none" id="fileext"><?php echo __('Error file ext mismatch', 'js-support-ticket'); ?></span>
        <?php JSSTbreadcrumbs::getBreadcrumbs(); ?>
        <?php
            if (!empty(jssupportticket::$_data[0])) {
                if(jssupportticket::$_data[0]->status==0){
                    $style = "red;";
                    $status = __('New', 'js-support-ticket');
                } elseif (jssupportticket::$_data[0]->status == 1) {
                    $style = "orange;";
                    $status = __('Waiting reply', 'js-support-ticket');
                } elseif (jssupportticket::$_data[0]->status == 3) {
                    $style = "green;";
                    $status = __('Replied', 'js-support-ticket');
                } elseif (jssupportticket::$_data[0]->status == 4) {
                    $style = "blue;";
                    $status = __('Closed', 'js-support-ticket');
                }

                $cur_uid = get_current_user_id();
                    $link = site_url("?page_id=" . jssupportticket::getPageid() . "&module=reply&task=savereply");
                ?>	

                <h1 class="js-ticket-heading"><?php echo __('Ticket Details', 'js-support-ticket') ?></h1>
                <form method="post" action="<?php echo $link; ?>" id="adminTicketform" enctype="multipart/form-data">
                    <div class="js-col-md-12 js-ticket-detail-wrapper">
                        <div class="js-row js-ticket-topbar">
                            <div class="js-col-md-5 js-openclosed">
                                <div class="js-col-xs-12 js-col-md-5 js-ticket-openclosed">
                                    <?php
                                    if (jssupportticket::$_data[0]->status == 4)
                                        $ticketmessage = __('Closed', 'js-support-ticket');
                                    else
                                        $ticketmessage = __('Open', 'js-support-ticket');
                                    echo $ticketmessage;
                                    ?>
                                </div>
                                <div class="js-col-xs-12 js-col-md-7 js-ticket-detail-wrapper-padding-xs">
                                    <?php
                                    echo __('Created', 'js-support-ticket') . ' ';
                                    $startTimeStamp = strtotime(jssupportticket::$_data[0]->created);
                                    $endTimeStamp = strtotime("now");
                                    $timeDiff = abs($endTimeStamp - $startTimeStamp);
                                    $numberDays = $timeDiff / 86400;  // 86400 seconds in one day
                                    // and you might want to convert to integer
                                    $numberDays = intval($numberDays);
                                    if ($numberDays != 0 && $numberDays == 1) {
                                        $day_text = __('Day', 'js-support-ticket');
                                    } elseif ($numberDays > 1) {
                                        $day_text = __('Days', 'js-support-ticket');
                                    } elseif ($numberDays == 0) {
                                        $day_text = __('Today', 'js-support-ticket');
                                    }
                                    if ($numberDays == 0) {
                                        echo $day_text;
                                    } else {
                                        echo $numberDays . ' ' . $day_text . ' ';
                                        echo __('Ago', 'js-support-ticket');
                                    }
                                    echo ' ' . date("d F, Y, h:i:s A", strtotime(jssupportticket::$_data[0]->created));
                                    ?>
                                </div>
                            </div>
                            <div class="js-col-xs-12 js-col-md-4 js-mid-ticketdetail-part">
                                <div class="js-row js-margin-bottom">
                                    <div class="js-col-xs-5 js-col-md-6 js-ticket-title"><?php echo __('Ticket ID', 'js-support-ticket'); ?></div>
                                    <div class="js-col-xs-6 js-col-md-5 js-ticket-value js-border-box"><?php echo jssupportticket::$_data[0]->ticketid; ?></div>
                                </div>
                                <div class="js-row">
                                    <div class="js-col-xs-5 js-col-md-6 js-ticket-title"><?php echo __('Priority', 'js-support-ticket'); ?></div>
                                    <div class="js-col-xs-6 js-col-md-5 js-ticket-value js-ticket-wrapper-textcolor" style="background:<?php echo jssupportticket::$_data[0]->prioritycolour; ?>;"><?php echo __(jssupportticket::$_data[0]->priority, 'js-support-ticket'); ?></div>
                                </div>
                            </div>
                            <div class="js-col-xs-12 js-col-md-3 js-last-left">
                                <div class="js-row">
                                    <div class="js-col-xs-5 js-col-md-6 js-ticket-title"><?php echo __('Last Reply', 'js-support-ticket'); ?></div>
                                    <div class="js-col-xs-6 js-col-md-5 js-ticket-value"><?php if (empty(jssupportticket::$_data[0]->lastreply) || jssupportticket::$_data[0]->lastreply == '0000-00-00 00:00:00') echo __('No Last Reply', 'js-support-ticket');
                                    else echo date(jssupportticket::$_config['date_format'], strtotime(jssupportticket::$_data[0]->lastreply)); ?></div>
                                </div>
                                <div class="js-row">
                                    <div class="js-col-xs-5 js-col-md-6 js-ticket-title"><?php echo __('Status', 'js-support-ticket'); ?></div>
                                    <div class="js-col-xs-6 js-col-md-5 js-ticket-value">
                                        <?php
                                        $printstatus = 1;
                                        if ($printstatus == 1) {
                                            echo $ticketmessage;
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="js-row js-ticket-middlebar">
                            <div class="js-col-xs-12 js-col-md-9 js-nullpadding js-ticket-detail-wrapper-padding-xs js-ticket-detail-wrapper-xs-lineheight">
                                <div class="js-col-xs-12 js-col-md-12 js-ticket-detail-wrapper-padding-xs js-ticket-body-data-elipses">
                                    <span class="js-ticket-title textstylebold"><?php echo __('Subject', 'js-support-ticket'); ?>&nbsp;:&nbsp;</span>
                                    <span class="js-ticket-value"><?php echo jssupportticket::$_data[0]->subject; ?></span>
                                </div>
                                <div class="js-col-xs-12 js-col-md-12 js-ticket-detail-wrapper-padding-xs js-ticket-body-data-elipses">
                                    <span class="js-ticket-title textstylebold"><?php echo __('From', 'js-support-ticket'); ?>&nbsp;:&nbsp;</span>
                                    <span class="js-ticket-value"><?php echo jssupportticket::$_data[0]->name; ?></span>
                                </div>
                                <div class="js-col-xs-12 js-col-md-12 js-ticket-detail-wrapper-padding-xs js-ticket-body-data-elipses">
                                    <span class="js-ticket-title textstylebold"><?php echo __('Department', 'js-support-ticket'); ?>&nbsp;:&nbsp;</span>
                                    <span class="js-ticket-value"><?php echo __(jssupportticket::$_data[0]->departmentname, 'js-support-ticket'); ?></span>
                                </div>
                                </div>
                            <div class="js-col-xs-12 js-col-md-3 js-button-margin">
                                    <?php if (jssupportticket::$_data[0]->status != 4) { ?>
                                        <a style="height:36px" onclick="return confirm('<?php echo __('Are you sure to close ticket Ticket', 'js-support-ticket'); ?>');" class="button" href="<?php echo site_url("?page_id=" . jssupportticket::getPageid() . "&module=ticket&task=closeticket&action=jstask&ticketid=" . jssupportticket::$_data[0]->id); ?>"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/remove.png" title="<?php echo __('Delete ticket', 'js-support-ticket'); ?>" /><?php echo __('Close Ticket', 'js-support-ticket'); ?></a>
                                        &nbsp;
                                <?php }else{ 
                                        if (JSSTincluder::getJSModel('ticket')->checkCanReopenTicket(jssupportticket::$_data[0]->id)) {
                                            $link = site_url("?page_id=" . jssupportticket::getPageid() . "&module=ticket&action=jstask&task=reopenticket&ticketid=" . jssupportticket::$_data[0]->id);
                                            ?>
                                            <a class="button" href="<?php echo $link; ?>" alt="<?php echo __('Reopen Ticket', 'js-support-ticket'); ?>"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/reopen.png" title="<?php echo __('Reopen Ticket', 'js-support-ticket'); ?>" /></a>

                                <?php }
                                 } ?>
                      </div>
                    </div>
                    </div>
                    <div class="js-col-md-12 js-ticket-detail-wrapper">
                        <div class="js-row js-ticket-requester"><?php echo __('Requester Info', 'js-support-ticket'); ?></div>
                        <div class="js-row js-ticket-bottombar">
                            <div class="js-col-md-4">
                                <img src="<?php echo jssupportticket::$_pluginpath . 'includes/images/smallticketman.png'; ?>" />
                <?php echo jssupportticket::$_data[0]->name; ?>
                            </div>
                            <div class="js-col-md-5">
                                <img src="<?php echo jssupportticket::$_pluginpath . 'includes/images/smallmail.png'; ?>" />
                <?php echo jssupportticket::$_data[0]->email; ?>
                            </div>
                            <div class="js-col-md-3">
                                <a href="#" id="showhidedetail" data-divid="js-hidden-ticket-data"><img class="js-showdetail" src="<?php echo jssupportticket::$_pluginpath . 'includes/images/showhide.png'; ?>" /><?php echo __('Show Detail', 'js-support-ticket'); ?></a>
                            </div>
                            <div id="js-hidden-ticket-data">
                                <div class="js-row js-ticket-requester"><?php echo __('More Detail', 'js-support-ticket'); ?></div>
                                <div class="js-row">
                                    <div class="js-col-md-6 js-col-xs-12 js-ticket-moredetail">
                                        <div class="js-col-md-6 js-col-xs-5 js-ticket-data-title"><?php echo __('Phone', 'js-support-ticket'); ?></div>
                                        <div class="js-col-md-6 js-col-xs-7 js-ticket-data-value"><?php echo jssupportticket::$_data[0]->phone; ?></div>
                                    </div>
                                    <?php
                                    foreach (jssupportticket::$_data[2] as $ufield) {
                                        echo '<div class="js-col-md-6 js-col-xs-12 js-ticket-moredetail">';
                                        $userfeild = $ufield[0];
                                        echo '<div class="js-col-md-6 js-col-xs-5 js-ticket-data-title">' . $userfeild->title . '</div>';
                                        if ($userfeild->type == "checkbox") {
                                            if (isset($ufield[1])) {
                                                $fvalue = $ufield[1]->data;
                                                $userdataid = $ufield[1]->id;
                                            } else {
                                                $fvalue = "";
                                                $userdataid = "";
                                            }
                                            if ($fvalue == '1')
                                                $fvalue = __('True', 'js-support-ticket');
                                            else
                                                $fvalue = __('False', 'js-support-ticket');
                                        }elseif ($userfeild->type == "select") {
                                            if (isset($ufield[2])) {
                                                $fvalue = $ufield[2]->fieldtitle;
                                                $userdataid = $ufield[2]->id;
                                            } else {
                                                $fvalue = "";
                                                $userdataid = "";
                                            }
                                        } else {
                                            if (isset($ufield[1])) {
                                                $fvalue = $ufield[1]->data;
                                                $userdataid = $ufield[1]->id;
                                            } else {
                                                $fvalue = "";
                                                $userdataid = "";
                                            }
                                        }
                                        if ($fvalue == "")
                                            $fvalue = __('Not Filled', 'js-support-ticket');
                                        echo '<div class="js-col-md-6 js-col-xs-7 js-ticket-data-value">' . $fvalue . '</div></div>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>  
                    </div>                
                    <?php
                    $colored = "colored";
                        ?>
                    <div class="js-col-lg-12 js-col-xs-12 js-ticket-suheading"><?php echo __('Ticket Thread', 'js-support-ticket'); ?></div>
                    <div class="js-col-xs-3 js-col-md-2 js-ticket-thread-pic">
                            <img src="<?php echo jssupportticket::$_pluginpath . '/includes/images/ticketmanbig.png'; ?>" />
                    </div>
                    <div class="js-col-xs-9 js-col-md-10 js-ticket-thread-wrapper colored">
                        <div class="js-ticket-detail-corner"></div>
                        <div class="js-ticket-thread-upperpart">
                            <span class="js-ticket-thread-replied"><?php echo __('Replied By', 'js-support-ticket'); ?>&nbsp;:&nbsp;</span>
                            <span class="js-ticket-thread-person"><?php echo jssupportticket::$_data[0]->name; ?></span>
                            <span class="js-ticket-thread-date">(&nbsp;<?php echo date("l F d, Y, h:i:s", strtotime(jssupportticket::$_data[0]->created)); ?>&nbsp;)</span>
                        </div>
                        <div class="js-ticket-thread-middlepart">
                        <?php echo jssupportticket::$_data[0]->message; ?>
                        </div>
                        <?php
                        if (!empty(jssupportticket::$_data['ticket_attachment'])) {
                            $datadirectory = jssupportticket::$_config['data_directory'];
                            $path = 'wp-content/plugins/js-support-ticket/' . $datadirectory;
                            $path = $path . '/attachmentdata';
                            $path = $path . '/ticket/ticket_' . jssupportticket::$_data[0]->id . '/';
                            foreach (jssupportticket::$_data['ticket_attachment'] AS $attachment) {
                                echo '
                              <div class="js_ticketattachment">
                                ' . $attachment->filename . ' ( ' . $attachment->filesize . ' ) ' . '              
                                <a class="button" target="_blank" href="' . site_url($path . $attachment->filename) . '">' . __('Download', 'js-support-ticket') . '</a>
                              </div>';
                            }
                        }
                        ?>
                    </div>
                        <?php
                        $colored = "colored";
                        if (!empty(jssupportticket::$_data[4]))
                            foreach (jssupportticket::$_data[4] AS $reply):
                                if ($cur_uid == $reply->uid)
                                    $colored = '';
                                ?>
                            <div class="js-col-xs-3 js-col-md-2 js-ticket-thread-pic">
                                    <img src="<?php echo jssupportticket::$_pluginpath . '/includes/images/ticketmanbig.png'; ?>" />
                            </div>
                            <div class="js-col-xs-9 js-col-md-10 js-ticket-thread-wrapper <?php echo $colored; ?>">
                                <div class="js-ticket-detail-corner"></div>
                                <div class="js-ticket-thread-upperpart">
                                    <span class="js-ticket-thread-replied"><?php echo __('Replied By', 'js-support-ticket'); ?>&nbsp;:&nbsp;</span>
                                    <span class="js-ticket-thread-person"><?php echo $reply->name; ?></span>
                                    <span class="js-ticket-thread-date">(&nbsp;<?php echo date("l F d, Y, h:i:s", strtotime($reply->created)); ?>&nbsp;)</span>
                                    <span class="js-ticket-via-email"><?php echo ($reply->ticketviaemail == 1) ? __('Created via Email', 'js-support-ticket') : ''; ?></span>
                                </div>
                                <div class="js-ticket-thread-middlepart">
                        <?php echo $reply->message; ?>
                                </div>
                        <?php
                        if (!empty($reply->attachments)) {
                            $datadirectory = jssupportticket::$_config['data_directory'];
                            $path = 'wp-content/plugins/js-support-ticket/' . $datadirectory;
                            $path = $path . '/attachmentdata';
                            $path = $path . '/ticket/ticket_' . jssupportticket::$_data[0]->id . '/';
                            foreach ($reply->attachments AS $attachment) {
                                echo '
                                    <div class="js_ticketattachment">
                                      ' . $attachment->filename . ' ( ' . $attachment->filesize . ' ) ' . '
                                      <a class="button" target="_blank" href="' . site_url($path . $attachment->filename) . '">' . __('Download', 'js-support-ticket') . '</a>
                                    </div>';
                            }
                        }
                        ?>
                            </div>
                    <?php endforeach; ?>
                    <?php echo JSSTformfield::hidden('actionid', ''); ?>
                    <?php echo JSSTformfield::hidden('ticketid', jssupportticket::$_data[0]->id); ?>
                    <?php echo JSSTformfield::hidden('created', jssupportticket::$_data[0]->created); ?>
                                            <?php echo JSSTformfield::hidden('uid', get_current_user_id()); ?>
                                            <?php echo JSSTformfield::hidden('updated', jssupportticket::$_data[0]->updated); ?>
                    <?php echo JSSTformfield::hidden('form_request', 'jssupportticket'); ?>
                    </form>

                    <div class="js-col-xs-12 js-col-md-12 js-ticket-suheading">
                      <?php echo __('Post Reply','js-support-ticket'); ?>
                    </div>
                    <form class="js-col-xs-12 js-col-md-12 post-reply-textarea"  method="post" action="<?php echo site_url("?page_id=".jssupportticket::$_pageid."&module=reply&task=savereply"); ?>" enctype="multipart/form-data">
                          <div class="js-form-wrapper">
                            <div class="js-col-xs-12 js-col-md-12"><?php echo wp_editor('','message',array( 'media_buttons' => false ));?></div>
                          </div>
                                        <div class="js-col-xs-12 js-form-title-position-reletive-left"><?php echo __('Attachments', 'js-support-ticket'); ?></div>
                                        <div class="js-col-xs-12 js-form-field">
                                            <div class="tk_attachment_value_wrapperform">
                                                <span class="js-col-xs-12 tk_attachment_value_text">
                                                    <input type="file" class="inputbox selectFile" name="filename[]" onchange="uploadfile(this, '<?php echo jssupportticket::$_config['file_maximum_size']; ?>', '<?php echo jssupportticket::$_config['file_extension']; ?>');" size="20" maxlenght='30'/>
                                                </span>
                                            </div>

                                            <div class="js-col-xs-12 js-col-md-12"><span id="tk_attachment_add" class="tk_attachments_addform"><?php echo __('Add More File', 'js-support-ticket'); ?></span></div>
                                            <span class="fileLimits">
                                                <small class"js-col-xs-12"><?php echo __('Maximum File Size', 'js-support-ticket');
                    echo ' (' . jssupportticket::$_config['file_maximum_size']; ?> KB)<br><?php echo __('File Extension Type', 'js-support-ticket');
                    echo ' (' . jssupportticket::$_config['file_extension'] . ')'; ?></small>
                                            </span>

                                        </div>
                            
                          <div class="js-col-xs-12 js-col-md-12 js-form-wrapper">
                                        <div class="js-form-title"><?php echo __('Ticket Status', 'js-support-ticket'); ?></div>
                                        <div class="js-col-xs-12 js-col-md-6 replyFormStatus"><?php echo JSSTformfield::checkbox('closeonreply', array('1' => __('Close on reply', 'js-support-ticket')), '', array('class' => 'radiobutton')); ?></div>
                                    </div>
                                    <div class="js-form-button">
                                    <?php echo JSSTformfield::submitbutton('postreply', __('Post Reply', 'js-support-ticket'), array('class' => 'button', 'onclick' => "return checktinymcebyid('message');")); ?>
                                    </div>
                                    <?php echo JSSTformfield::hidden('departmentid', jssupportticket::$_data[0]->departmentid); ?>
                    <?php echo JSSTformfield::hidden('ticketid', jssupportticket::$_data[0]->id); ?>
                    <?php echo JSSTformfield::hidden('uid', get_current_user_id()); ?>
                    <?php echo JSSTformfield::hidden('action', 'reply_savereply'); ?>
                    <?php echo JSSTformfield::hidden('form_request', 'jssupportticket'); ?>
                                </form>   
                        
                      
                <?php
            } else { // Record Not FOund
                JSSTlayout::getNoRecordFound();
        }
    } else {// User is guest
        JSSTlayout::getUserGuest();
    }
} else { // System is offline
    JSSTlayout::getSystemOffline();
}
?>
