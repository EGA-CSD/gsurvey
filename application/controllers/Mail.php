<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
   class Mail extends CI_Controller { 
 
    function __construct() {
        parent::__construct();
		
		$this->_init();
		
		$this->load->model(
				array(
					 'm_department'
					,'m_organize'
					,'m_user'
				));
    }
    
    public function _init(){
		
	
	//	$this->output->set_content_type('application/json');
    }	
		
      public function index() { 
		 $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.iamsrop.com',
            'smtp_port' => 587,
            'smtp_user' => 'iamsropc', // change it to yours
            'smtp_pass' => 't0Ftbc9U52', // change it to yours
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'wordwrap' => TRUE
          );

			$userEmail = "chanika.santiwattanathum@ega.or.th";
		    
			$subject = "Registation Form";


		    $this->load->library('email', $config);

		    $this->email->to($userEmail); // replace it with receiver mail id

		  	$this->email->subject($subject); // replace it with relevant subject


		   $this->email->from('contact@ega.or.th'); // change it to yours

		    $data = array(

				       'userName'=> '1102224899',
				       'Password'=> 'xxxxx'

			);


			$body = $this->load->view('page/items/template_email',$data,TRUE);

		  

		  	$this->email->message($body); 

		    if($this->email->send()){
           		 echo 'Email sent.0000';
	        }
	        else{
	       		 show_error($this->email->print_debugger());
	        }


       

      } 
  
      


      
  
    
}