<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	function __construct() {
        parent::__construct();
		
		$this->is_active		= 0; 
		$this->is_delete		= 0; 
		
		$this->load->model(
				array(
                'm_user',
                'm_ministry',
				'm_organize'
				));
	}
	
	
	public function index(){
		
		$this->load->view('page/security/login');
	}
	
	public function authen(){
		$_message_title 	= 'ข้อความแจ้งเตือน !';
		
		$_user_name = $this->input->post('user_name');
		$_user_pass = $this->input->post('user_pass');
		
		$_obj_user = $this->m_user->viewByUserAuthen($_user_name, $_user_pass, $this->is_active, $this->is_delete);
		if($_obj_user['status'] == true && $_obj_user['results'] != null){
			  
			  $_user_arr = array(
					'UID' 				=> $_obj_user['results']->UID
					,'USERNAME' 		=> $_obj_user['results']->USERNAME
					,'user_type_code' 	=> $_obj_user['results']->user_type_code
					,'ORG_CODE' 		=> $_obj_user['results']->ORG_CODE
					,'MASTER_ORG_CODE' 	=> $_obj_user['results']->MASTER_ORG_CODE
				);
			  
			  $this->session->set_userdata('logged_in', $_user_arr);
			  redirect(base_url().'items/procedure');
	 
		}else{
			$_message = 'ชื่อผู้ใช้งาน และรหัสผ่านไม่ถูกต้อง กรุณาลองใหม่';
			$_warning = 'warning';
			
			$this->session->set_flashdata('message', $_message);
			$this->session->set_flashdata('message_title', $_message_title);
			$this->session->set_flashdata('message_check', $_warning);
			
			redirect(base_url().'login');
		}
	}
	
	public function register($data = ''){
		
		$_is_active	 	= 0;
		$_is_delete 	= 0;
		$_data 			= array();
		$_ministry_arr 	= array();
		$_organize_arr	= array();
		
		$_obj_ministry =  $this->m_ministry->view($this->is_delete);
		if($_obj_ministry['status'] == true && $_obj_ministry['results'] != null){
			foreach($_obj_ministry['results'] as $item){
				array_push($_ministry_arr, 
						array(
						 'MINISTRY_CODE'	=> $item->MINISTRY_CODE
						,'MINISTRY_NAME'	=> $item->MINISTRY_NAME
						));
			}
		}
		unset($_obj_ministry);
		
		$_data['ministry'] 	= $_ministry_arr;

		$_organize_arr = array();
		$_obj_organize = $this->m_organize->view($this->is_delete);
		if($_obj_organize['status'] == true && $_obj_organize['results'] != null){
			foreach( $_obj_organize['results'] as $organize){
				array_push($_organize_arr, array(
					 'ORG_ID' 		=> $organize->ORG_ID
					,'ORG_CODE' 	=> $organize->ORG_CODE
					,'ORG_NAME' 	=> $organize->ORG_NAME
				));
			}
			
			$_data['organize'] = $_organize_arr;
			unset($_obj_organize);
		}
		
		
		$send = array(
		
		   'data'			=> $_data
	    );


		$this->load->view('page/security/register', $send);
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url().'login', 'refresh');
	}
	
	public function saveadd(){
		
		$_message_title 		= 'ข้อความแจ้งเตือน !';
		$_message				= '';
		$_error					= 0;
		$_warning				= '';
		
		$_ORG_CODE 				= $this->input->post('ORG_CODE');
		$_NAME 					= $this->input->post('NAME');
		$_LASNAME 				= $this->input->post('LASNAME');
		$_EMAIL 				= $this->input->post('EMAIL');
		$_TEL 					= $this->input->post('TEL');
		
		$_data					= array();
		
		$_obj_organize = $this->m_user->viewByOrgKey($_ORG_CODE);
		if($_obj_organize['status'] == true && $_obj_organize['results'] != null){
			
			$_data['USERNAME'] 	= $_obj_organize['results']->USERNAME;
			$_data['PASSWORD'] 	= $_obj_organize['results']->PASSWORD;
			$_data['EMAIL'] 	= $_EMAIL;
			
			$this->db->trans_begin();
			
			$_user_arr = array(
				 'NAME' 		=> $_NAME
				,'SURNAME' 		=> $_LASNAME
				,'EMAIL' 		=> $_EMAIL
				,'TEL' 			=> $_TEL
				,'is_active' 	=> 1
			);
			
			$_user_regis_arr = array(
				'NAME' 			=> $_NAME
			   ,'SURNAME' 		=> $_LASNAME
			   ,'EMAIL' 		=> $_EMAIL
			   ,'TEL' 			=> $_TEL
			   ,'ORG_CODE'		=> $_ORG_CODE
		   );

			
			
			if(!$this->db->update('user', $_user_arr, array('ORG_CODE'=> $_ORG_CODE))){
				$_error++;
			}
			
		   if(!$this->db->insert('user_regis_log', $_user_regis_arr)){
				$_error++;
			}
			if ($this->db->trans_status() === FALSE || $_error > 0){
				$this->db->trans_rollback();
				$_message = 'ไม่สามารถลงทะเเบียนได้ กรุณาลองใหม่';
				$_warning = 'warning';
			}else{
				$_message = 'คุณทำการได้ลงทะเบียนเรียบร้อยแล้ว';
				$_warning = 'success';
				$this->db->trans_commit();
				
				$config = Array(
					'protocol' 		=> 'smtp'
					,'smtp_host' 	=> 'mail.iamsrop.com'
					,'smtp_port' 	=> 587
					,'smtp_user' 	=> 'iamsropc' // change it to yours
					,'smtp_pass' 	=> 't0Ftbc9U52' // change it to yours
					,'mailtype' 	=> 'html'
					,'charset' 		=> 'utf-8'
					,'wordwrap' 	=> TRUE
				);
				
				$userEmail = $_EMAIL;
				$subject = "Registation Form";

				$this->load->library('email', $config);
				$this->email->to($userEmail); // replace it with receiver mail id
				$this->email->subject($subject); // replace it with relevant subject
				$this->email->from('contact@ega.or.th'); // change it to yours
				
				$data = array(
					 'userName'	=> $_obj_organize['results']->USERNAME
					,'Password'	=> $_obj_organize['results']->PASSWORD
				);
				
				$body = $this->load->view('email/template_email',$data,TRUE);
				$this->email->message($body); 
				
				if($this->email->send()){
					
					$send = array(
						'data'		=> $_data
					   ,'message'	=> $_message
					);
					
					$this->load->view('page/security/organize', $send);
					
				}else{
					 show_error($this->email->print_debugger());
				}
			}
			
			unset($_obj_organize);
		}else{
			
			$_message = 'ไม่สามารถลงทะเเบียนได้ กรุณาลองใหม่';
			$_warning = 'warning';
			$this->session->set_flashdata('message', $_message);
			$this->session->set_flashdata('message_title', $_message_title);
			$this->session->set_flashdata('message_check', $_warning);
			$this->register();
		}
	}
}
