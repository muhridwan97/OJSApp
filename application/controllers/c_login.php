<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_login extends CI_Controller {

	function __construct(){
		parent::__construct();
		  $this->load->helper(array('form', 'url'));
          $this->load->model('m_login');
          $this->load->library('session');
	}

	public function index()
	{
        $this->load->view('v_login');
    }
    public function cek(){
        $username =  $this->input->post('username');
        $password =  $this->input->post('password');
        $cek = $this->m_login->getEditorAuth($username,md5($password))->result();
        $home = base_url();
        if (count($cek)==0){
			// $gagal['gagal'] = "gagal";
            // $this->load->view('v_login', $gagal);
            echo "gagal";
		}else{
			foreach ($cek as $c){
			};
			$data_session = array(
			'username' => $c->username,
			'user_id' => $c->user_id
            );
            $this->session->set_userdata($data_session);
            // redirect($home."ojsapp/c_dashboard/");
            echo "berhasil";
        }
        
    }
    public function logout()
	{
		$this->session->sess_destroy();
		redirect($home."c_login/");
	}
}