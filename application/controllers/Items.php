<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Items extends CI_Controller {
	
	function __construct() {
        parent::__construct();
		
		$this->_set_user_login();
		$this->_init();
		
		$this->load->model(
				array(
					'm_ministry'
				   ,'m_items'
				   ,'m_organize'
				   ,'m_department'
				   ,'m_problem'
				   ,'m_document'
				   ,'m_procedure'
				));
	}
	
	public function _init(){
		
		$this->is_active		= 0; 
		$this->is_delete		= 0;
		$_session_in 			= $this->session->userdata('logged_in');
		$this->ORG_CODE			= $_session_in['ORG_CODE'];
		$this->MASTER_ORG_CODE	= $_session_in['MASTER_ORG_CODE'];
		// var_dump($this->ORG_CODE);
		
	}
	
	public function _set_user_login(){
		if(empty($this->session->userdata('logged_in'))){
			redirect(base_url().'login');
		}
	}
	
	public function index(){
		$_data	=	array();
		
		$send = array(
			 'header' 		=> 'header'
			,'menu' 		=> 'menu'
			,'content' 		=> 'items/index'
			,'footer' 		=> 'footer'
			,'pagetitle' 	=> ''
			,'data'			=> $_data
		);
		
		$this->load->view('template/body' ,$send);
	}

	public function procedure(){

		
		$_data 			= array();
		$_problem_arr 	= array();
		$_document_arr 	= array();
		$_procedure_arr = array();
		$_procedure_name_arr = array();
		
		
		// ----- SELECT ORD BY KEY -----///
		$_obj_organize = $this->m_organize->viewByOrgKey($this->ORG_CODE, $this->is_delete); 
		if($_obj_organize['status'] == true && $_obj_organize['results'] != null){
			$_data['ORG_ID'] 			= $_obj_organize['results']->ORG_ID;
			$_data['MINISTRY_CODE'] 	= $_obj_organize['results']->MINISTRY_CODE;
			$_data['DEPARTMENT_CODE'] 	= $_obj_organize['results']->DEPARTMENT_CODE;
			$_data['ORG_CODE'] 			= $_obj_organize['results']->ORG_CODE;
			$_data['ORG_NAME'] 			= $_obj_organize['results']->ORG_NAME;
			// ----- SELECT MINISTRY BY KEY -----///
			$_obj_ministry = $this->m_ministry->viewMinistryCode($_obj_organize['results']->MINISTRY_CODE, $this->is_delete);
			if($_obj_ministry['status'] == true && $_obj_ministry['results'] != null){
				$_data['MINISTRY_ID'] 		= $_obj_ministry['results']->MINISTRY_ID;
				$_data['MINISTRY_CODE'] 	= $_obj_ministry['results']->MINISTRY_CODE;
				$_data['MINISTRY_NAME'] 	= $_obj_ministry['results']->MINISTRY_NAME;
			}
			unset($_obj_ministry);
			// ----- SELECT DEPARTMENT BY KEY -----///
			$_obj_department = $this->m_department->viewDepartmentCode($_obj_organize['results']->DEPARTMENT_CODE, $this->is_delete);
			if($_obj_department['status'] == true && $_obj_department['results'] != null){
				$_data['DEPARTMENT_CODE'] 	= $_obj_department['results']->DEPARTMENT_CODE;
				$_data['DEPARTMENT_NAME'] 	= $_obj_department['results']->DEPARTMENT_NAME;
			}
			unset($_obj_department);
		}
		
		unset($_obj_organize);
		$_obj_procedure	= $this->m_procedure->viewByOrgCode($_data['MINISTRY_CODE'], $this->ORG_CODE, $this->is_delete);

		if($_obj_procedure['status'] == true && $_obj_procedure['results'] != null){
			foreach($_obj_procedure['results'] as $procedure){
				array_push($_procedure_arr, array(
					 'PRO_ID'		=> $procedure->PRO_ID
					,'PRO_CODE'		=> $procedure->PRO_CODE
					
				));
			}
		}
		unset($_obj_procedure);

		$_obj_name_procedure	= $this->m_procedure->viewNameProcedure($_procedure_arr);
		
		if($_obj_name_procedure['status'] == true && $_obj_name_procedure['results'] != null){
			foreach($_obj_name_procedure['results'] as $procedure_name){
				array_push($_procedure_name_arr, array(
					 'PRO_CODE'		=> $procedure_name->PRO_CODE
					,'PRO_NAME'		=> $procedure_name->PRO_NAME
					
				));
			}
		}
		unset($_obj_name_procedure);

		
		$_data['procedure'] = $_procedure_arr;
		$_data['procedure_name'] = $_procedure_name_arr;
		
		$send = array(
			 'header' 		=> 'header'
			,'menu' 		=> 'menu'
			,'content' 		=> 'items/procedure'
			,'footer' 		=> 'footer'
			,'pagetitle' 	=> 'ยืนยันความถูกต้องของกระบวนงาน'
			,'data'			=> $_data
		);
		
		$this->load->view('template/body' ,$send);
	}
	
	public function add(){
		
		$_data 			= array();
		$_problem_arr 	= array();
		$_document_arr 	= array();
		$_procedure_arr = array();
		$_procedure_name_arr = array();
		
		// ----- SELECT ORD BY KEY -----///
		$_obj_organize = $this->m_organize->viewByOrgKey($this->ORG_CODE, $this->is_delete);
		
		if($_obj_organize['status'] == true && $_obj_organize['results'] != null){
			$_data['ORG_ID'] 			= $_obj_organize['results']->ORG_ID;
			$_data['MINISTRY_CODE'] 	= $_obj_organize['results']->MINISTRY_CODE;
			$_data['DEPARTMENT_CODE'] 	= $_obj_organize['results']->DEPARTMENT_CODE;
			$_data['ORG_CODE'] 			= $_obj_organize['results']->ORG_CODE;
			$_data['ORG_NAME'] 			= $_obj_organize['results']->ORG_NAME;
			// ----- SELECT MINISTRY BY KEY -----///
			$_obj_ministry = $this->m_ministry->viewMinistryCode($_obj_organize['results']->MINISTRY_CODE, $this->is_delete);
			if($_obj_ministry['status'] == true && $_obj_ministry['results'] != null){
				$_data['MINISTRY_ID'] 		= $_obj_ministry['results']->MINISTRY_ID;
				$_data['MINISTRY_CODE'] 	= $_obj_ministry['results']->MINISTRY_CODE;
				$_data['MINISTRY_NAME'] 	= $_obj_ministry['results']->MINISTRY_NAME;
			}
			unset($_obj_ministry);
			// ----- SELECT DEPARTMENT BY KEY -----///
			$_obj_department = $this->m_department->viewDepartmentCode($_obj_organize['results']->DEPARTMENT_CODE, $this->is_delete);
			if($_obj_department['status'] == true && $_obj_department['results'] != null){
				$_data['DEPARTMENT_CODE'] 	= $_obj_department['results']->DEPARTMENT_CODE;
				$_data['DEPARTMENT_NAME'] 	= $_obj_department['results']->DEPARTMENT_NAME;
			}
			unset($_obj_department);
		}
		
		unset($_obj_organize);
		
		$_obj_procedure	= $this->m_procedure->viewByOrgActvieCode($_data['MINISTRY_CODE'], $this->ORG_CODE, $this->is_delete, $this->is_active);

		if($_obj_procedure['status'] == true && $_obj_procedure['results'] != null){
			foreach($_obj_procedure['results'] as $procedure){
				array_push($_procedure_arr, array(
					 'PRO_ID'		=> $procedure->PRO_ID
					,'PRO_CODE'		=> $procedure->PRO_CODE
					
				));
			}
		}
		unset($_obj_procedure);

		$_obj_name_procedure	= $this->m_procedure->viewNameProcedure($_procedure_arr);
		
		if($_obj_name_procedure['status'] == true && $_obj_name_procedure['results'] != null){
			foreach($_obj_name_procedure['results'] as $procedure_name){
				array_push($_procedure_name_arr, array(
					 'PRO_CODE'		=> $procedure_name->PRO_CODE
					,'PRO_NAME'		=> $procedure_name->PRO_NAME
					
				));
			}
		}
		unset($_obj_name_procedure);

		
		$_data['procedure'] 		= $_procedure_arr;
		$_data['procedure_name'] 	= $_procedure_name_arr;
		
		$_obj_problem	= $this->m_problem->view($this->is_delete);
		if($_obj_problem['status'] == true && $_obj_problem['results'] != null){
			foreach($_obj_problem['results'] as $problem){
				array_push($_problem_arr, array(
					 'PROB_ID'		=> $problem->PROB_ID
					,'PROB_NAME'	=> $problem->PROB_NAME
				));
			}
		}
		unset($_obj_problem);
		
		$_obj_document	= $this->m_document->view($this->is_delete);
		if($_obj_document['status'] == true && $_obj_document['results'] != null){
			foreach($_obj_document['results'] as $document){
				array_push($_document_arr, array(
					 'DOC_ID'		=> $document->DOC_ID
					,'DOC_NAME'		=> $document->DOC_NAME
				));
			}
		}
		unset($_obj_document);
		
		$_data['procedure'] = $_procedure_arr;
		$_data['document'] 	= $_document_arr;
		$_data['problem'] 	= $_problem_arr;
		
		$send = array(
			 'header' 		=> 'header'
			,'menu' 		=> 'menu'
			,'content' 		=> 'items/add'
			,'footer' 		=> 'footer'
			,'pagetitle' 	=> 'แบบสำรวจหน่วยงานภาครัฐ'
			,'data'			=> $_data
		);
		
		$this->load->view('template/body' ,$send);
	}

	public function department(){

		$_is_active	 	= 0;
		$_is_delete 	= 0;
		$_data 			= array();
		$_category_arr 	= array();
		$level = $this->input->post('level');
		$code = $this->input->post('code');
		
		$_obj_category =  $this->m_category->viewHierarchy($this->is_delete,$level,$code);
	
		if($_obj_category['status'] == true && $_obj_category['results'] != null){
			foreach($_obj_category['results'] as $category){
				array_push($_category_arr, 
				array(
						 'category_code'	=> $category->DEPARTMENT_ID
						,'category_name'	=> $category->DEPARTMENT_NAME
						));
			}
		}
		
		echo json_encode($_category_arr) ; 
	

	}

	public function edit(){
		
		$_code 	 		= base64_decode($this->input->get('code'));
		$_data 			= array();
		
		$send = array(
			 'header' 		=> 'header'
			,'menu' 		=> 'menu'
			,'content' 		=> 'items/edit'
			,'footer' 		=> 'footer'
			,'pagetitle' 	=> ''
			,'data'			=> $_data
		);
		
		$this->load->view('template/body' ,$send);
	}
	
	public function saveadd(){
		
		$_message_title 	= 'ข้อความแจ้งเตือน !';
		$_message			= '';
		$_error				= 0;
		$_warning			= '';
		
		if ($this->db->trans_status() === FALSE || $_error > 0){
			$this->db->trans_rollback();
			$_message = 'ไม่สามารถบันทึกข้อมูล กรุณาลองใหม่';
			$_warning = 'warning';
		}else{
			$_message = 'บันทึกข้อมูลเรียบร้อยแล้ว';
			$_warning = 'success';
			$this->db->trans_commit();
		}
		
		$this->session->set_flashdata('message', $_message);
		$this->session->set_flashdata('message_title', $_message_title);
		$this->session->set_flashdata('message_check', $_warning);
		
		redirect(base_url().'items/add');
	}
	
	public function saveedit(){
		
		$_message_title 		= 'ข้อความแจ้งเตือน !';
		$_message				= '';
		$_error					= 0;
		$_warning				= '';
		
		if ($this->db->trans_status() === FALSE || $_error > 0){
			$this->db->trans_rollback();
			$_message = 'ไม่สามารถแก้ไขข้อมูล กรุณาลองใหม่';
			$_warning = 'warning';
		}else{
			$_message = 'แก้ไขข้อมูลเรียบร้อยแล้ว';
			$_warning = 'success';
			$this->db->trans_commit();
		}
		
		$this->session->set_flashdata('message', $_message);
		$this->session->set_flashdata('message_title', $_message_title);
		$this->session->set_flashdata('message_check', $_warning);
		
		redirect(base_url().'items/edit/?code='.base64_encode($_item_code));
	}
		
	public function delete(){
		
		$_message_title 		= 'ข้อความแจ้งเตือน !';
		$_message				= '';
		$_error					= 0;
		$_warning				= '';
		
		if ($this->db->trans_status() === FALSE || $_error > 0){
			$this->db->trans_rollback();
			$_message = 'ไม่สามารถลบข้อมูล กรุณาลองใหม่';
			$_warning = 'warning';
		}else{
			$_message = 'ลบข้อมูลเรียบร้อยแล้ว';
			$_warning = 'success';
			$this->db->trans_commit();
		}
		
		$this->session->set_flashdata('message', $_message);
		$this->session->set_flashdata('message_title', $_message_title);
		$this->session->set_flashdata('message_check', $_warning);
		
		redirect(base_url().'items');
	}
	
}
