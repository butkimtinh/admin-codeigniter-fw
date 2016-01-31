<?php
class Mmenucategory extends CI_Model{
	protected $_table = "menucategory";
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
		
	
	public function listall($offset, $start, $search, $order_by, $asc_desc){
		$this->db->like('title', $search); 
		$this->db->limit($offset, $start);
		$this->db->order_by($order_by, $asc_desc);
		return $this->db->get($this->_table)->result_array();
	}
	
	public function count_all($search){	
		$this->db->select("count(id) AS total_rows");	
		$this->db->like('title', $search); 
		$return = $this->db->get($this->_table)->result();		
		return $return[0]->total_rows;
	}
	
	public function get_menucategory($id){
		$this->db->where("id",$id);
		return $this->db->get($this->_table)->row();
	}
	
	public function store($id,$data){
		$this->db->where("id",$id);
		($id) ? $this->db->update($this->_table,$data) : $this->db->insert($this->_table, $data);
		return $this->db->affected_rows();
	}
	
	public function delete_menucategory($id){
		$this->db->where_in('id', $id);
		$this->db->delete($this->_table);
		return $this->db->affected_rows();
	}
	
	public function published_menucategory($id){
		if($id){
			$this->db->where("id",$id);
			$this->db->update($this->_table,array('published' => 1));
			return $this->db->affected_rows();
		}
		return -1;
	}

	public function unpublished_menucategory($id){
		if($id){
			$this->db->where("id",$id);
			$this->db->update($this->_table,array('published' => 0));
			return $this->db->affected_rows();
		}
		return -1;
	}

	/*
		Function for other module call
	*/
	public function getCategoryList(){
		$this->db->select("*");
		$this->db->where("published", 1);
		$this->db->order_by('title', 'ASC');
		return $this->db->get($this->_table)->result_array();
	}
	//$this->db->affected_rows() == 0 // Update query was ran successfully but nothing was updated
	//$this->db->affected_rows() == 1 // Update query was ran successfully and 1 row was updated
	//$this->db->affected_rows() == -1 // Query failed 	
}