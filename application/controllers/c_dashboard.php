<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_dashboard extends CI_Controller {

	function __construct(){
		parent::__construct();
		  $this->load->helper(array('form', 'url'));
		  $this->load->model('m_mahasiswa');
	}

	public function index()
	{
		$editor_id=$this->session->userdata("user_id");
		$profile = $this->http_request("http://localhost/serviceOJS/api/userSubmitAntrian");
		$profile = json_decode($profile, TRUE);
		$publikasi = $this->http_request("http://localhost/serviceOJS/api/publication");
		$publikasi = json_decode($publikasi, TRUE);
		$submit = $this->http_request("http://localhost/serviceOJS/api/userSubmit/".$editor_id);
		$submit = json_decode($submit, TRUE);
		
		$mahasiswa = $this->m_mahasiswa->getMahasiswa()->result_array();	
//print_r($profile);
		$i=0;
		$data['countRevisi']=0;
		$data['countAntrian']=count($profile);
		$data['countSubmission']=count($submit);
		$data['countPublikasi']=count($publikasi);
		foreach($profile as $a){
			$nama=$a['first_name'].' '.$a['middle_name'].''.$a['last_name'];
			$nama=str_replace(' ', '', $nama);
			$profile[$i]['statusSkripsi']="data tidak di temukan di sistem skripsi";
			$profile[$i]['author_id']=0;
			foreach($mahasiswa as $b){
				$namaSiswa=$b['namaMahasiswa'];//dri filkomappp
				$namaSiswa=str_replace(' ', '', $namaSiswa);
				
				if(strtolower($nama) == strtolower($namaSiswa)){
					//echo $nama;
					$profile[$i]['statusSkripsi']=$b['status'];
					if($b['status']=="revisi"){
						$data['countRevisi']++;
					}
				} 
				
			}
		$i++;
				
	}
		
		//$data['user']=$profile;
		//$this->load->view('v_submissionAntrian',$data);
		$this->load->view('v_dashboard',$data);

	}
	function http_request($url){
		// persiapkan curl
		$ch = curl_init(); 
	
		// set url 
		curl_setopt($ch, CURLOPT_URL, $url);
	
		// return the transfer as a string 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	
		// $output contains the output string 
		$output = curl_exec($ch); 
	
		// tutup curl 
		curl_close($ch);      
	
		// mengembalikan hasil curl
		return $output;
	}
	
}
