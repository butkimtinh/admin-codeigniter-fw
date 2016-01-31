<?php
require_once(BASEPATH . 'core/Model.php');
class Mmenu extends CI_Model{
	protected $_table = "menuitem";

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	public function getMenuItems(){
		$this->db->select("*,(select b2.title from menuitem b2 where b2.id = b1.parent_id ) title_parent");	
		$this->db->from("menuitem as b1");
		$this->db->where("published", 1);
		$this->db->order_by("ordered","ASC");
		$return = $this->db->get()->result_array();
		return $return;

	}
}