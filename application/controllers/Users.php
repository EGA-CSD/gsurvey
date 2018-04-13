<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	
	function __construct() {
        parent::__construct();
		$this->_set_user_login();
		$this->_init();
		$this->load->model(
				array('m_user_type'
					  ,'m_user'
					 ));
	}
	
	public function _init(){
		
		$this->status_arr[0] = '<i class="fa fa-circle text-success"></i> เปิดใช้งาน';
		$this->status_arr[1] = '<i class="fa fa-circle text-danger"></i> ปิดใช้งาน';
	}
	
	public function _set_user_login(){
		if(empty($this->session->userdata('logged_in'))){
			redirect(base_url().'login');
		}
	}
	
	public function index(){
		
		$_is_active	 		= 0;
		$_is_delete 		= 0;
		$_data 				= array();
		$_user_arr 			= array();
		$_user_type_arr 	= array();
		
		$_obj_user_type =  $this->m_user_type->view($_is_active, $_is_delete);
		if($_obj_user_type['status'] == true && $_obj_user_type['results'] != null){
			foreach($_obj_user_type['results'] as $type){
				$_user_type_arr[$type->user_type_code] = $type->user_type_name;
			};
		}
		unset($_obj_user_type);
		
		$_obj_user =  $this->m_user->view($_is_active, $_is_delete);
		if($_obj_user['status'] == true && $_obj_user['results'] != null){
			foreach($_obj_user['results'] as $item){
				array_push($_user_arr,
					array(
						 'user_code' 		=> $item->user_code
						,'user_name'		=> $item->user_name
						,'user_tel'			=> $item->user_tel
						,'user_type_name'   => $_user_type_arr[$item->user_type_code]
						,'is_active'		=> $this->status_arr[$item->is_active]
					));
			}
		}
		unset($_obj_user);
		$_data['user'] 		= $_user_arr;
		$send = array(
			 'header' 		=> 'header'
			,'menu' 		=> 'menu'
			,'content' 		=> 'users/index'
			,'footer' 		=> 'footer'
			,'pagetitle' 	=> 'ข้อมูลผู้ใช้งาน'
			,'data'			=> $_data
		);
		
		$this->load->view('template/body' ,$send);
	}
	
	public function add(){
		
		$_lang 			= 'TH';
		$_is_active	 	= 0;
		$_is_delete 	= 0;
		$_data 			= array();
		$_user_type_arr = array();
		
		
		$_obj_user_type =  $this->m_user_type->view($_is_active, $_is_delete);
		if($_obj_user_type['status'] == true && $_obj_user_type['results'] != null){
			foreach($_obj_user_type['results'] as $type){
				array_push($_user_type_arr, array(
						'user_type_code' 	=> $type->user_type_code
						,'user_type_name' 	=> $type->user_type_name
					));
			};
		}
		unset($_obj_user_type);
		
		$_data['user_type'] = $_user_type_arr;
		
		$send = array(
			 'header' 		=> 'header'
			,'menu' 		=> 'menu'
			,'content' 		=> 'users/add'
			,'footer' 		=> 'footer'
			,'pagetitle' 	=> 'เพิ่มข้อมูลผู้ใช้งาน'
			,'data'			=> $_data
		);
		
		$this->load->view('template/body' ,$send);
	}
	
	public function edit(){
		
		$_code 	 		      = base64_decode($this->input->get('code'));
		$_lang 			      = 'TH';
		$_is_active	 	      = 0;
		$_is_delete 	      = 0;
		$_data 			      = array();
		$_user_type_arr 	  = array();
		
		$_obj_user_type =  $this->m_user_type->view($_is_active, $_is_delete);
		if($_obj_user_type['status'] == true && $_obj_user_type['results'] != null){
			foreach($_obj_user_type['results'] as $type){
				array_push($_user_type_arr, array(
						'user_type_code' 	=> $type->user_type_code
						,'user_type_name' 	=> $type->user_type_name
					));
			};
		}
		unset($_obj_user_type);
		
		$_obj_user = $this->m_user->viewByKey($_code);
		if($_obj_user['status'] == true && $_obj_user['results'] != null){
			$_data['user_code'] 		=  $_obj_user['results']->user_code;
			$_data['user_type_code']	=  $_obj_user['results']->user_type_code;
			$_data['user_name'] 		=  $_obj_user['results']->user_name;
			$_data['user_addrass'] 		=  $_obj_user['results']->user_addrass;
			$_data['user_post'] 		=  $_obj_user['results']->user_post;
			$_data['user_tel'] 			=  $_obj_user['results']->user_tel;
			$_data['user_login_name'] 	=  $_obj_user['results']->user_login_name;
			$_data['user_login_pass'] 	=  $_obj_user['results']->user_login_pass;
			$_data['user_img'] 			= base_url().'upload/users/'.$_obj_user['results']->user_img;
			$_data['user_img_path'] 	= $_obj_user['results']->user_img;
			
		}
		
		unset($_obj_user);
		
		$_data['user_type'] = $_user_type_arr;

		$send = array(
			 'header' 		=> 'header'
			,'menu' 		=> 'menu'
			,'content' 		=> 'users/edit'
			,'footer' 		=> 'footer'
			,'pagetitle' 	=> 'แก้ไขข้อมูลผู้ใช้งาน'
			,'data'			=> $_data
		);
		
		$this->load->view('template/body' ,$send);
	}
	
	public function profile(){
		
		$_code 	 		      = base64_decode($this->input->get('code'));
		$_lang 			      = 'TH';
		$_is_active	 	      = 0;
		$_is_delete 	      = 0;
		$_data 			      = array();
		$_lang_arr 			  = array();
		$_user_type_arr 	  = array();
		
		$_obj_user_type =  $this->m_user_type->view($_is_active, $_is_delete);
		if($_obj_user_type['status'] == true && $_obj_user_type['results'] != null){
			foreach($_obj_user_type['results'] as $type){
				array_push($_user_type_arr, array(
						'user_type_code' 	=> $type->user_type_code
						,'user_type_name' 	=> $type->user_type_name
					));
			};
		}
		unset($_obj_user_type);
		
		$_obj_user = $this->m_user->viewByKey($_code);
		if($_obj_user['status'] == true && $_obj_user['results'] != null){
			$_data['user_code'] 		=  $_obj_user['results']->user_code;
			$_data['user_type_code']	=  $_obj_user['results']->user_type_code;
			$_data['user_name'] 		=  $_obj_user['results']->user_name;
			$_data['user_post'] 		=  $_obj_user['results']->user_post;
			$_data['user_addrass'] 		=  $_obj_user['results']->user_addrass;
			$_data['user_tel'] 			=  $_obj_user['results']->user_tel;
			$_data['user_login_name'] 	=  $_obj_user['results']->user_login_name;
			$_data['user_login_pass'] 	=  $_obj_user['results']->user_login_pass;
			$_data['user_img'] 			= base_url().'upload/users/'.$_obj_user['results']->user_img;
			$_data['user_img_path'] 	= './upload/users/'.$_obj_user['results']->user_img;
			$_data['user_img_old'] 		= $_obj_user['results']->user_img;
			
		}
		
		unset($_obj_user);
		
		$_data['lang'] 		= $_lang_arr;
		$_data['user_type'] = $_user_type_arr;

		$send = array(
			 'header' 		=> 'header'
			,'menu' 		=> 'menu'
			,'content' 		=> 'users/profile'
			,'footer' 		=> 'footer'
			,'pagetitle' 	=> 'แก้ไขข้อมูลส่วนตัว'
			,'data'			=> $_data
		);
		
		$this->load->view('template/body' ,$send);
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
		$_system_date 			= date('Y-m-d H:i:s');
		$_file_name				= '';	
		
			$this->db->trans_begin();
			
			$_user_code = strtoupper(uniqid());
			$this->load->library('upload');
			$this->upload->initialize($this->set_upload_options());
			if (!$this->upload->do_upload('user_img')){  
				$error =['error' => $this->upload->display_errors()];
				$_error++;
			}else{
				$_file_name = $this->upload->data('file_name');
			}
			
			$_user_login = substr( str_shuffle( str_repeat( 'abcdefghijklmnopqrstuvwxyz0123456789', 10 ) ), 0, 7 );
			
			$_user_arr = array
				(
					 'user_code' 			=> $_user_code
					,'user_type_code' 		=> $_user_type_code
					,'user_addrass' 		=> $_user_addrass
					,'user_name' 			=> $_user_name
					,'user_tel' 			=> $_user_tel
					,'user_post' 			=> $_user_post
					,'user_img' 			=> $_file_name
					,'system_add_date' 		=> $_system_date
					,'system_update_date' 	=> $_system_date
					,'user_login_name' 		=> $_user_login
					,'user_login_pass' 		=> 'admin'
				);
					
			if($this->db->insert('tbl_user', $_user_arr)){
				
			}else{
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
		}
		
		$this->session->set_flashdata('message', $_message);
		$this->session->set_flashdata('message_title', $_message_title);
		$this->session->set_flashdata('message_check', $_warning);
		
		redirect(base_url().'users/add');
	}
	
	public function saveedit(){
		
		$_message_title 		= 'ข้อความแจ้งเตือน !';
		$_message				= '';
		$_error					= 0;
		$_warning				= '';
		$_user_code 			= $this->input->post('user_code');
		$_user_name 			= $this->input->post('user_name');
		$_user_addrass 			= $this->input->post('user_addrass');
		$_user_type_code 		= $this->input->post('user_type_code');
		$_user_tel 				= $this->input->post('user_tel');
		$_user_post 			= $this->input->post('user_post');
		$_user_img_path 		= $this->input->post('user_img_path');
		$_system_date 			= date('Y-m-d H:i:s');	
			
		$this->db->trans_begin();
		
		$this->load->library('upload');
		$this->upload->initialize($this->set_upload_options());
		if (!$this->upload->do_upload('user_img')){  
			$error =['error' => $this->upload->display_errors()];
			$_file_name = $_user_img_path;
		}else{
			$_file_name = $this->upload->data('file_name');
			
			@unlink('.upload/users/'.$_user_img_path);
		}
		$_user_arr = array
			(
				 'user_img' 			=> $_file_name
				,'user_name' 			=> $_user_name
				,'user_addrass' 		=> $_user_addrass
				,'user_tel' 			=> $_user_tel
				,'user_post' 			=> $_user_post
				,'user_type_code' 		=> $_user_type_code
				,'system_update_date' 	=> $_system_date
				
			);
			
		if(!$this->db->update('tbl_user', $_user_arr, array('user_code' => $_user_code))){
			$_error++;
		}
		
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
		
		redirect(base_url().'users/edit/?code='.base64_encode($_user_code));
	}
	
	public function saveeditprofile(){
		
		$_message_title 			= 'ข้อความแจ้งเตือน !';
		$_message					= '';
		$_error						= 0;
		$_warning					= '';
		$_user_code 				= $this->input->post('user_code');
		$_user_name 				= $this->input->post('user_name');
		$_user_addrass 				= $this->input->post('user_addrass');
		$_user_type_code 			= $this->input->post('user_type_code');
		$_user_tel 					= $this->input->post('user_tel');
		$_user_post 				= $this->input->post('user_post');
		$_user_img_path 			= $this->input->post('user_img_path');
		$_user_login_name 			= $this->input->post('user_login_name');
		$_hide_user_login_name 		= $this->input->post('hide_user_login_name');
		$_user_login_pass 			= $this->input->post('user_login_pass');
		$_user_login_pass_confirm 	= $this->input->post('user_login_pass_confirm');
		$_user_img_old 				= $this->input->post('user_img_old');
		$_system_date 				= date('Y-m-d H:i:s');	
		$_count_user				= 0;	
		$_file_name					= '';
	
		$_count_user = $this->m_user->countByUserCodeLogin($_user_login_name);

		if($_count_user > 0){
			$_user_login_new 		= $_hide_user_login_name;
			$_user_login_pass_new 	= $_user_login_pass;
			
		}else{
			$_user_login_new 		= $_user_login_name;
			$_user_login_pass_new 	= $_user_login_pass;
			
		}
		
		if($_user_login_pass == $_user_login_pass_confirm){
			
			$this->db->trans_begin();
			
			$this->load->library('upload');
			$this->upload->initialize($this->set_upload_options());
			if (!$this->upload->do_upload('user_img')){  
				$error =['error' => $this->upload->display_errors()];
			}else{
				$_file_name = $this->upload->data('file_name');
			}
				
			if(!empty($_file_name)){
				$_file_name_old = $_file_name;
				@unlink($_user_img_path);
			}else{
				$_file_name_old = $_user_img_old;
			}
			
			$_user_arr = array
				(
					 'user_img' 			=> $_file_name_old
					,'user_name' 			=> $_user_name
					,'user_addrass' 		=> $_user_addrass
					,'user_tel' 			=> $_user_tel
					,'user_post' 			=> $_user_post
					,'user_type_code' 		=> $_user_type_code
					,'system_update_date' 	=> $_system_date
					,'user_login_name' 		=> $_user_login_new
					,'user_login_pass' 		=> $_user_login_pass_new
				);
				
			if(!$this->db->update('tbl_user', $_user_arr, array('user_code' => $_user_code))){
				$_error++;
			}
			
			if ($this->db->trans_status() === FALSE || $_error > 0){
				$this->db->trans_rollback();
				$_message = 'ไม่สามารถแก้ไขข้อมูล กรุณาลองใหม่';
				$_warning = 'warning';
			}else{
				$_message = 'แก้ไขข้อมูลเรียบร้อยแล้ว';
				$_warning = 'success';
				$this->db->trans_commit();
			}
		}else{
			$_message = 'ไม่สามารถแก้ไขข้อมูลเนื่องจากรหัสผ่านไม่ตรงกัน กรุณาลองใหม่';
			$_warning = 'warning';
		}
		
		$this->session->set_flashdata('message', $_message);
		$this->session->set_flashdata('message_title', $_message_title);
		$this->session->set_flashdata('message_check', $_warning);
		
		redirect(base_url().'users/profile/?code='.base64_encode($_user_code));
	}

	public function delete(){
		
		$_message_title 		= 'ข้อความแจ้งเตือน !';
		$_message				= '';
		$_error					= 0;
		$_warning				= '';
		$_user_code 			= $this->input->post('item_code');
		$_system_date 			= date('Y-m-d H:i:s');
		
			
		if(count($_user_code) > 0){

			$this->db->trans_begin();
			foreach($_user_code as $code){
				/* delete table tbl_user*/
				$_user_arr = array(
					'is_delete' 	  		=> 1
					,'system_update_date' 	=> $_system_date
				);
					
				if(!$this->db->update('tbl_user', $_user_arr, array('user_code' => $code))){
					$_error++;
				}
			}
		}
		
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
		
		redirect(base_url().'users');
	}
	
	public function set_upload_options(){
		$config['upload_path'] = getcwd().'/upload/users/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['remove_spaces'] = true;
		$config['file_name']	 = date('YmdHis');
		return $config;
	}
	
}
