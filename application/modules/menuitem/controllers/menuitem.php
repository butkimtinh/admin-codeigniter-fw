<?php 
class menuitem extends MX_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper(array("url", "y4a", "form"));		
		$this->load->model("Mmenuitem");	
		$this->canView = check_role('menuitem', 'view');
		$this->canEdit = check_role('menuitem', 'edit');
	}
	
	public function index(){
		if(!$this->canView){
			$this->session->set_flashdata('message', '<strong>Oh snap!</strong> You do not have sufficient permissions to View.');
			$this->session->set_flashdata('message_type', 'danger');
			redirect(base_url()."index.php/dashboard");		//redirect
		}
				
		$params = array(
			"menuitem_records_per_page" => 10,
			"menuitem_search" => '',
			"menuitem_order_by" => 'id',
			"menuitem_asc_desc" => 'asc',
			"menuitem_category_id" => '0'
		);
		$result = store_session($params);		
		$per_page = $result["menuitem_records_per_page"];
		$search   = $result["menuitem_search"];
		$order_by   = $result["menuitem_order_by"];
		$asc_desc   = $result["menuitem_asc_desc"];
		$category_id   = $result["menuitem_category_id"];
		//echo p($result);
		
		$message = ($this->session->flashdata('message')) ? ($this->session->flashdata('message')) : '';
		$message_type = ($this->session->flashdata('message_type')) ? ($this->session->flashdata('message_type')) : '';				
		
		$config['base_url'] = base_url()."index.php/menuitem/index/";
		$config['total_rows'] = $this->Mmenuitem->count_all($search);
		$config['per_page'] = $per_page;
		$config['uri_segment'] = 3;		
		$this->load->library("pagination",$config);
		
		$start = $this->uri->segment(3);
		$data['info'] = $this->Mmenuitem->listall($config['per_page'],$start, $search, $order_by, $asc_desc);
		$data['title'] = "Menu Items - List";
		$data['search'] = $search;
		$data['start_no'] = $start+1;
		$data['per_page'] = $per_page;
		$data['total_rows'] = $config['total_rows'];
		$data['message'] = $message;
		$data['message_type'] = $message_type;
		$data['order_by'] = $order_by;
		$data['asc_desc'] = $asc_desc;
		$data['canEdit'] = $this->canEdit;

		//$data['sltCategory'] = $this->Mmenuitem->stlCategory($category_id);
		
		$this->template->write_view("content","list_menuitem",$data);	
		$this->template->render();
	}
		
	public function delete_menuitem(){	
		if(!$this->canEdit){
			$this->session->set_flashdata('message', '<strong>Oh snap!</strong> You do not have sufficient permissions to Delete.');
			$this->session->set_flashdata('message_type', 'danger');
			redirect(base_url()."index.php/menuitem");		//redirect
		}
			
		if($this->uri->segment(3)){
			$id = array($this->uri->segment(3));	
		}elseif(isset($_POST['id'])){
			$id = $_POST['id'];
		}
		
		if($this->Mmenuitem->delete_menuitem($id) != -1){			
			$this->session->set_flashdata('message', '<strong>Well done!</strong> You successfully read this important alert message.');
			$this->session->set_flashdata('message_type', 'success');
		}else{
			$data['message'] = '<strong>Oh snap!</strong> Change a few things up and try submitting again.';
			$data['message_type'] = 'danger';
		}	
		redirect(base_url()."index.php/menuitem");	
	}
	
	public function edit_menuitem(){
		//Cancel operation
		if(isset($_POST['cancel'])) $this->cancel_menuitem();
		
		//Check role
		if(!$this->canEdit){	
			$this->session->set_flashdata('message', '<strong>Oh snap!</strong> You do not have sufficient permissions to Edit.');
			$this->session->set_flashdata('message_type', 'danger');
			redirect(base_url()."index.php/menuitem");		//redirect
		}
		
		$show_edit_view = 0;
		$id = $this->uri->segment(3);
		
		if($id){	
			//EDIT				
			$data['info'] = $this->Mmenuitem->get_menuitem_t($id);
			$data['title'] = "Menu Item - Edit";	
		}else{
			//NEW
			$data['info'] = NULL;
			$data['title'] = "Menu Item - New";	
		}
		
		if(isset($_POST['submit'])){
			$title 		= $this->input->post("txttitle");
			$categoryId	= $this->input->post("name_parent");
			$link 		= $this->input->post("txtlink");
			$ordered 	= $this->input->post("txtordered");
			$published	=  $this->input->post("published");
            $icon       = $this->input->post("txticon");
			
			$data_insert = array("title"  => $title,
								 "parent_id"     => $categoryId,
								 "link"     => $link,
								 "ordered"     => $ordered,
								 "published"    => $published,
                                "icon"          =>$icon
								 );
						 
											
			if($this->Mmenuitem->store($id,$data_insert) != -1){			
				$this->session->set_flashdata('message', '<strong>Well done!</strong> You successfully read this important alert message.');
				$this->session->set_flashdata('message_type', 'success');
				redirect(base_url()."index.php/menuitem");
			}else{
				$data['message'] = '<strong>Oh snap!</strong> Change a few things up and try submitting again.';
				$data['message_type'] = 'danger';
				$show_edit_view = 1;	
			}
		}else{
			if($data['info'])
				$menucategoryID = $data['info']->parent_id;
			else
				$menucategoryID = 0;
			$data['name_parent'] = $this->Mmenuitem->list_all(99999999, 0, '', 'title', 'desc');
			//p($name_parent);
			 //foreach($name_parent as $key => $item){
            		//$name_parent[$key]['id'] = $item['title'];
        		//}

        	//$data['name_parent'] = t_frmSelectBoxWithSearch('name_parent', $name_parent, $selectedFieldID = $id, $valueField = 'id', $titleField = 'id', $action = '');

			$show_edit_view = 1;
		}
		
		if($show_edit_view){
			$this->template->write_view("content","form_menuitem",$data);	
			$this->template->render();
		}
	}
	
	
	public function new_menuitem(){
		if(!$this->canEdit){	
			$this->session->set_flashdata('message', '<strong>Oh snap!</strong> You do not have sufficient permissions to Add new.');
			$this->session->set_flashdata('message_type', 'danger');
			redirect(base_url()."index.php/menuitem");		//redirect
		}
		$this->edit_menuitem();
	}

	public function published_menuitem(){
		if(!$this->canEdit){	
			$this->session->set_flashdata('message', '<strong>Oh snap!</strong> You do not have sufficient permissions to Edit.');
			$this->session->set_flashdata('message_type', 'danger');
			redirect(base_url()."index.php/menuitem");		//redirect
		}
		$id = $this->uri->segment(3);
		if($this->Mmenuitem->published_menuitem($id) != -1){			
			$this->session->set_flashdata('message', '<strong>Well done!</strong> You successfully read this important alert message.');
			$this->session->set_flashdata('message_type', 'success');
			redirect(base_url()."index.php/menuitem");
		}else{
			$data['message'] = '<strong>Oh snap!</strong> Change a few things up and try submitting again.';
			$data['message_type'] = 'danger';
			$show_edit_view = 1;	
		}
	}

	public function unpublished_menuitem(){
		if(!$this->canEdit){	
			$this->session->set_flashdata('message', '<strong>Oh snap!</strong> You do not have sufficient permissions to Edit.');
			$this->session->set_flashdata('message_type', 'danger');
			redirect(base_url()."index.php/menuitem");		//redirect
		}
		$id = $this->uri->segment(3);
		if($this->Mmenuitem->unpublished_menuitem($id) != -1){			
			$this->session->set_flashdata('message', '<strong>Well done!</strong> You successfully read this important alert message.');
			$this->session->set_flashdata('message_type', 'success');
			redirect(base_url()."index.php/menuitem");
		}else{
			$data['message'] = '<strong>Oh snap!</strong> Change a few things up and try submitting again.';
			$data['message_type'] = 'danger';
			$show_edit_view = 1;	
		}
	}
	
	public function cancel_menuitem(){
		$this->session->set_flashdata('message', '<strong>Okie!</strong> Operation cancelled.');
		$this->session->set_flashdata('message_type', 'info');
		redirect(base_url()."index.php/menuitem");		//redirect
	}	
}