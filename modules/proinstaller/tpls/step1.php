<div id="jsst-main-wrapper" >
    <div id="jsst-upper-wrapper">
        <span class="jsst-title"><?php echo __('JS_SUPPORT_TICKET_PRO_INSTALLER', 'js-support-ticket'); ?></span>
        <span class="jsst-logo"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/jsticketpro.png" /></span>
    </div>
    <div id="jsst-middle-wrapper">
        <div class="js-col-md-4 active"><span class="jsst-number">1</span><span class="jsst-text"><?php echo __('CONFIGURATION', 'js-support-ticket'); ?></span></div>
        <div class="js-col-md-4"><span class="jsst-number">2</span><span class="jsst-text"><?php echo __('PERMISSIONS', 'js-support-ticket'); ?></span></div>
        <div class="js-col-md-4"><span class="jsst-number">3</span><span class="jsst-text"><?php echo __('INSTALLATION', 'js-support-ticket'); ?></span></div>
        <div class="js-col-md-4"><span class="jsst-number">4</span><span class="jsst-text"><?php echo __('FINISH', 'js-support-ticket'); ?></span></div>        
    </div>
    <div id="jsst-lower-wrapper">
        <span class="jsst-main-title"><?php echo __('QUICK_CONFIGURATION', 'js-support-ticket'); ?></span>
        <?php if ((jssupportticket::$_data['phpversion'] < 5) || (jssupportticket::$_data['curlexist'] != 1) || (jssupportticket::$_data['gdlib'] != 1) || (jssupportticket::$_data['ziplib'] != 1)) { ?>
            <div class="js-row jsst-main-error" id="jsst-table-data">
                <img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/error_icon.png" />
                <div class="js-row">
                    <span class="jsst-main-error"><?php echo __('ERROR_OCCURED', 'js-support-ticket'); ?></span>
                        <?php if (jssupportticket::$_data['phpversion'] < 5) { ?>
                            <span class="jsst-error-line"><?php echo __('PHP_VERSION_SMALLER_THEN_RECOMENDED', 'js-support-ticket'); ?></span>
                        <?php } ?>
                        <?php if (jssupportticket::$_data['curlexist'] != 1) { ?>
                            <span class="jsst-error-line"><?php echo __('CURL_NOT_EXIST', 'js-support-ticket'); ?></span>
                        <?php } ?>
                        <?php if (jssupportticket::$_data['gdlib'] != 1) { ?>
                            <span class="jsst-error-line"><?php echo __('GD_LIBRARY_NOT_EXIST', 'js-support-ticket'); ?></span>
                        <?php } ?>
                        <?php if (jssupportticket::$_data['ziplib'] != 1) { ?>
                            <span class="jsst-error-line"><?php echo __('ZIP_LIBRARY_NOT_EXIST', 'js-support-ticket'); ?></span>
                        <?php } ?>
                    </div>
            </div>
        <?php } ?>
        <div class="js-row" id="jsst-table-head">
            <div class="js-col-md-8"><?php echo __('SETTING', 'js-support-ticket'); ?></div>
            <div class="js-col-md-2"><?php echo __('RECOMENDED', 'js-support-ticket'); ?></div>
            <div class="js-col-md-2"><?php echo __('CURRENT', 'js-support-ticket'); ?></div>
        </div>
        <div class="js-row <?php if(jssupportticket::$_data['phpversion'] < 5) echo 'error'; ?>" id="jsst-table-data">
            <div class="js-col-md-8"><?php echo __('PHP', 'js-support-ticket'); ?></div>
            <div class="js-col-md-2"><?php echo __('5.0', 'js-support-ticket'); ?></div>
            <div class="js-col-md-2 <?php
            if (jssupportticket::$_data['phpversion'] < 5)
                echo "red";
            else
                echo "green";
            ?>"><?php echo jssupportticket::$_data['phpversion']; ?></div>
        </div>
        <div class="js-row <?php if(jssupportticket::$_data['curlexist'] != 1) echo 'error'; ?>" id="jsst-table-data">
            <div class="js-col-md-8"><?php echo __('CURL_EXIST', 'js-support-ticket'); ?></div>
            <div class="js-col-md-2 image"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/tick.png" /></div>
            <div class="js-col-md-2 image"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/<?php
                if (jssupportticket::$_data['curlexist'])
                    echo "tick";
                else
                    echo "cross";
                ?>.png" /></div>
        </div>
        <div class="js-row" id="jsst-table-data">
            <div class="js-col-md-8"><?php echo __('CURL_VERSION', 'js-support-ticket'); ?></div>
            <div class="js-col-md-2"><?php echo jssupportticket::$_data['curlversion']; ?></div>
            <div class="js-col-md-2"><?php echo jssupportticket::$_data['curlversion']; ?></div>
        </div>
        <div class="js-row <?php if(jssupportticket::$_data['gdlib'] != 1) echo 'error'; ?>" id="jsst-table-data">
            <div class="js-col-md-8"><?php echo __('GD_LIBRARY', 'js-support-ticket'); ?></div>
            <div class="js-col-md-2 image"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/tick.png" /></div>
            <div class="js-col-md-2 image"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/<?php
                if (jssupportticket::$_data['gdlib'])
                    echo "tick";
                else
                    echo "cross";
                ?>.png" /></div>
        </div>
        <div class="js-row <?php if(jssupportticket::$_data['ziplib'] != 1) echo 'error'; ?>" id="jsst-table-data">
            <div class="js-col-md-8"><?php echo __('ZIP_LIBRARY', 'js-support-ticket'); ?></div>
            <div class="js-col-md-2 image"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/tick.png" /></div>
            <div class="js-col-md-2 image"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/<?php
                if (jssupportticket::$_data['ziplib'])
                    echo "tick";
                else
                    echo "cross";
                ?>.png" /></div>
        </div>
        <div class="js-row">
            <?php if ((jssupportticket::$_data['phpversion'] > 5) && (jssupportticket::$_data['curlexist'] == 1) && (jssupportticket::$_data['gdlib'] == 1) && (jssupportticket::$_data['ziplib'] == 1)) { ?>
                <a class="nextbutton" href="<?php echo admin_url("admin.php?page=proinstaller&layout=step2"); ?>"><?php echo __('NEXT_STEP', 'js-support-ticket'); ?></a>
            <?php } ?>
        </div>
    </div>

</div>