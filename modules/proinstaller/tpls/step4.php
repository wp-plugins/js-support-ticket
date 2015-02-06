<div id="jsst-main-wrapper" >
    <div id="jsst-upper-wrapper">
        <span class="jsst-title"><?php echo __('JS_SUPPORT_TICKET_PRO_INSTALLER','js-support-ticket'); ?></span>
        <span class="jsst-logo"><img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/jsticketpro.png" /></span>
    </div>
    <div id="jsst-middle-wrapper">
        <div class="js-col-md-4 active"><span class="jsst-number">1</span><span class="jsst-text"><?php echo __('CONFIGURATION', 'js-support-ticket'); ?></span></div>
        <div class="js-col-md-4 active"><span class="jsst-number">2</span><span class="jsst-text"><?php echo __('PERMISSIONS', 'js-support-ticket'); ?></span></div>
        <div class="js-col-md-4 active"><span class="jsst-number">3</span><span class="jsst-text"><?php echo __('INSTALLATION', 'js-support-ticket'); ?></span></div>
        <div class="js-col-md-4 active"><span class="jsst-number">4</span><span class="jsst-text"><?php echo __('FINISH', 'js-support-ticket'); ?></span></div>        
    </div>
    <div id="jsst-finish-message">
        <img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/fulltick.png" />
        <?php echo __('JS_TICKET_PRO_INSTALLED_SUCCESSFULLY!...','js-support-ticket'); ?>
    </div>
    <div id="jsst-finish-message-1"><?php echo __('THANKS_FOR_INSTALLING_JS_TICKET_PRO','js-support-ticket'); ?></div>
    <div id="jsst-finish-last-message">
        <img src="<?php echo jssupportticket::$_pluginpath; ?>includes/images/image_1.png" />
    </div>
    <div class="js-row" id="jsst-finish-button">        
        <a class="nextbutton" href="<?php echo admin_url("admin.php?page=jssupportticket"); ?>"><?php echo __('START_USING', 'js-support-ticket'); ?></a>
    </div>
    
</div>