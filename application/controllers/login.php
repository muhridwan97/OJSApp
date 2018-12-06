<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		  $this->load->model('m_login');
		  $this->load->helper('url');
	}
	
	public function index()
	{
		$this->load->view('v_login');

	}
	public function cek()
	{
		$id = $this->input->post('id');
		$password = $this->input->post('password');
		$status = $this->input->post('status');
		if($status=='mahasiswa'){
			$cek = $this->m_login->getMahasiswaAuth($id,$password)->result();
			if(count($cek)>0){
				foreach($cek as $c){
					
				};
				$data_session = array(
				'user' => $c->mahasiswa_nama,
				'id' => $c->mahasiswa_id,
				'alamat' => $c->mahasiswa_asal,
				);
				$this->session->set_userdata($data_session);
				$this->load->view('dashboard_mahasiswa');
			}
		}else{
			$cek = $this->m_login->getDosenAuth($id,$password)->result();
			if(count($cek)>0){
				foreach($cek as $c){
					
				};
				$data_session = array(
				'user' => $c->dosen_nama,
				'id' => $c->dosen_id,
				'alamat' => $c->dosen_asal,
				);
				$this->session->set_userdata($data_session);
				redirect('dosen/');
			}
		}
		

	}
}
