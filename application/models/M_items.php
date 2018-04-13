<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*********************	Controller	*********************/
/* Project		: STOCK									*/
/* File name	: tbl_items								*/
/* Version		: 1.0.0									*/
/* Create Date	: 19/02/2018							*/
/* Create by	: Ruslee								*/
/* Email		: -										*/
/* Description	: -										*/
/********************************************************/

class M_items extends CI_Model {
	
	private $table		= 'tbl_items';
	private $code 		= 'item_code';
	private $code2 		= 'category_code';
	private $is_active 	= 'is_active';
	private $is_delete 	= 'is_delete';
	
    function __construct() {
        
    }
	
	function countAll() {
		$this->db->from($this->table);
		return  $this->db->count_all_results();
	}
	
	function countByActiveDelete($is_active, $is_delete) {
		$this->db->where($this->is_active, $is_active);
		$this->db->where($this->is_delete, $is_delete);
		$this->db->from($this->table);
		return  $this->db->count_all_results();
	}
	
	function countByCategryCode($code, $is_active, $is_delete) {
		$this->db->where($this->code2, $code);
		$this->db->where($this->is_active, $is_active);
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
	
	function viewByCategryCode($code, $is_delete) {
		$this->db->where($this->code2, $code);
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
  
/* End of file m_items.php */
/* Location: ./application/models/m_items.php */