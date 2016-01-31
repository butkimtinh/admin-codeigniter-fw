<?php 
class Dashboard extends MX_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->helper(array("url", "y4a"));
        $this->load->model('Mdashboard');
    }
		
	public function index(){		
		$data['title'] = "Dashboard";
        $data['info'] = $this->Mdashboard->get_user_birthday();

        $data['calendar_view'] = $this->load->view("dashboard_calendar", $data, TRUE);
        $data['taskview'] = $this->load->view("dashboard_taskview", $data, TRUE);

		$this->template->write_view("content","dashboard",$data);	
		$this->template->render();
	}


}