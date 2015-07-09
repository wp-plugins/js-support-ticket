<?php

if (!defined('ABSPATH'))
    die('Restricted Access');

class JSSTupdates {
	
	static function checkUpdates(){
		$installedversion = JSSTupdates::getInstalledVersion();
		if($installedversion != jssupportticket::$_currentversion){
			$from = $installedversion + 1;
			$to = jssupportticket::$_currentversion;
			for($i = $from; $i <= $to; $i++){
				$installfile = jssupportticket::$_path.'includes/updates/sql/'.$i.'.sql';
				if(file_exists($installfile)){
					$delimiter = ';';
					$file = fopen($installfile, 'r');
					if (is_resource($file) === true){
						$query = array();

						while (feof($file) === false){
							$query[] = fgets($file);
							if (preg_match('~' . preg_quote($delimiter, '~') . '\s*$~iS', end($query)) === 1){
								$query = trim(implode('', $query));
									$query = str_replace("#__",jssupportticket::$_db->prefix,$query);
									if(!empty($query)){
										jssupportticket::$_db->query($query);
									}
							}
							if (is_string($query) === true){
								$query = array();
							}
						}
						fclose($file);
					}
				}
				
				
			}
		}
	}
	
	static function getInstalledVersion(){
		$query = "SELECT configvalue FROM `".jssupportticket::$_db->prefix."js_ticket_config` WHERE configname = 'versioncode'";
		$version = jssupportticket::$_db->get_var($query);		
		if(!$version)
			$version = '102';
		else
			$version = str_replace('.','',$version);			
		return $version;
	}
	
	
	

}

?>
