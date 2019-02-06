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
	public function getTanggalSkripsi(){
		$dataUser = $this->m_mahasiswa->getTanggalSkripsi()->result();
		//print_r($mahasiswa);
		$date= date('Y-m-d H:i:s');
		$myArr = array();
        //print_r($dataUser);
        
        for($i=-13;$i<=0;$i++){
            $init = new \stdClass;
            $days_ago = date('Y-m-d', strtotime("$i days", strtotime($date)));
            $init->date = $days_ago;
            $init->unit = 0;
            foreach($dataUser as $d){
                if($days_ago==date('Y-m-d', strtotime($d->date))){
                    $init->unit++;
                }
            }
            // $init->date = strtotime($days_ago);
            array_push($myArr,$init);
        //print_r($days_ago);
        // print_r("\n");
		}
		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($myArr)) ;
	}
	public function getBulanSkripsi(){
		$dataUser = $this->m_mahasiswa->getTanggalSkripsi()->result();
		//print_r($mahasiswa);
		$date= date('Y-m-d H:i:s');
		$myArr = array();
        //print_r($dataUser);
        
        for($i=-11;$i<=0;$i++){
            $init = new \stdClass;
            $months_ago = date('Y-m-d', strtotime("$i months", strtotime($date)));
            $init->date = $months_ago;
            $init->unit = 0;
            foreach($dataUser as $d){
                if(date('Y-m',strtotime($months_ago))===date('Y-m', strtotime($d->date))){
                    $init->unit++;
                }
            }
            // $init->date = strtotime($days_ago);
            array_push($myArr,$init);
        //print_r($days_ago);
        // print_r("\n");
		}
		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($myArr)) ;
	}
	
}
