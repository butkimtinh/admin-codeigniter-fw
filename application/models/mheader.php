<?php
require_once(BASEPATH . 'core/Model.php');
class Mheader extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->helper(array("url", "y4a"));		
		$this->load->database();
	}
	

}