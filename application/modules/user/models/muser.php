<?php
class Muser extends CI_Model{
	protected $_table = "user";
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
		
	public function check_login($user,$pass){
		$this->db->where("username",$user);
		$this->db->where("password",$pass);
		$query = $this->db->get($this->_table);		
		if($query->num_rows == 0){
			return FALSE;
		}else{
			return $query->row();
		}	
	}
	
	public function listall($offset, $start, $search, $order_by, $asc_desc, $groupID, $published = -1){
		$this->db->select('user.*');
		$this->db->select('usergroup.title AS usergroup_title'); 
		$this->db->from('user'); 
		$this->db->join('usergroup', 'user.usergroup_id = usergroup.id'); 
		if($groupID > 0)
			$this->db->where('usergroup_id', $groupID);
        if($published != -1)
            $this->db->where('user.published', $published);
        $this->db->like('username', $search);
		$this->db->limit($offset,$start);
		$this->db->order_by($order_by, $asc_desc);
		$rs = $this->db->get()->result_array();
        return $rs;
	}
	
	public function count_all($search, $groupID, $published = -1){
		$this->db->select("count(id) AS total_rows");
		if($groupID > 0)
			$this->db->where('usergroup_id', $groupID);
        if($published != -1)
            $this->db->where('user.published', $published);
		$this->db->like('username', $search); 
		$return = $this->db->get($this->_table)->result();		
		return $return[0]->total_rows;
	}
	
	public function get_user($id){
		$this->db->where("id",$id);
		return $this->db->get($this->_table)->row();
	}
	
	public function store($id,$data){
		$this->db->where("id",$id);
		($id) ? $this->db->update($this->_table,$data) : $this->db->insert($this->_table, $data);
		return $this->db->affected_rows();
	}
	
	public function delete_user($id){
		$this->db->where_in('id', $id);
		$this->db->delete($this->_table);
		return $this->db->affected_rows();
	}
	
	public function published_user($id){
		if($id){
			$this->db->where("id",$id);
			$this->db->update($this->_table,array('published' => 1));
			return $this->db->affected_rows();
		}
		return -1;
	}

	public function unpublished_user($id){
		if($id){
			$this->db->where("id",$id);
			$this->db->update($this->_table,array('published' => 0));
			return $this->db->affected_rows();
		}
		return -1;
	}
	
	public function sltUserGroup($userGroupID){
		$this->load->model('usergroup/musergroup','UserGroup_model');
		$groupList = $this->UserGroup_model->getGroupList();
		if($groupList)
			return frmSelectBox("user_group_id",$groupList, $userGroupID);
	}

    public function sltUser($sltName, $userID){
        $userList = $this->all_user();
        return frmSelectBoxWithSearch($sltName, $userList, $userID, 'id', 'name');
    }
	
	public function check_mail($mail){
		$this->db->where("email",$mail);
		$query = $this->db->get($this->_table);		
		if($query->num_rows == 0){
			return FALSE;
		}else{
			return $query->row();
		}
	}
	
	public function all_user(){
		$this->db->select('*');
        $this->db->where('published', 1);
		return $this->db->get($this->_table)->result_array();
	}
	
	public function check_get_pass($get_pass){
		$this->db->where("password",$get_pass);
		$query = $this->db->get($this->_table);		
		if($query->num_rows == 0){
			return FALSE;
		}else{
			return $query->row();
		}
	}
	
	public function get_user_email($email){
		$this->db->where("email",$email);
		return $this->db->get($this->_table)->row();
	}
	
	public function get_user_pass($pass){
		$this->db->where("password",$pass);
		$query = $this->db->get($this->_table);
		if($query->num_rows == 0){
			return FALSE;exit;
		}else{
			return $query->row();
		}
	}
	//$this->db->affected_rows() == 0 // Update query was ran successfully but nothing was updated
	//$this->db->affected_rows() == 1 // Update query was ran successfully and 1 row was updated
	//$this->db->affected_rows() == -1 // Query failed 	
}