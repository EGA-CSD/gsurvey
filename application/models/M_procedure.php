<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*********************	Controller	*********************/
/* Project		: EGA									*/
/* File name	: m_procedure								*/
/* Version		: 1.0.0									*/
/* Create Date	: 04/04/2018							*/
/* Create by	: Ruslee								*/
/* Email		: -										*/
/* Description	: -										*/
/********************************************************/

class M_procedure extends CI_Model {
	
	private $table				= 'procedure';
	private $table1				= 'transaction_procedure_01';
	private $table2				= 'transaction_procedure_02';
	private $table3				= 'transaction_procedure_03';
	private $code 				= 'PRO_ID';
	private $code2 				= 'PRO_CODE';
	private $code3 				= 'ORG_CODE';
	private $code_min 			= 'MINISTRY_CODE';
	private $is_delete 			= 'is_delete';
	private $is_actvie 			= 'is_active';


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
	
	function viewByOrgCode($code_min,$code, $is_delete) {

		$this->db->where($this->is_delete, $is_delete);
		$this->db->where($this->code3, $code);
		$this->db->where($this->code_min, $code_min);
		if($code_min <= 14){
			$query = $this->db->get($this->table1);
		}
		else if($code_min == 19){
			$query = $this->db->get($this->table2);
		}
		else{
			$query = $this->db->get($this->table2);
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
	
	function viewByOrgActvieCode($code_min,$code, $is_delete, $is_active) {

		$this->db->where($this->is_active, $is_active);
		$this->db->where($this->is_delete, $is_delete);
		$this->db->where($this->code3, $code);
		$this->db->where($this->code_min, $code_min);
		if($code_min <= 14){
			$query = $this->db->get($this->table1);
		}
		else if($code_min == 19){
			$query = $this->db->get($this->table2);
		}
		else{
			$query = $this->db->get($this->table2);
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

    function viewNameProcedure($_procedure_code_arr) {

		$data = array();
		foreach($_procedure_code_arr as $pro){
			$data[] = $pro['PRO_CODE'];
		}

		
		
		 $this->db->where_in($this->code2, $data);
		 $query = $this->db->get($this->table);
		
		$this->db->last_query();
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
  
/* End of file m_procedure.php */
/* Location: ./application/models/m_procedure.php */