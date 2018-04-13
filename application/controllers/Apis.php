<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apis extends CI_Controller {
	
	function __construct() {
        parent::__construct();
		
		$this->_init();
		
		$this->load->model(
				array(
					 'm_department'
					,'m_organize'
					,'m_user'
					,'m_ministry'
				));
	}
	
	public function _init(){
		
		$this->is_active		= 0; 
		$this->is_delete		= 0;
		$this->output->set_content_type('application/json');
		
	}
	
	public function index(){
		$_data	=	array();
		
		$_action  		= $this->input->post('action');
		$_code	 	 	= $this->input->post('code');
		$_department	= $this->input->post('department');
		$_ministry	  	= $this->input->post('ministry');
		
		switch ($_action) {
			
			case 'department':
				$_department_arr = array();
				$_obj_department = $this->m_department->viewDepartmentCode($_code, $this->is_delete);
				if($_obj_department['status'] == true && $_obj_department['results'] != null){
					foreach( $_obj_department['results'] as $item){
						array_push($_department_arr, array(
							'ID' 				=> $item->ID
							,'DEPARTMENT_CODE' 	=> $item->DEPARTMENT_CODE
							,'DEPARTMENT_NAME' 	=> $item->DEPARTMENT_NAME
							,'MINISTRY_CODE' 	=> $item->MINISTRY_CODE
						));
					}
					
					$_data['department'] = $_department_arr;
					unset($_obj_department);
				}
			break;
			
			case 'organizedata':
				$_department_arr = array();
				$_obj_department = $this->m_department->viewDepartmentCode($_department, $this->is_delete);
				if($_obj_department['status'] == true && $_obj_department['results'] != null){
					$_data['DEPARTMENT_CODE'] = $_obj_department['results']->DEPARTMENT_CODE;
					$_data['DEPARTMENT_NAME'] = $_obj_department['results']->DEPARTMENT_NAME;
				}
				unset($_obj_department);
				
				$_obj_ministry = $this->m_ministry->viewMinistryCode($_ministry, $this->is_delete);
				if($_obj_ministry['status'] == true && $_obj_ministry['results'] != null){
					$_data['MINISTRY_CODE'] = $_obj_ministry['results']->MINISTRY_CODE;
					$_data['MINISTRY_NAME'] = $_obj_ministry['results']->MINISTRY_NAME;
				}
				unset($_obj_ministry);
				
				$this->output->set_output(json_encode($_data));
			break;
			
			case 'organize':
				$_organize_arr = array();
				$_obj_organize = $this->m_organize->viewByOrglikeName($_code, $this->is_delete);
				if($_obj_organize['status'] == true && $_obj_organize['results'] != null){
					foreach( $_obj_organize['results'] as $organize){
						array_push($_organize_arr, array(
							 'ORG_ID' 			=> $organize->ORG_ID
							,'ORG_CODE' 		=> $organize->ORG_CODE
							,'ORG_NAME' 		=> $organize->ORG_NAME
							,'MINISTRY_CODE' 	=> $organize->MINISTRY_CODE
							,'DEPARTMENT_CODE' 	=> $organize->DEPARTMENT_CODE
						));
					}
					
					// $_data['organize'] = $_organize_arr;
					unset($_obj_organize);
		
					$this->output->set_output(json_encode($_organize_arr));
		
				}
			break;

			case 'verifyuser':
				$_verifyuser_arr = array();
				$_obj_verifyuser = $this->m_user->checkVerify($_code, $this->is_delete);
				if($_obj_verifyuser['status'] == true && $_obj_verifyuser['results'] != null){

				
					foreach( $_obj_verifyuser['results'] as $verifyuser){

						
						array_push($_verifyuser_arr, array(
							 'USERNAME' 		=> $verifyuser->USERNAME
							,'PASSWORD' 	=> $verifyuser->PASSWORD
							
						));
					}
					
					$_data['verifyuser'] = $_verifyuser_arr;
					unset($_obj_verifyuser);
				}
			default:
				
		}
	}
	
}
