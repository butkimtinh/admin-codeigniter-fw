<?php 
class User extends MX_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library(array("session","email","my_email"));
		$this->load->helper(array("url", "y4a", "form"));		
		$this->load->model("Muser");	
		$this->canView = check_role('user', 'view');
		$this->canEdit = check_role('user', 'edit');
	}
	
	public function login_user(){

		if(isset($_POST['submit'])){
			$user = $this->input->post("txtname");
			$pass = $this->input->post("txtpass");
			$rs = $this->Muser->check_login($user, md5($pass));
			if($rs == FALSE){
				$data['error'] = "Wrong username or password.";
				$this->load->view("login_user",$data);
			}else{
				if($rs->published == 0){
					$data['error'] = "Username '<strong>$user</strong>' is locked!";
					$this->load->view("login_user",$data);						
				}else{
					$this->load->library('session');
					$data['info'] = array("user_usergroupid"=> $rs->usergroup_id,
										  "user_name"		=> $rs->name,
										  "user_username"	=> $rs->username,
										  "user_id"    		=> $rs->id);
										  
					$this->session->set_flashdata('message', '<strong>Well done!</strong> You have logged in successfully.');
					$this->session->set_flashdata('message_type', 'success');
					$this->session->set_userdata($data['info']);
					redirect('/dashboard');
				}
			}
		}if(isset($_POST['forgot_password'])){
			$email = $_POST['txtemail'];
			$check_mail = $this->Muser->check_mail($email);
			if($check_mail == FALSE){
				$data['error'] = "Email do not exist!";
				$this->load->view("login_user",$data);	
			}else{
				$query = $this->Muser->get_user_email($email);
				$password = $query->password;
				$message = "Click link: ".base_url()."index.php/user/login_user?getpass=".$password;
				$mail = array(
							"to_receiver"   => $email, 
							"message"       => $message,
						);
				$this->my_email->config($mail);
				$this->my_email->sendmail();
				$data['done'] = "Please check email.";
				$this->load->view("login_user",$data);	
			}
		}
		if(isset($_POST['reset_password'])){
			$pass1 = $_POST['txtpass1'];
			$pass2 = $_POST['txtpass2'];
			$id = $_POST['id'];
			if($pass1 == $pass2){
				$data = array(
					'password' => md5($pass2)
				);
				$this->db->where('id', $id);
				$this->db->update('user', $data);
				$data['done'] = "Please login again.";
				$this->load->view("login_user",$data);	
			}
		}
		if(isset($_GET['getpass'])){
			$getpass = $_GET['getpass'];
			$query = $this->Muser->get_user_pass($getpass);
			if(!empty($query)){ $data['id'] = $query->id;}
			$query = $this->Muser->check_get_pass($getpass );
			if($query){
				$this->load->view("get_pass",$data);
			}else{
				$this->load->view("login_user");	
			}
		}
		else{
			if($this->session->userdata('user_id')){
				redirect('/dashboard');
			}else{		
				$this->load->view("login_user");			
			}
		}
	}

	public function logout_user(){
		$user_data = $this->session->all_userdata();
				
        foreach ($user_data as $key => $value) {
            if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                $this->session->unset_userdata($key);
            }
        }
   		$this->session->sess_destroy();
		$this->load->view("login_user");
	}
		
	public function index(){
		if(!$this->canView){
			$this->session->set_flashdata('message', '<strong>Oh snap!</strong> You do not have sufficient permissions to View.');
			$this->session->set_flashdata('message_type', 'danger');
			redirect(base_url()."index.php/dashboard");		//redirect
		}
				
		$params = array(
			"user_records_per_page" => 10,
			"user_search" => '',
			"user_order_by" => 'id',
			"user_asc_desc" => 'asc',
			"user_group_id" => '0'
		);
		$result 	= store_session($params);		
		$per_page 	= $result["user_records_per_page"];
		$search   	= $result["user_search"];
		$order_by   = $result["user_order_by"];
		$asc_desc   = $result["user_asc_desc"];
		$group_id   = $result["user_group_id"];
		
		$message = ($this->session->flashdata('message')) ? ($this->session->flashdata('message')) : '';
		$message_type = ($this->session->flashdata('message_type')) ? ($this->session->flashdata('message_type')) : '';				
		
		$config['base_url'] = base_url()."index.php/user/index/";
		$config['total_rows'] = $this->Muser->count_all($search, $group_id);
		$config['per_page'] = $per_page;
		$config['uri_segment'] = 3;		
		$this->load->library("pagination",$config);
		
		$start = $this->uri->segment(3);
		$data['info'] = $this->Muser->listall($config['per_page'],$start, $search, $order_by, $asc_desc, $group_id);
		$data['title'] = "Khách hàng - Danh sách";
		$data['search'] = $search;
		$data['start_no'] = $start+1;
		$data['per_page'] = $per_page;
		$data['total_rows'] = $config['total_rows'];
		$data['message'] = $message;
		$data['message_type'] = $message_type;
		$data['order_by'] = $order_by;
		$data['asc_desc'] = $asc_desc;
		$data['canEdit'] = $this->canEdit;
		
		$data['sltUserGroup'] = $this->Muser->sltUserGroup($group_id);
		
		$this->template->write_view("content","list_user",$data);	
		$this->template->render();
	}
		
	public function delete_user(){		
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
		
		if($this->Muser->delete_user($id) != -1){			
			$this->session->set_flashdata('message', '<strong>Well done!</strong> User deleted.');
			$this->session->set_flashdata('message_type', 'success');
		}else{
			$data['message'] = '<strong>Oh snap!</strong> Change a few things up and try submitting again.';
			$data['message_type'] = 'danger';
		}	
		redirect(base_url()."index.php/user");	
	}
	
	public function edit_user(){
		//Cancel operation
		if(isset($_POST['cancel'])) $this->cancel_user();
		
		//Check role
		if(!$this->canEdit){	
			$this->session->set_flashdata('message', '<strong>Oh snap!</strong> You do not have sufficient permissions to Edit.');
			$this->session->set_flashdata('message_type', 'danger');
			redirect(base_url()."index.php/user");		//redirect
		}
		
		//Repair data
		$show_edit_view = 0;
		$id = $this->uri->segment(3);
		
		//Edit or New
		if($id){	
			//EDIT				
			$data['info'] = $this->Muser->get_user($id);
			$data['title'] = "Khách hàng - Sửa";
		}else{
			//NEW
			$data['info'] = NULL;
			$data['title'] = "Khách hàng - Thêm";
		}
		
		//Update or Insert data
		if(isset($_POST['submit'])){
			$username 	    = $this->input->post("txtusername");
			$fullname 	    = $this->input->post("txtfullname");
			$address 	    = $this->input->post("txtaddress");
			$phone 	        = $this->input->post("txtphone");
			$email 	        = $this->input->post("txtemail");
            $facebook 	    = $this->input->post("txtfacebook");
            $day 			= $this->input->post("day");
            $month 			= $this->input->post("month");
            $year 			= $this->input->post("year");
            $birthday 		= $year."-".$month."-".$day;
            $gender 	    = $this->input->post("gender");
			$description 	= $this->input->post("txtdescription");
			$pass 	        = $this->input->post("pass");
			$updatetime     = date("Y-m-d H:i:s");
			$usergroup_id   =  $this->input->post("user_group_id");
			$published      =  $this->input->post("published");
			
			$data_insert = array("username"  => $username,
								 "name" => $fullname,
								 "address" => $address,
								 "phone" => $phone,
								 "email" => $email,
                                 "facebook" => $facebook,
								 "gender" => $gender,
                                 "birthday" => $birthday,
								 "description" => $description,
								 "updatetime" => $updatetime,
								 "usergroup_id"     => $usergroup_id,
								 "published"    => $published);
						 
			if($pass != ""){
				$data_insert['password'] = md5($pass);
			}					 
											
			if($this->Muser->store($id,$data_insert) != -1){			
				$this->session->set_flashdata('message', '<strong>Well done!</strong> User edited.');
				$this->session->set_flashdata('message_type', 'success');
				redirect(base_url()."index.php/user");
			}else{
				$data['message'] = '<strong>Oh snap!</strong> Change a few things up and try submitting again.';
				$data['message_type'] = 'danger';
				$show_edit_view = 1;	
			}
		}else{
			$show_edit_view = 1;
			if(!empty($data['info'])){
				$data['sltUserGroup'] = $this->Muser->sltUserGroup($data['info']->usergroup_id);
			}else{
				$data['sltUserGroup'] = $this->Muser->sltUserGroup(0);
			}
		}
		
		//Show data in view
		if($show_edit_view){
			$this->template->write_view("content","form_user",$data);	
			$this->template->render();
		}
	}
		
	public function new_user(){
		if(!$this->canEdit){	
			$this->session->set_flashdata('message', '<strong>Oh snap!</strong> You do not have sufficient permissions to Add new.');
			$this->session->set_flashdata('message_type', 'danger');
			redirect(base_url()."index.php/user");		//redirect
		}
		$this->edit_user();
	}
	
	public function published_user(){
		if(!$this->canEdit){	
			$this->session->set_flashdata('message', '<strong>Oh snap!</strong> You do not have sufficient permissions to Edit.');
			$this->session->set_flashdata('message_type', 'danger');
			redirect(base_url()."index.php/user");		//redirect
		}
		$id = $this->uri->segment(3);
		if($this->Muser->published_user($id) != -1){			
			$this->session->set_flashdata('message', '<strong>Well done!</strong> User published.');
			$this->session->set_flashdata('message_type', 'success');
			redirect(base_url()."index.php/user");
		}else{
			$data['message'] = '<strong>Oh snap!</strong> Change a few things up and try submitting again.';
			$data['message_type'] = 'danger';
			$show_edit_view = 1;	
		}
	}

	public function unpublished_user(){
		if(!$this->canEdit){	
			$this->session->set_flashdata('message', '<strong>Oh snap!</strong> You do not have sufficient permissions to Edit.');
			$this->session->set_flashdata('message_type', 'danger');
			redirect(base_url()."index.php/user");		//redirect
		}
		$id = $this->uri->segment(3);
		if($this->Muser->unpublished_user($id) != -1){			
			$this->session->set_flashdata('message', '<strong>Well done!</strong> User unpublished.');
			$this->session->set_flashdata('message_type', 'success');
			redirect(base_url()."index.php/user");
		}else{
			$data['message'] = '<strong>Oh snap!</strong> Change a few things up and try submitting again.';
			$data['message_type'] = 'danger';
			$show_edit_view = 1;	
		}
	}
	
	public function cancel_user(){
		$this->session->set_flashdata('message', '<strong>Okie!</strong> Operation cancelled.');
		$this->session->set_flashdata('message_type', 'info');
		redirect(base_url()."index.php/user");		//redirect
	}

    public function index_benhnhan(){
        if(!$this->canView){
            $this->session->set_flashdata('message', '<strong>Oh snap!</strong> You do not have sufficient permissions to View.');
            $this->session->set_flashdata('message_type', 'danger');
            redirect(base_url()."index.php/dashboard");		//redirect
        }

        $params = array(
            "user_records_per_page" => 10,
            "user_search" => '',
            "user_order_by" => 'id',
            "user_asc_desc" => 'asc',
        );
        $result 	= store_session($params);
        $per_page 	= $result["user_records_per_page"];
        $search   	= $result["user_search"];
        $order_by   = $result["user_order_by"];
        $asc_desc   = $result["user_asc_desc"];

        $message = ($this->session->flashdata('message')) ? ($this->session->flashdata('message')) : '';
        $message_type = ($this->session->flashdata('message_type')) ? ($this->session->flashdata('message_type')) : '';

        $config['base_url'] = base_url()."index.php/user/index/";
        $config['total_rows'] = $this->Muser->count_all($search, 0, 1); //Lấy toàn bộ danh sách
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 3;
        $this->load->library("pagination",$config);

        $start = $this->uri->segment(3);
        $data['info'] = $this->Muser->listall($config['per_page'],$start, $search, $order_by, $asc_desc, 0, 1);//Lấy toàn bộ danh sách
        $data['title'] = "User - List";
        $data['search'] = $search;
        $data['start_no'] = $start+1;
        $data['per_page'] = $per_page;
        $data['total_rows'] = $config['total_rows'];
        $data['message'] = $message;
        $data['message_type'] = $message_type;
        $data['order_by'] = $order_by;
        $data['asc_desc'] = $asc_desc;
        $data['canEdit'] = $this->canEdit;

        $this->template->write_view("content","list_userbenhnhan",$data);
        $this->template->render();
    }
}