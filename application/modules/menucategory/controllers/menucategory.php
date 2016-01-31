<?php 
class MenuCategory extends MX_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper(array("url", "y4a"));		
		$this->load->model("Mmenucategory");	
		$this->canView = check_role('menucategory', 'view');
		$this->canEdit = check_role('menucategory', 'edit');
	}
	
	public function index(){
		if(!$this->canView){
			$this->session->set_flashdata('message', '<strong>Oh snap!</strong> You do not have sufficient permissions to View.');
			$this->session->set_flashdata('message_type', 'danger');
			redirect(base_url()."index.php/dashboard");		//redirect
		}
				
		$params = array(
			"menucategory_records_per_page" => 10,
			"menucategory_search" => '',
			"menucategory_order_by" => 'id',
			"menucategory_asc_desc" => 'asc'
		);
		$result 	= store_session($params);		
		$per_page 	= $result["menucategory_records_per_page"];
		$search   	= $result["menucategory_search"];
		$order_by   = $result["menucategory_order_by"];
		$asc_desc   = $result["menucategory_asc_desc"];
		//echo p($result);
		
		$message = ($this->session->flashdata('message')) ? ($this->session->flashdata('message')) : '';
		$message_type = ($this->session->flashdata('message_type')) ? ($this->session->flashdata('message_type')) : '';				
		
		$config['base_url'] = base_url()."index.php/menucategory/index/";
		$config['total_rows'] = $this->Mmenucategory->count_all($search);
		$config['per_page'] = $per_page;
		$config['uri_segment'] = 3;		
		$this->load->library("pagination",$config);
		
		$start = $this->uri->segment(3);
		$data['info'] = $this->Mmenucategory->listall($config['per_page'],$start, $search, $order_by, $asc_desc);
		$data['title'] = "Menu Category - List";
		$data['search'] = $search;
		$data['start_no'] = $start+1;
		$data['per_page'] = $per_page;
		$data['total_rows'] = $config['total_rows'];
		$data['message'] = $message;
		$data['message_type'] = $message_type;
		$data['order_by'] = $order_by;
		$data['asc_desc'] = $asc_desc;
		$data['canEdit'] = $this->canEdit;
		
		$this->template->write_view("content","list_menucategory",$data);	
		$this->template->render();
	}
		
	public function delete_menucategory(){	
		if(!$this->canEdit){
			$this->session->set_flashdata('message', '<strong>Oh snap!</strong> You do not have sufficient permissions to Delete.');
			$this->session->set_flashdata('message_type', 'danger');
			redirect(base_url()."index.php/user");		//redirect
		}
			
		if($this->uri->segment(3)){
			$id = array($this->uri->segment(3));	
		}elseif(isset($_POST['id'])){
			$id = $_POST['id'];
		}
		
		if($this->Mmenucategory->delete_menucategory($id) != -1){			
			$this->session->set_flashdata('message', '<strong>Well done!</strong> You successfully read this important alert message.');
			$this->session->set_flashdata('message_type', 'success');
		}else{
			$data['message'] = '<strong>Oh snap!</strong> Change a few things up and try submitting again.';
			$data['message_type'] = 'danger';
		}	
		redirect(base_url()."index.php/menucategory");	
	}
	
	public function edit_menucategory(){
		//Cancel operation
		if(isset($_POST['cancel'])) $this->cancel_menucategory();
		
		//Check role
		if(!$this->canEdit){	
			$this->session->set_flashdata('message', '<strong>Oh snap!</strong> You do not have sufficient permissions to Edit.');
			$this->session->set_flashdata('message_type', 'danger');
			redirect(base_url()."index.php/menucategory");		//redirect
		}
		
		$show_edit_view = 0;
		$id = $this->uri->segment(3);
		
		if($id){	
			//EDIT				
			$data['info'] = $this->Mmenucategory->get_menucategory($id);
			$data['title'] = "Menu Category - Edit";	
		}else{
			//NEW
			$data['info'] = NULL;
			$data['title'] = "Menu Category - New";	
		}
		
		if(isset($_POST['submit'])){
			$title 		= $this->input->post("txttitle");
			$icon	 	= $this->input->post("txticon");
			$link 		= $this->input->post("txtlink");
            $module 		= $this->input->post("txtmodule");
			$ordered 	= $this->input->post("txtordered");
			$published	=  $this->input->post("published");
			
			$data_insert = array(
                "title"  => $title,
                "icon"     => $icon,
                "link"     => $link,
                "module"     => $module,
                "ordered"     => $ordered,
                "published"    => $published
								 );
						 
											
			if($this->Mmenucategory->store($id,$data_insert) != -1){			
				$this->session->set_flashdata('message', '<strong>Well done!</strong> You successfully read this important alert message.');
				$this->session->set_flashdata('message_type', 'success');
				redirect(base_url()."index.php/menucategory");
			}else{
				$data['message'] = '<strong>Oh snap!</strong> Change a few things up and try submitting again.';
				$data['message_type'] = 'danger';
				$show_edit_view = 1;	
			}
		}else{
			$show_edit_view = 1;
		}
		
		if($show_edit_view){
			$this->template->write_view("content","form_menucategory",$data);	
			$this->template->render();
		}
	}
		
	public function new_menucategory(){
		if(!$this->canEdit){	
			$this->session->set_flashdata('message', '<strong>Oh snap!</strong> You do not have sufficient permissions to Add new.');
			$this->session->set_flashdata('message_type', 'danger');
			redirect(base_url()."index.php/menucategory");		//redirect
		}
		$this->edit_menucategory();
	}
	
	public function published_menucategory(){
		if(!$this->canEdit){	
			$this->session->set_flashdata('message', '<strong>Oh snap!</strong> You do not have sufficient permissions to Edit.');
			$this->session->set_flashdata('message_type', 'danger');
			redirect(base_url()."index.php/menucategory");		//redirect
		}
		$id = $this->uri->segment(3);
		if($this->Mmenucategory->published_menucategory($id) != -1){			
			$this->session->set_flashdata('message', '<strong>Well done!</strong> You successfully read this important alert message.');
			$this->session->set_flashdata('message_type', 'success');
			redirect(base_url()."index.php/menucategory");
		}else{
			$data['message'] = '<strong>Oh snap!</strong> Change a few things up and try submitting again.';
			$data['message_type'] = 'danger';
			$show_edit_view = 1;	
		}
	}

	public function unpublished_menucategory(){
		if(!$this->canEdit){	
			$this->session->set_flashdata('message', '<strong>Oh snap!</strong> You do not have sufficient permissions to Edit.');
			$this->session->set_flashdata('message_type', 'danger');
			redirect(base_url()."index.php/menucategory");		//redirect
		}
		$id = $this->uri->segment(3);
		if($this->Mmenucategory->unpublished_menucategory($id) != -1){			
			$this->session->set_flashdata('message', '<strong>Well done!</strong> You successfully read this important alert message.');
			$this->session->set_flashdata('message_type', 'success');
			redirect(base_url()."index.php/menucategory");
		}else{
			$data['message'] = '<strong>Oh snap!</strong> Change a few things up and try submitting again.';
			$data['message_type'] = 'danger';
			$show_edit_view = 1;	
		}
	}
	
	public function cancel_menucategory(){
		$this->session->set_flashdata('message', '<strong>Okie!</strong> Operation cancelled.');
		$this->session->set_flashdata('message_type', 'info');
		redirect(base_url()."index.php/menucategory");		//redirect
	}
}