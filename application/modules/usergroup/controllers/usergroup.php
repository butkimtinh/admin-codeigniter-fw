<?php 
class UserGroup extends MX_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper(array("url", "y4a", "form"));
		$this->load->model("Musergroup");	
		$this->canView = check_role('usergroup', 'view');
		$this->canEdit = check_role('usergroup', 'edit');
	}
	
	public function index(){
		if(!$this->canView){
			$this->session->set_flashdata('message', '<strong>Oh snap!</strong> You do not have sufficient permissions to View.');
			$this->session->set_flashdata('message_type', 'danger');
			redirect(base_url()."index.php/dashboard");		//redirect
		}
				
		$params = array(
			"usergroup_records_per_page" => 10,
			"usergroup_search" => '',
			"usergroup_order_by" => 'id',
			"usergroup_asc_desc" => 'asc'
		);
		$result 	= store_session($params);		
		$per_page 	= $result["usergroup_records_per_page"];
		$search   	= $result["usergroup_search"];
		$order_by   = $result["usergroup_order_by"];
		$asc_desc   = $result["usergroup_asc_desc"];
		//echo p($result);
		
		$message = ($this->session->flashdata('message')) ? ($this->session->flashdata('message')) : '';
		$message_type = ($this->session->flashdata('message_type')) ? ($this->session->flashdata('message_type')) : '';				
		
		$config['base_url'] = base_url()."index.php/usergroup/index/";
		$config['total_rows'] = $this->Musergroup->count_all($search);
		$config['per_page'] = $per_page;
		$config['uri_segment'] = 3;		
		$this->load->library("pagination",$config);
		
		$start = $this->uri->segment(3);
		$data['info'] = $this->Musergroup->listall($config['per_page'],$start, $search, $order_by, $asc_desc);
		$data['title'] = "User Group - List";
		$data['search'] = $search;
		$data['start_no'] = $start+1;
		$data['per_page'] = $per_page;
		$data['total_rows'] = $config['total_rows'];
		$data['message'] = $message;
		$data['message_type'] = $message_type;
		$data['order_by'] = $order_by;
		$data['asc_desc'] = $asc_desc;
		$data['canEdit'] = $this->canEdit;
		
		$this->template->write_view("content","list_usergroup",$data);	
		$this->template->render();
	}
		
	public function delete_usergroup(){	
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
		
		if($this->Musergroup->delete_usergroup($id) != -1){			
			$this->session->set_flashdata('message', '<strong>Well done!</strong> You successfully read this important alert message.');
			$this->session->set_flashdata('message_type', 'success');
		}else{
			$data['message'] = '<strong>Oh snap!</strong> Change a few things up and try submitting again.';
			$data['message_type'] = 'danger';
		}	
		redirect(base_url()."index.php/usergroup");	
	}
	
	public function edit_usergroup(){

		//Cancel operation
		if(isset($_POST['cancel'])) $this->cancel_usergroup();
		
		//Check role
		if(!$this->canEdit){	
			$this->session->set_flashdata('message', '<strong>Oh snap!</strong> You do not have sufficient permissions to Edit.');
			$this->session->set_flashdata('message_type', 'danger');
			redirect(base_url()."index.php/usergroup");		//redirect
		}
		
		$show_edit_view = 0;
		$id = $this->uri->segment(3);
		
		if($id){	
			//EDIT
            $info = $this->Musergroup->get_usergroup($id);
			$data['info'] = $info;
			$data['title'] = "User Group - Edit";
            $data['sltCanView'] = sltModulesRole('sltCanView' , $info->canview);
            $data['sltCanEdit'] = sltModulesRole('sltCanEdit' , $info->canedit);
		}else{
			//NEW
			$data['info'] = NULL;
			$data['title'] = "User Group - New";
            $data['sltCanView'] = sltModulesRole('sltCanView');
            $data['sltCanEdit'] = sltModulesRole('sltCanEdit');
		}


		if(isset($_POST['submit'])){

			$title 		= $this->input->post("txttitle");
			$note 		= $this->input->post("txtnote");
			$ordered 	= $this->input->post("txtordered");
			$published	=  $this->input->post("published");
            $canview	=  $this->input->post("canview");
            $canedit	=  $this->input->post("canedit");
			
			$data_insert = array(
                "title"  => $title,
                "note"     => $note,
                "ordered"     => $ordered,
                "published"    => $published,
                "canview"    => substr($canview, 0, -1),
                "canedit"    => substr($canedit, 0, -1),
            );
						 
											
			if($this->Musergroup->store($id,$data_insert) != -1){			
				$this->session->set_flashdata('message', '<strong>Well done!</strong> You successfully read this important alert message.');
				$this->session->set_flashdata('message_type', 'success');
				redirect(base_url()."index.php/usergroup");
			}else{
				$data['message'] = '<strong>Oh snap!</strong> Change a few things up and try submitting again.';
				$data['message_type'] = 'danger';
				$show_edit_view = 1;	
			}
		}else{
			$show_edit_view = 1;
		}
		
		if($show_edit_view){

			$this->template->write_view("content","form_usergroup",$data);	
			$this->template->render();
		}
	}
		
	public function new_usergroup(){
		if(!$this->canEdit){	
			$this->session->set_flashdata('message', '<strong>Oh snap!</strong> You do not have sufficient permissions to Add new.');
			$this->session->set_flashdata('message_type', 'danger');
			redirect(base_url()."index.php/usergroup");		//redirect
		}
		$this->edit_usergroup();
	}
	
	public function published_usergroup(){
		if(!$this->canEdit){	
			$this->session->set_flashdata('message', '<strong>Oh snap!</strong> You do not have sufficient permissions to Edit.');
			$this->session->set_flashdata('message_type', 'danger');
			redirect(base_url()."index.php/usergroup");		//redirect
		}
		$id = $this->uri->segment(3);
		if($this->Musergroup->published_usergroup($id) != -1){			
			$this->session->set_flashdata('message', '<strong>Well done!</strong> You successfully read this important alert message.');
			$this->session->set_flashdata('message_type', 'success');
			redirect(base_url()."index.php/usergroup");
		}else{
			$data['message'] = '<strong>Oh snap!</strong> Change a few things up and try submitting again.';
			$data['message_type'] = 'danger';
			$show_edit_view = 1;	
		}
	}

	public function unpublished_usergroup(){
		if(!$this->canEdit){	
			$this->session->set_flashdata('message', '<strong>Oh snap!</strong> You do not have sufficient permissions to Edit.');
			$this->session->set_flashdata('message_type', 'danger');
			redirect(base_url()."index.php/usergroup");		//redirect
		}
		$id = $this->uri->segment(3);
		if($this->Musergroup->unpublished_usergroup($id) != -1){			
			$this->session->set_flashdata('message', '<strong>Well done!</strong> You successfully read this important alert message.');
			$this->session->set_flashdata('message_type', 'success');
			redirect(base_url()."index.php/usergroup");
		}else{
			$data['message'] = '<strong>Oh snap!</strong> Change a few things up and try submitting again.';
			$data['message_type'] = 'danger';
			$show_edit_view = 1;	
		}
	}
	
	public function cancel_usergroup(){
		$this->session->set_flashdata('message', '<strong>Okie!</strong> Operation cancelled.');
		$this->session->set_flashdata('message_type', 'info');
		redirect(base_url()."index.php/usergroup");		//redirect
	}
}