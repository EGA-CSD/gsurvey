<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*********************	Controller	*********************/
/* Project		: EGA									*/
/* File name	: m_document								*/
/* Version		: 1.0.0									*/
/* Create Date	: 04/04/2018							*/
/* Create by	: Ruslee								*/
/* Email		: -										*/
/* Description	: -										*/
/********************************************************/

class M_document extends CI_Model {
	
	private $table				= 'document';
	private $code 				= 'DOC_ID';
	private $is_delete 			= 'is_delete';


    function __construct() {
        
    }
	
	function countAll() {
		$this->db->from($this->table);
		return  $this->db->count_all_results();
	}
	
	function countByActiveDelete($is_delete) {
		$this->db->where($this->is_delete, $is_delete);
		$this->db->from($this->table);
		return  $this->db->count_all_results();
	}
	
    function view($is_delete) {
		$this->db->where($this->is_delete, $is_delete);
		$query = $this->db->get($this->table);
		
		$return_array = array();
		if ($query) {
			$return_array['status'] = true;
			$return_array['results'] = $query->result();

			if($query->num_rows() > 0) {
				$return_array['message'] = "";
			} else {
				$return_array['message'] = "No data found.";
			}
		} else {
			trigger_error($this->db->_error_message(), E_USER_ERROR);			
			$return_array['status'] = false;
			$return_array['results'] = null;
			$return_array['message'] = $this->db->_error_message();
		}

		return $return_array;
    }

	function viewByKey($code) {
		$this->db->where($this->code, $code);
		//get query and processing
		$query = $this->db->get($this->table);

		$return_array = array();
		if ($query) {
			$results = $query->result();
			$return_array['status'] = true;

			if($query->num_rows() > 0) {
				$return_array['results'] = $results[0];
				$return_array['message'] = "";
			} else {
				$return_array['results'] = null;
				$return_array['message'] = "No data found.";
			}
		} else {
			trigger_error($this->db->_error_message(), E_USER_ERROR);			
			$return_array['status'] = false;
			$return_array['results'] = null;
			$return_array['message'] = $this->db->_error_message();
		}

		return $return_array;
    }

}
  
/* End of file m_document.php */
/* Location: ./application/models/m_document.php */