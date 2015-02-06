<div id="jsst-main-wrapper" >
    <div id="jsst-upper-wrapper">
        <span class="jsst-title"><?php echo __('JS_SUPPORT_TICKET_PRO_INSTALLER', 'js-support-ticket'); ?></span>
        <span class="jsst-logo"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/jsticketpro.png" /></span>
    </div>
    <div id="jsst-middle-wrapper">
        <div class="js-col-md-4 active"><span class="jsst-number">1</span><span class="jsst-text"><?php echo __('CONFIGURATION', 'js-support-ticket'); ?></span></div>
        <div class="js-col-md-4 active"><span class="jsst-number">2</span><span class="jsst-text"><?php echo __('PERMISSIONS', 'js-support-ticket'); ?></span></div>
        <div class="js-col-md-4"><span class="jsst-number">3</span><span class="jsst-text"><?php echo __('INSTALLATION', 'js-support-ticket'); ?></span></div>
        <div class="js-col-md-4"><span class="jsst-number">4</span><span class="jsst-text"><?php echo __('FINISH', 'js-support-ticket'); ?></span></div>        
    </div>
    <div id="jsst-lower-wrapper">
        <span class="jsst-main-title"><?php echo __('PERMISSIONS', 'js-support-ticket'); ?></span>
        <?php if ((jssupportticket::$_data['step2']['dir'] < 755 ) || (jssupportticket::$_data['step2']['create_table'] != 1) || (jssupportticket::$_data['step2']['insert_record'] != 1) || (jssupportticket::$_data['step2']['update_record'] != 1 ) || (jssupportticket::$_data['step2']['delete_record'] != 1 ) || (jssupportticket::$_data['step2']['drop_table'] != 1 ) || (jssupportticket::$_data['step2']['file_downloaded'] != 1 )) { ?>
            <div class="js-row jsst-main-error" id="jsst-table-data">
                <img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/error_icon.png" />
                <div class="js-row">
                    <span class="jsst-main-error"><?php echo __('ERROR_OCCURED', 'js-support-ticket'); ?></span>
                        <?php if (jssupportticket::$_data['step2']['dir'] < 755) { ?>
                            <span class="jsst-error-line"><?php echo __('DIRECTORY_PERMISSIONS_ERROR', 'js-support-ticket'); ?></span>
                        <?php } ?>
                        <?php if (jssupportticket::$_data['step2']['create_table'] != 1) { ?>
                            <span class="jsst-error-line"><?php echo __('DATABASE_CREATE_TABLE_NOT_ALLOWED', 'js-support-ticket'); ?></span>
                        <?php } ?>
                        <?php if (jssupportticket::$_data['step2']['insert_record'] != 1) { ?>
                            <span class="jsst-error-line"><?php echo __('DATABASE_INSERT_RECORD_NOT_ALLOWED', 'js-support-ticket'); ?></span>
                        <?php } ?>
                        <?php if (jssupportticket::$_data['step2']['update_record'] != 1) { ?>
                            <span class="jsst-error-line"><?php echo __('DATABASE_UPDATE_RECORD_NOT_ALLOWED', 'js-support-ticket'); ?></span>
                        <?php } ?>
                        <?php if (jssupportticket::$_data['step2']['delete_record'] != 1) { ?>
                            <span class="jsst-error-line"><?php echo __('DATABASE_DELETE_RECORD_NOT_ALLOWED', 'js-support-ticket'); ?></span>
                        <?php } ?>
                        <?php if (jssupportticket::$_data['step2']['drop_table'] != 1) { ?>
                            <span class="jsst-error-line"><?php echo __('DATABASE_DROP_TABLE_NOT_ALLOWED', 'js-support-ticket'); ?></span>
                        <?php } ?>
                        <?php if (jssupportticket::$_data['step2']['file_downloaded'] != 1) { ?>
                            <span class="jsst-error-line"><?php echo __('ERROR_FILE_NOT_DOWNLOADED', 'js-support-ticket'); ?></span>
                        <?php } ?>
                    </div>
            </div>
        <?php } ?>
        <div class="js-row" id="jsst-table-head">
            <div class="js-col-md-8"><?php echo __('SETTING', 'js-support-ticket'); ?></div>
            <div class="js-col-md-2"><?php echo __('RECOMENDED', 'js-support-ticket'); ?></div>
            <div class="js-col-md-2"><?php echo __('CURRENT', 'js-support-ticket'); ?></div>
        </div>
        <div class="js-row <?php if(jssupportticket::$_data['step2']['dir'] < 755) echo 'error'; ?>" id="jsst-table-data">
            <div class="js-col-md-8"><?php echo __('DIRECTORY', 'js-support-ticket'); ?></div>
            <div class="js-col-md-2 image"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/tick.png" /></div>
            <div class="js-col-md-2 image"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/<?php
                if (jssupportticket::$_data['step2']['dir'] >= 755)
                    echo "tick";
                else
                    echo "cross";
                ?>.png" /></div>
        </div>
        <div class="js-row <?php if((jssupportticket::$_data['step2']['create_table'] != 1) || (jssupportticket::$_data['step2']['insert_record'] != 1) || (jssupportticket::$_data['step2']['update_record'] != 1 ) || (jssupportticket::$_data['step2']['delete_record'] != 1 ) && (jssupportticket::$_data['step2']['drop_table'] != 1 )) echo 'error'; ?>" id="jsst-table-data">
            <div class="js-col-md-8"><?php echo __('DATABASE_CRUD', 'js-support-ticket'); ?></div>
            <div class="js-col-md-2 image"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/tick.png" /></div>
            <div class="js-col-md-2 image"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/<?php
                if (jssupportticket::$_data['step2']['create_table'] == 1 && jssupportticket::$_data['step2']['insert_record'] == 1 && jssupportticket::$_data['step2']['update_record'] == 1 && jssupportticket::$_data['step2']['delete_record'] == 1 && jssupportticket::$_data['step2']['drop_table'] == 1)
                    echo "tick";
                else
                    echo "cross";
                ?>.png" /></div>
        </div>
        <div class="js-row <?php if(jssupportticket::$_data['step2']['file_downloaded'] != 1) echo 'error'; ?>" id="jsst-table-data">
            <div class="js-col-md-8"><?php echo __('FILE_DOWNLOAD', 'js-support-ticket'); ?></div>
            <div class="js-col-md-2 image"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/tick.png" /></div>
            <div class="js-col-md-2 image"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/<?php
                if (jssupportticket::$_data['step2']['file_downloaded'] == 1)
                    echo "tick";
                else
                    echo "cross";
                ?>.png" /></div>
        </div>
        <div class="js-row">
            <?php if ((jssupportticket::$_data['step2']['dir'] >= 755 ) && (jssupportticket::$_data['step2']['create_table'] == 1) && (jssupportticket::$_data['step2']['insert_record'] == 1) && (jssupportticket::$_data['step2']['update_record'] == 1 ) && (jssupportticket::$_data['step2']['delete_record'] == 1 ) && (jssupportticket::$_data['step2']['drop_table'] == 1 ) && (jssupportticket::$_data['step2']['file_downloaded'] == 1 )) { ?>
                <a class="nextbutton" href="<?php echo admin_url("admin.php?page=proinstaller&layout=step3"); ?>"><?php echo __('NEXT_STEP', 'js-support-ticket'); ?></a>
            <?php } ?>
        </div>
    </div>

</div>