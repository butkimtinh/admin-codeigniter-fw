<?php
class Mdashboard extends CI_Model{

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get_user_birthday(){
        $current_year = date('Y');
        $this->db->where("(birthday <= '".($current_year+1)."-09-01' AND birthday >= '1900-01-01')");
        $this->db->where("published = 1");
        return $this->db->get("user")->result_array();
    }

    public function get_timesheet_holiday(){
                $current_year = date('Y');
                $this->db->where("(from_date >= '".$current_year."-01-01' AND from_date < '".($current_year+1)."-03-01')");
                $this->db->where("published = 1");
        return $this->db->get("timesheet_holiday")->result_array();
    }
}