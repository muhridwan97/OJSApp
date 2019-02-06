<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_settings extends CI_Controller {

	function __construct(){
		parent::__construct();
		  $this->load->helper(array('form', 'url'));
		  $this->load->model('m_settings');
	}

	public function index()
	{
        $data['waktu'] = $this->m_settings->getWaktuTenggang()->result_array();
		$this->load->view('v_settings',$data);
	}
	public function setWaktuTenggang(){
        $hari = $this->input->post("hari");
        $this->m_settings->setWaktuTenggang($hari);
        echo "{}";
    }
	
}
