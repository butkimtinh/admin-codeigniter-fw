<?php
class Musergroup extends CI_Model{
	protected $_table = "usergroup";
	public function __construct(){
		parent::__construct();
        $this->load->database('default', TRUE);
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
	
	public function get_usergroup($id){
		$this->db->where("id",$id);
		return $this->db->get($this->_table)->row();
	}
	
	public function store($id,$data){
		$this->db->where("id",$id);
		($id) ? $this->db->update($this->_table,$data) : $this->db->insert($this->_table, $data);
		return $this->db->affected_rows();
	}
	
	public function delete_usergroup($id){
		$this->db->where_in('id', $id);
		$this->db->delete($this->_table);
		return $this->db->affected_rows();
	}
	
	public function published_usergroup($id){
		if($id){
			$this->db->where("id",$id);
			$this->db->update($this->_table,array('published' => 1));
			return $this->db->affected_rows();
		}
		return -1;
	}

	public function unpublished_usergroup($id){
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
	public function getGroupList(){
        $this->load->database('default', TRUE);
		$this->db->select("*");
		$this->db->where("published", 1);
		$this->db->order_by('ordered', 'ASC');
		return $this->db->get($this->_table)->result_array();
	}

    public function getUserGroupRole($userGroupID){
        $this->load->database('default', TRUE);
        $this->db->select("canview");
        $this->db->select("canedit");
        $this->db->where("id", $userGroupID);
        return $this->db->get($this->_table)->row_array();
    }
	//$this->db->affected_rows() == 0 // Update query was ran successfully but nothing was updated
	//$this->db->affected_rows() == 1 // Update query was ran successfully and 1 row was updated
	//$this->db->affected_rows() == -1 // Query failed 	
}