<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_submission extends CI_Controller {

	function __construct(){
		parent::__construct();
		  $this->load->helper(array('form', 'url'));
		  $this->load->model('m_mahasiswa');
	}

	public function index()
	{
		$profile = $this->http_request("http://localhost/serviceOJS/api/userSubmit");
		$issue = $this->http_request("http://localhost/serviceOJS/api/publicationIssue");
		// ubah string JSON menjadi array
		$profile = json_decode($profile, TRUE);
		$issue = json_decode($issue, TRUE);
		
		//$mahasiswa = $this->m_mahasiswa->getMahasiswa()->result_array();	
//print_r($profile);

	// 	foreach($profile as $a){
	// 		$nama=$a['first_name'].' '.$a['middle_name'].''.$a['last_name'];
	// 		foreach($mahasiswa as $b){
	// 			if(strtolower($nama) === strtolower($b['namaMahasiswa'])){
	// 				//echo $b['namaMahasiswa'];
	// 			} 
	// 		}
			
				
	// }
		
		$data['user']=$profile;
		$data['issue']=$issue;
		$this->load->view('v_submission',$data);

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
	function http_request_post($url,$post){
		// persiapkan curl
		$ch = curl_init(); 
		$post = http_build_query($post);
		//print_r($post);
		// set url 
		curl_setopt($ch, CURLOPT_URL, $url);
	
		// return the transfer as a string 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	
		// $output contains the output string 
		$output = curl_exec($ch); 
	
		// tutup curl 
		curl_close($ch);      
	
		// mengembalikan hasil curl
		return $output;
	}
	public function lihatAntrian(){
		$profile = $this->http_request("http://localhost/serviceOJS/api/userSubmitAntrian");
		
		// ubah string JSON menjadi array
		$profile = json_decode($profile, TRUE);
		
		$mahasiswa = $this->m_mahasiswa->getMahasiswa()->result_array();	
//print_r($profile);
		$i=0;
		foreach($profile as $a){
			$nama=$a['first_name'].' '.$a['middle_name'].''.$a['last_name'];
			$nama=str_replace(' ', '', $nama);
			$profile[$i]['statusSkripsi']="data tidak di temukan di filkop APP";
			$profile[$i]['author_id']=0;
			foreach($mahasiswa as $b){
				$namaSiswa=$b['namaMahasiswa'];//dri filkomappp
				$namaSiswa=str_replace(' ', '', $namaSiswa);
				
				if(strtolower($nama) == strtolower($namaSiswa)){
					//echo $nama;
					$profile[$i]['statusSkripsi']=$b['status'];
					$profile[$i]['author_id']=$b['mahasiswa_id'];
				} 
				
			}
		$i++;
				
	}
		$data['user']=$profile;
		$this->load->view('v_submissionAntrian',$data);
	}
	public function lihatBerkas($userId){
		$userFiles = $this->http_request("http://localhost/serviceOJS/api/userFiles/".$userId);
		$metadata = $this->http_request("http://localhost/serviceOJS/api/metadata/".$userId);
		// ubah string JSON menjadi array
		$userFiles = json_decode($userFiles, TRUE);
		$metadata = json_decode($metadata, TRUE);
		$data['userFiles']=$userFiles;
		$data['user']=$metadata;
		$data['userApp']=$this->m_mahasiswa->getDataAuthor($userId)->result_array();

		$mahasiswa = $this->m_mahasiswa->getMahasiswa()->result_array();	
//
		$mahasiswa_id=0;
		foreach($userFiles as $a){
			$nama=$a['first_name'].' '.$a['middle_name'].''.$a['last_name'];
			$nama=str_replace(' ', '', $nama);
			foreach($mahasiswa as $b){
				$namaSiswa=$b['namaMahasiswa'];//dri filkomappp
				$namaSiswa=str_replace(' ', '', $namaSiswa);
				
				if(strtolower($nama) == strtolower($namaSiswa)){
					//echo $nama;
					$mahasiswa_id=$b['mahasiswa_id'];
				} 
				
			}
				
		}
		//print_r($mahasiswa_id);
		$data['berkasApp']=$this->m_mahasiswa->getDataMahasiswa($mahasiswa_id)->result_array();
		
		$this->load->view('v_berkas',$data);
	}

	public function alamatBerkas($fileId){
		$path = $this->http_request("http://localhost/serviceOJS/api/lihatFilesAsli/".$fileId);
		
		// ubah string JSON menjadi array
		$path = json_decode($path, TRUE);
		
		//return $path['alamat'];
		$data['path']=$path['alamat'];
		//print_r($data['path']);
		$this->load->view('v_tampilBerkas',$data);
	}
	public function alamatBerkasApp($namaBerkas){
				
		//return $path['alamat'];
		$data['path']= base_url()."assets/dataSkripsi/$namaBerkas.pdf";
		//print_r($data['path']);
		
		$this->load->view('v_tampilBerkas',$data);
	}
	public function centang(){
		$id= $this->input->post("id");
		$value= $this->input->post("value");
		$value= str_replace(' ', '', $value);
		if($value=="FormSC2-17"){
			$value="FormSC2_17";
		}
		if($value=="FormSC2-12"){
			$value="FormSC2_12";
		}
		$strState= $this->input->post("strState");
		$this->m_mahasiswa->set_centang($id,$value,$strState);
		//print_r($id);
	}
	public function submitIn(){
		$submission_id= $this->input->post("id");
		$author_id= $this->input->post("author_id");//dari filkomapp
		$user_id= $this->input->post("user_id");//dari ojs
		$date= date('Y-m-d H:i:s');
		//print_r($date);
		$data = array(
			'submission_id' => $submission_id,
			'user_group_id' => 20,
			'user_id' => 3,//editor id
			'date_assigned' => $date
			);	
			
		$userFiles = $this->http_request_post("http://localhost/serviceOJS/api/antrian/submitIn",$data);
		$dataSub = array(
			'submission_id' => $submission_id,
			'author_id' => $user_id
			);
		//print_r($dataSub);
		$this->m_mahasiswa->insertSubmission($author_id,$user_id,$dataSub);

		echo(json_decode($userFiles, TRUE));
		echo "{}";
	}
	public function cekComboBox(){
		$user_id= $this->input->post("id");
		//print_r($date);
		$combo=$this->m_mahasiswa->getDataAuthor($user_id)->result_array();
		$count=0;
		foreach($combo as $c){
			if($c['ArticleText']==1){
				$count++;
			}
			if($c['PerjanjianHakCipta']==1){
				$count++;
			}
			if($c['EtikaPublikasi']==1){
				$count++;
			}
			if($c['CekPlagiasidenganTurnitin']==1){
				$count++;
			}
			if($c['FormSC2_17']==1){
				$count++;
			}
			if($c['FormSC2_12']==1){
				$count++;
			}
		}
		if($count==6){
			echo "{}";
		}

	}
	public function verifikasi(){
		$user_id= $this->input->post("id");
		$date= date('Y-m-d H:i:s');
		//print_r($date);
		$data = array(
			'user_id' => $user_id,
			'editor_user_id' => 3,//editor id
			'date_assigned' => $date
			);	
			
		$userFiles = $this->http_request_post("http://localhost/serviceOJS/api/verifikasi",$data);
		echo(json_decode($userFiles, TRUE));
		echo "{}";
	}
	public function metadata(){
		$submission_id= $this->input->post("id");
		$judul= $this->input->post("judul");
		$subtitle= $this->input->post("subtitle");
		$abstract= $this->input->post("abstract");
		//print_r($date);
		$data = array(
			'submission_id' => $submission_id,
			'judul' => $judul,//editor id
			'subtitle' => $subtitle,
			'abstract' => $abstract
			);	
			
		$userFiles = $this->http_request_post("http://localhost/serviceOJS/api/setMetadata",$data);
		echo(json_decode($userFiles, TRUE));
		echo "{}";
	}
	public function tambahPenulis(){
		$submission_id= $this->input->post("id");
		$first_name= $this->input->post("first_name");
		$middle_name= $this->input->post("middle_name");
		$last_name= $this->input->post("last_name");
		$email= $this->input->post("email");
		$affiliation= $this->input->post("affiliation");
		//print_r($date);
		$data = array(
			'submission_id' => $submission_id,
			'first_name' => $first_name,
			'middle_name' => $middle_name,
			'last_name' => $last_name,
			'affiliation' => $affiliation,
			'email' => $email
			);	
			
		$userFiles = $this->http_request_post("http://localhost/serviceOJS/api/tambahPenulis",$data);
		echo(json_decode($userFiles, TRUE));
		echo "{}";
	}
	public function lihatPublication(){
		$profile = $this->http_request("http://localhost/serviceOJS/api/publication");
		
		// ubah string JSON menjadi array
		$profile = json_decode($profile, TRUE);
		
		$mahasiswa = $this->m_mahasiswa->getMahasiswa()->result_array();	
//print_r($profile);

		foreach($profile as $a){
			$nama=$a['first_name'].' '.$a['middle_name'].''.$a['last_name'];
			foreach($mahasiswa as $b){
				if(strtolower($nama) === strtolower($b['namaMahasiswa'])){
					//echo $b['namaMahasiswa'];
				} 
			}
			
				
	}
		$data['user']=$profile;
		$this->load->view('v_publication',$data);
	}
	public function lihatBerkasPublication($userId){
		$userFiles = $this->http_request("http://localhost/serviceOJS/api/userFiles/".$userId);
		$metadata = $this->http_request("http://localhost/serviceOJS/api/metadata/".$userId);
		// ubah string JSON menjadi array
		$userFiles = json_decode($userFiles, TRUE);
		$metadata = json_decode($metadata, TRUE);
		$data['userFiles']=$userFiles;
		$data['user']=$metadata;
		$data['userApp']=$this->m_mahasiswa->getDataAuthor($userId)->result_array();
		
		$this->load->view('v_berkasPublication',$data);
	}
	public function setPublication(){
		$user_id= $this->input->post("id");
		$date= date('Y-m-d H:i:s');
		//print_r($date);
		$data = array(
			'user_id' => $user_id,
			'editor_user_id' => 3,//editor id
			'date_assigned' => $date
			);	
			
		$userFiles = $this->http_request_post("http://localhost/serviceOJS/api/verifikasi",$data);
		echo(json_decode($userFiles, TRUE));
		echo "{}";
	}

	public function submitArsip(){
		echo $this->input->post("arsip");
		echo "{}";
	}
	
}
