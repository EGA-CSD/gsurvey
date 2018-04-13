<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*********************	Controller	*********************/
/* Project		: 								*/
/* File name	: m_category						*/
/* Version		: 1.0.0									*/
/* Create Date	: 19/02/2018							*/
/* Create by	: Ruslee								*/
/* Email		: -										*/
/* Description	: -										*/
/********************************************************/

class M_category extends CI_Model {
	
	private $table				= 'tbl_category';
	private $table_ministry		= 'ministry';
	private $table_department	= 'department';
	private $table_organize		= 'organize';
	private $code 				= 'category_code';
	private $is_active 			= 'is_active';
	private $is_delete 			= 'is_delete';


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
	
    function view($is_delete) {
		$this->db->where($this->is_delete, $is_delete);
		$query = $this->db->get($this->table_ministry);
		
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

    function viewHierarchy( $is_delete,$level,$code) {
		
		$this->db->where($this->is_delete, $is_delete);
		if($level == "department"){
			$this->db->where("MINISTRY_CODE", $code);
			$query = $this->db->get($this->table_department);
		}
		if($level == "organize"){
			$query = $this->db->get($this->table_organize);
		}
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
  
/* End of file m_category.php */
/* Location: ./application/models/m_category.php */