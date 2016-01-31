<?php
class Mmenuitem extends CI_Model{
	protected $_table = "menuitem";
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
		
	/*Thành Edit*/
	public function listall($offset,$start,$search,$order_by,$asc_desc){
		$this->db->select("*,(select b2.title from menuitem b2 where b2.id=b1.parent_id) title_parent");
		$this->db->from("menuitem as b1");
		$this->db->like('title',$search);
		$this->db->order_by($order_by,$asc_desc);
		$this->db->limit($offset,$start);
		return $this->db->get()->result_array();
	}
	public function count_all($search){
		$this->db->select("*,(select b2.title from menuitem b2 where b2.id=b1.parent_id) title_parent");
		$this->db->from("menuitem as b1");
		$this->db->like('title',$search);
		$return = $this->db->get()->result();		
		return count($return);
	}
	public function list_all($offset,$start,$search,$order_by,$asc_desc){
		$this->db->select("*,(select b2.title from menuitem b2 where b2.id=b1.parent_id) title_parent");
		$this->db->from("menuitem as b1");
		$this->db->like('title',$search);
		$this->db->order_by($order_by,$asc_desc);
		$this->db->limit($offset,$start);
		return $this->db->get()->result_array();
	}
    public function get_menuitem_t($id){
        $this->db->select("*,(select b2.title from menuitem b2 where b2.id=b1.parent_id) title_parent");
        $this->db->from("menuitem as b1");
        $this->db->where("id",$id);
        return $this->db->get()->row();
    }


	/*End Edit*/
	public function get_menuitem($id){
		$this->db->where("id",$id);
		return $this->db->get($this->_table)->row();
	}
	
	public function store($id,$data){
		$this->db->where("id",$id);
		($id) ? $this->db->update($this->_table,$data) : $this->db->insert($this->_table, $data);
		return $this->db->affected_rows();
	}
	
	public function delete_menuitem($id){
		$this->db->where_in('id', $id);
		$this->db->delete($this->_table);
		return $this->db->affected_rows();
	}
	
	public function published_menuitem($id){
		if($id){
			$this->db->where("id",$id);
			$this->db->update($this->_table,array('published' => 1));
			return $this->db->affected_rows();
		}
		return -1;
	}

	public function unpublished_menuitem($id){
		if($id){
			$this->db->where("id",$id);
			$this->db->update($this->_table,array('published' => 0));
			return $this->db->affected_rows();
		}
		return -1;
	}

	public function stlCategory($categoryID){
		$this->load->model("menucategory/Mmenucategory","MenuCategory_model");	
		$categoryList = $this->MenuCategory_model->getCategoryList();
		if($categoryList)
			return frmSelectBox("menuitem_category_id",$categoryList, $categoryID);
	}

    public function getMenuItems(){
        $this->db->select("*,(select b2.title from menuitem b2 where b2.id=b1.parent_id) title_parent");
        $this->db->from("menuitem as b1");
        $this->db->where("published", 1);
        $this->db->order_by('order','asc');
        return $this->db->get()->result_array();
    }
	//$this->db->affected_rows() == 0 // Update query was ran successfully but nothing was updated
	//$this->db->affected_rows() == 1 // Update query was ran successfully and 1 row was updated
	//$this->db->affected_rows() == -1 // Query failed 	
}