<?php
if(!defined('ABSPATH')) die('Restricted Access');

class departmentController{
	
	function __construct(){
		self::handleRequest();
	}
	
	function handleRequest(){
		$task = request::getVar('task',null,'department_departments');
		if(self::canaddfile()){
			$array = explode('_',$task);
			if(is_admin()){
				$action = request::getVar('action');
				$action_array = explode("_",$action);
				if($action_array[0] == 'admin'){
					departmentController::$action_array[1]();
				}else{
					$array[1] = 'admin_'.$array[1];

				}				
			}
			switch($array[1]){
				case 'admin_departments':
					includer::getJSModel('department')->getDepartments();
				break;
				
				case 'admin_adddepartment':
					$id = request::getVar('jssupportticket_departmentid','get');
					includer::getJSModel('department')->getDepartmentForForm($id);
					break;
				
			}
			includer::include_file($array[1],$array[0]);
		}
	}
	function canaddfile(){
		if(isset($_POST['form_request']) && $_POST['form_request'] == 'jssupportticket')
			return false;
		elseif(isset($_GET['action']) && $_GET['action'] == 'deleteitem')
			return false;
		else
			return true;
	}
	static function savedepartment(){		
		$data = request::get('post');
		includer::getJSModel('department')->storeDepartment($data);
		$url = admin_url("admin.php?page=department_departments&task=department_departments");
		wp_redirect($url); exit;

	}

	static function deletedepartment(){
		$id = request::getVar('departmentid');
		includer::getJSModel('department')->removeDepartment($id);
		$url = admin_url("admin.php?page=department_departments&task=department_departments");
		wp_redirect($url); exit;

	}
}

$departmentController = new departmentController();
?>
