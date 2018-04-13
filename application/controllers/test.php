<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {
	
	function __construct() {
        parent::__construct();
		
		$this->is_active		= 0; 
		$this->is_delete		= 0; 
		
		$this->load->model(
				array(
                'm_user'
              
				));
	}
	
	
	public function index(){
		
		$this->load->view('page/security/forgotpass');
	}
	
	public function authen(){
		$_message_title 	= 'ข้อความแจ้งเตือน !';
		
		$_user_request = $this->input->post('user_request');
		
		
		$_obj_user = $this->m_user->viewByForgotPass($user_request, $this->is_active, $this->is_delete);
		if($_obj_user['status'] == true && $_obj_user['results'] != null){
			  
			  $_user_arr = array(
					'user_code' 		=> $_obj_user['results']->user_code
					,'user_key' 		=> $_obj_user['results']->user_key
					,'user_type_code' 	=> $_obj_user['results']->user_type_code
					,'user_name' 		=> $_obj_user['results']->user_name
					,'user_img' 		=> $_obj_user['results']->user_img
				);
			  
			  $this->session->set_userdata('logged_in', $_user_arr);
			  redirect(base_url().'items/add');
	 
		}else{
			$_message = 'ไม่พบเบอร์โทรศัพท์ หรือ อีเมล์นี้ในระบบ กรุณาลองใหม่';
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
		$_provinces_arr	= array();
		
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

		$_obj_provinces =  $this->m_provinces->view($this->is_delete);
		if($_obj_provinces['status'] == true && $_obj_provinces['results'] != null){
			foreach($_obj_provinces['results'] as $provinces){
				array_push($_provinces_arr, 
						array(
						 'PROVINCE_ID'		=> $provinces->PROVINCE_ID
						,'PROVINCE_NAME'	=> $provinces->PROVINCE_NAME
						));
			}
		}
		unset($_obj_provinces);
		
		$_data['provinces'] 	= $_provinces_arr;
		
		
		$send = array(
		
		   'data'			=> $_data
	   );


		$this->load->view('page/security/register', $send);
	}
	
	
	
	public function saveadd(){
		
		$_message_title 		= 'ข้อความแจ้งเตือน !';
		$_message				= '';
		$_error					= 0;
		$_warning				= '';
		
		$_user_name 			= $this->input->post('user_name');
		$_user_addrass 			= $this->input->post('user_addrass');
		$_user_type_code 		= $this->input->post('user_type_code');
		$_user_tel 				= $this->input->post('user_tel');
		$_user_post 			= $this->input->post('user_post');
		$_user_login_name 		= $this->input->post('user_login_name');
		$_user_login_pass 		= $this->input->post('user_login_pass');
		$_user_pass_confrim 	= $this->input->post('user_pass_confrim');
		$_system_date 			= date('Y-m-d H:i:s');
		$_file_name				= '';
		$_data					= array();
		
		$this->db->trans_begin();
		
		$_user_code = strtoupper(uniqid());
		$this->load->library('upload');
		$this->upload->initialize($this->set_upload_options());
		if (!$this->upload->do_upload('user_img')){  
			$error =['error' => $this->upload->display_errors()];
		}else{
			$_file_name = $this->upload->data('file_name');
		}
		
		$_user_arr = array
			(
				 'user_code' 			=> $_user_code
				,'user_name' 			=> $_user_name
				,'user_addrass' 		=> $_user_addrass
				,'user_type_code' 		=> $_user_type_code
				,'user_tel' 			=> $_user_tel
				,'user_post' 			=> $_user_post
				,'user_img' 			=> $_file_name
				,'system_add_date' 		=> $_system_date
				,'system_update_date' 	=> $_system_date
				,'user_login_name' 		=> $_user_login_name
				,'user_login_pass' 		=> $_user_login_pass
			);
		
		if($this->m_user->countByUserCodeLogin($_user_login_name) > 0){
			$_message = 'ชื่อผู้ใช้งานซ่้ำ กรุณาลองใหม่';
			$_warning = 'warning';
		}else{
			
			if($_user_login_pass == $_user_pass_confrim){
				
				if(!$this->db->insert('tbl_user', $_user_arr)){
					$_error++;
				}
				if ($this->db->trans_status() === FALSE || $_error > 0){
					$this->db->trans_rollback();
					$_message = 'ไม่สามารถบันทึกข้อมูล กรุณาลองใหม่';
					$_warning = 'warning';
				}else{
					$_message = 'บันทึกข้อมูลเรียบร้อยแล้ว';
					$_warning = 'success';
					$this->db->trans_commit();
					unset($_user_arr);
				}
				
			}else{
				$_message = 'รหัสไม่ตรงกัน กรุณาลองใหม่';
				$_warning = 'warning';
			}
		}
		
		$this->session->set_flashdata('message', $_message);
		$this->session->set_flashdata('message_title', $_message_title);
		$this->session->set_flashdata('message_check', $_warning);
		
		$_data['data'] = @$_user_arr;
		
		$this->register($_data);
		
	}
	

}
