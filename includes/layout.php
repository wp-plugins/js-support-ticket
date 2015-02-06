<?php

if (!defined('ABSPATH'))
    die('Restricted Access');

class JSSTlayout {

    static function getNoRecordFound() {
        $html = '
				<div class="js_job_error_messages_wrapper">
					<div class="js_job_messages_image_wrapper">
						<img class="js_job_messages_image" src="' . jssupportticket::$_pluginpath . 'includes/images/error/4.png"/>
					</div>
					<div class="js_job_messages_data_wrapper">
						<span class="js_job_messages_main_text">
					    	' . __('OOOOPS', 'js-support-ticket') . '
						</span>
						<span class="js_job_messages_block_text">
					    	' . __('RECORD_NOT_FOUND', 'js-support-ticket') . '
						</span>
					</div>
				</div>
		';
        echo $html;
    }

    static function getPermissionNotGranted() {
        $html = '
				<div class="js_job_error_messages_wrapper">
					<div class="js_job_messages_image_wrapper">
						<img class="js_job_messages_image" src="' . jssupportticket::$_pluginpath . 'includes/images/error/2.png"/>
					</div>
					<div class="js_job_messages_data_wrapper">
						<span class="js_job_messages_main_text">
					    	' . __('ACCESS_DENIED', 'js-support-ticket') . '
						</span>
						<span class="js_job_messages_block_text">
					    	' . __('YOU_ARE_NOT_ALLOWED_TO_VIEW_THIS_PAGE', 'js-support-ticket') . '
						</span>
					</div>
				</div>
		';
        echo $html;
    }

    static function getNotStaffMember() {
        $html = '
				<div class="js_job_error_messages_wrapper">
					<div class="js_job_messages_image_wrapper">
						<img class="js_job_messages_image" src="' . jssupportticket::$_pluginpath . 'includes/images/error/2.png"/>
					</div>
					<div class="js_job_messages_data_wrapper">
						<span class="js_job_messages_main_text">
					    	' . __('ACCESS_DENIED', 'js-support-ticket') . '
						</span>
						<span class="js_job_messages_block_text">
					    	' . __('YOU_ARE_NOT_STAFF_MEMBER', 'js-support-ticket') . '
						</span>
					</div>
				</div>
		';
        echo $html;
    }

    static function getStaffMemberDisable() {
        $html = '
				<div class="js_job_error_messages_wrapper">
					<div class="js_job_messages_image_wrapper">
						<img class="js_job_messages_image" src="' . jssupportticket::$_pluginpath . 'includes/images/error/2.png"/>
					</div>
					<div class="js_job_messages_data_wrapper">
						<span class="js_job_messages_main_text">
					    	' . __('ACCESS_DENIED', 'js-support-ticket') . '
						</span>
						<span class="js_job_messages_block_text">
					    	' . __('YOUR_ACCOUNT_IS_DISABLED_PLEASE_CONTACT_TO_ADMINISTRATOR', 'js-support-ticket') . '
						</span>
					</div>
				</div>
		';
        echo $html;
    }

    static function getSystemOffline() {
        $html = '
				<div class="js_job_error_messages_wrapper">
					<div class="js_job_messages_image_wrapper">
						<img class="js_job_messages_image" src="' . jssupportticket::$_pluginpath . 'includes/images/error/offline.png"/>
					</div>
					<div class="js_job_messages_data_wrapper">
						<span class="js_job_messages_main_text">
					    	' . __('SYSTEM_OFFLINE', 'js-support-ticket') . '
						</span>
						<span class="js_job_messages_block_text">
					    	' . jssupportticket::$_config['offline_message'] . '
						</span>
					</div>
				</div>
		';
        echo $html;
    }

    static function getUserGuest() {
        $html = '
				<div class="js_job_error_messages_wrapper">
					<div class="js_job_messages_image_wrapper">
						<img class="js_job_messages_image" src="' . jssupportticket::$_pluginpath . 'includes/images/notlogin.png"/>
					</div>
					<div class="js_job_messages_data_wrapper">
						<span class="js_job_messages_main_text">
					    	' . __('YOU_ARE_NOT_LOGIN', 'js-support-ticket') . '
						</span>
						<span class="js_job_messages_block_text">
					    	' . __('TO_ACCESS_THIS_PAGE_PLEASE_LOGIN', 'js-support-ticket') . '
						</span>
			
							<a class="button-not-login" href="' . wp_login_url() . '" title="Login">' . __('LOGIN', 'js-support-ticket') . '</a>
			
					</div>
				</div>
		';
        echo $html;
    }

}

?>
