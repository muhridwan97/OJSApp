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
		$editor_id = $this->session->userdata("user_id");
		$profile = $this->http_request("http://localhost/serviceOJS/api/userSubmit/".$editor_id);
		$issue = $this->http_request("http://localhost/serviceOJS/api/publicationIssue");
		// ubah string JSON menjadi array
		$profile = json_decode($profile, TRUE);
		$issue = json_decode($issue, TRUE);
		
		//$mahasiswa = $this->m_mahasiswa->getMahasiswa()->result_array();	
//print_r($profile);
		$i=0;
	 	foreach($profile as $a){
			$mahasiswa=$this->m_mahasiswa->getMahasiswaById($a['user_id'])->result_array();
			$note=$this->m_mahasiswa->getDataAuthor($a['user_id'])->result_array();
			//print_r($mahasiswa);
			foreach($mahasiswa as $b){
			$profile[$i]['statusSkripsi']=$b['status'];
			}
			$onProgress=0;
			foreach($note as $b){
				$profile[$i]['catatan']=$b['catatan'];
				if($b['ArticleText']==1){
					$onProgress++;
				}
				if($b['PerjanjianHakCipta']==1){
					$onProgress++;
				}
				if($b['EtikaPublikasi']==1){
					$onProgress++;
				}
				if($b['CekPlagiasidenganTurnitin']==1){
					$onProgress++;
				}
				if($b['FormSC2_17']==1){
					$onProgress++;
				}
				if($b['FormSC2_12']==1){
					$onProgress++;
				}
				if($onProgress==0){
					$profile[$i]['onProgress']=0;
				}else{
					$profile[$i]['onProgress']=1;
				}
				}
		$i++;
	 	}
		//print_r($profile);
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
	function http_request_postFile($url,$post){
		// persiapkan curl
		$ch = curl_init(); 
		print_r($post);
		//$post = http_build_query($post);
		//$cfile = new CURLFile('cats.jpg','image/jpeg','test_name');
		//$file = curl_file_create($post);
		// Assign POST data
		//$data = array('fileArsip' => $file);
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
		$this->load->model('m_settings');
		$waktu = $this->m_settings->getWaktuTenggang()->result_array();
//print_r($profile);
		$i=0;
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
					$profile[$i]['author_id']=$b['mahasiswa_id'];
					$profile[$i]['tanggalSelesai']=$b['tanggalSelesai'];
					$start_date = new DateTime($b['tanggalSelesai']);
					$end_date = new DateTime($profile[$i]['date_submitted']);
					$interval = $start_date->diff($end_date);
					
					if($interval->days<=$waktu[0]['waktuTenggang']){
						$profile[$i]['waktu']=1;
					}else{
						$profile[$i]['waktu']=0;
					}
				} 
				
			}
		$i++;
				
	}
		$data['user']=$profile;
		// print_r($waktu[0]['waktuTenggang']);
		//print_r($data);
		$this->load->view('v_submissionAntrian',$data);
	}
	public function lihatBerkas($userId){
		$userFiles = $this->http_request("http://localhost/serviceOJS/api/userFiles/".$userId);
		$metadata = $this->http_request("http://localhost/serviceOJS/api/metadata/".$userId);
		$keyword = $this->http_request("http://localhost/serviceOJS/api/keyword/".$userId);
		$keywordInd = $this->http_request("http://localhost/serviceOJS/api/keywordInd/".$userId);
		// ubah string JSON menjadi array
		$userFiles = json_decode($userFiles, TRUE);
		$metadata = json_decode($metadata, TRUE);
		$keyword = json_decode($keyword, TRUE);
		$keywordInd = json_decode($keywordInd, TRUE);

		$data['userFiles']=$userFiles;
		$data['user']=$metadata;
		$data['keyword']=$keyword;
		$data['keywordInd']=$keywordInd;
		$data['userApp']=$this->m_mahasiswa->getDataAuthor($userId)->result_array();
		$data['tahapSkripsi']=$this->m_mahasiswa->getTahapSkripsi($userId)->result_array();
		 foreach($userFiles as $a){
				
		 }$mahasiswa_id= $a['uploader_user_id'];
		//print_r($mahasiswa_id);
		$data['berkasApp']=$this->m_mahasiswa->getDataMahasiswa($mahasiswa_id)->result_array();
		
		$this->load->view('v_berkas',$data);
	}
	public function reloadPenulis(){
		$userId= $this->input->post("userId");
		$user = $this->http_request("http://localhost/serviceOJS/api/metadata/".$userId);
		$user = json_decode($user, TRUE);

		$i=0;
		$submission_id=0;
		$author_id=0;
		if( !empty($user) ) {
        foreach($user as $u){
            $i++;
			$submission_id=$u['seq'];
			$author_id=$u['author_id'];
			// $hasil="";
				
		// $hasil.= "<tr class='author$author_id' data-id='$submission_id'>";
		// $hasil.="<td > $i</td>";
		// $hasil.="<td>".$u['first_name']." ".$u['middle_name']." ".$u['last_name']."</td>";
		// $hasil.="<td>".$u['email']."</td>";
		// $hasil.='<td>
		// <a data-author_id="'.$u['author_id'].'" data-first_name="'.$u['first_name'].'" data-middle_name="'.$u['middle_name'].'"
		// data-last_name="'.$u['last_name'].'" data-email="'.$u['email'].'" data-toggle="modal" data-target="#myModalEdit" type="button" 
		// class="btn btn-info btn-flat cekEdit"><i data-toggle="tooltip" data-placement="top" data-original-title="Edit" class="fa fa-edit"></i></a>
		// <a data-toggle="modal" data-target="#myModal" class="btn btn-danger btn-flat cek"><i data-toggle="tooltip" data-placement="top" data-original-title="Hapus" class="fa fa-close"  ></i></a>
        //           </td>
        //         </tr>';
		
		// echo $hasil;
		
		}echo $author_id;
	}else{
		echo $userId;
	}
	}

	public function reloadPenulisEdit(){
		$userId= $this->input->post("userId");
		$author_id= $this->input->post("author_id");
		$user = $this->http_request("http://localhost/serviceOJS/api/metadata/".$userId);
		$user = json_decode($user, TRUE);

		$i=0;
		$submission_id=0;
		if( !empty($user) ) {
        foreach($user as $u){
            $i++;
			$submission_id=$u['seq'];
			$hasil="";
			if($u['author_id']==$author_id){
				
		//$hasil.= "<tr data-id='$submission_id'>";
		$hasil.="<td > $i</td>";
		$hasil.="<td>".$u['first_name']." ".$u['middle_name']." ".$u['last_name']."</td>";
		$hasil.="<td>".$u['email']."</td>";
		$hasil.='<td>
		<a data-author_id="'.$u['author_id'].'" data-first_name="'.$u['first_name'].'" data-middle_name="'.$u['middle_name'].'"
		data-last_name="'.$u['last_name'].'" data-email="'.$u['email'].'" data-toggle="modal" data-target="#myModalEdit" type="button" 
		class="btn btn-info btn-flat cekEdit"><i data-toggle="tooltip" data-placement="top" data-original-title="Edit" class="fa fa-edit"></i></a>
		<a data-toggle="modal" data-target="#myModal" class="btn btn-danger btn-flat cek"><i data-toggle="tooltip" data-placement="top" data-original-title="Hapus" class="fa fa-close"  ></i></a>
                  </td>
                </tr>';
			}
		
		echo $hasil;

		}
	}else{
		echo $userId;
	}
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
	public function alamatBerkasOJS(){
		$fileId = $this->input->post("fileId");
		$path = $this->http_request("http://localhost/serviceOJS/api/lihatFilesAsli/".$fileId);
		
		// ubah string JSON menjadi array
		$path = json_decode($path, TRUE);
		
		echo $path['alamat'];
		// $data['path']=$path['alamat'];
		// print_r($path);
		// $this->load->view('v_tampilBerkas',$data);
	}
	public function alamatBerkasPubOJS(){
		$fileId = $this->input->post("fileId");
		$path = $this->http_request("http://localhost/serviceOJS/api/lihatFilesAsliPub/".$fileId);
		
		// ubah string JSON menjadi array
		$path = json_decode($path, TRUE);
		
		echo $path['alamat'];
	}
	public function alamatBerkasArsipOJS(){
		$fileId = $this->input->post("fileId");
		$path = $this->http_request("http://localhost/serviceOJS/api/lihatFilesAsliArsip/".$fileId);
		
		// ubah string JSON menjadi array
		$path = json_decode($path, TRUE);
		
		echo $path['alamat'];
	}
	public function alamatBerkasApp(){
		$namaBerkas = $this->input->post("fileId");
		//return $path['alamat'];
		// $data['path']= base_url()."assets/dataSkripsi/$namaBerkas.pdf";
		//print_r($data['path']);
		echo base_url()."assets/dataSkripsi/$namaBerkas.pdf";
		// $this->load->view('v_tampilBerkas',$data);
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
	public function catatan(){
		$id= $this->input->post("id");
		$pesan= $this->input->post("pesan");
		$this->m_mahasiswa->set_catatan($id,$pesan);
		echo "{}";
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
			'user_id' => $this->session->userdata("user_id"),//editor id
			'date_assigned' => $date
			);	
			
		$userFiles = $this->http_request_post("http://localhost/serviceOJS/api/antrian/submitIn",$data);
		$dataSub = array(
			'submission_id' => $submission_id,
			'author_id' => $user_id
			);
		//print_r($dataSub);
		$insert = $this->m_mahasiswa->getDataAuthor($user_id)->result();
		//print_r(count($insert));
		if(count($insert)>0){
			$this->m_mahasiswa->updateSubmission($submission_id,$user_id);
		}else{
			$temp = $this->m_mahasiswa->getDataAuthorMahasiswa($user_id)->result();
			if(count($temp)>0){
				$this->m_mahasiswa->insertSubmissionSwap($author_id,$user_id,$dataSub);
			}else{
				$this->m_mahasiswa->insertSubmission($author_id,$user_id,$dataSub);
			}
		}
		//echo(json_decode($userFiles, TRUE));
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
			'editor_user_id' => $this->session->userdata("user_id"),//editor id
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
		$abstract2= $this->input->post("abstract2");
		$keyword= $this->input->post("keyword");
		$keywordInd= $this->input->post("keywordInd");
		//print_r($date);
		$data = array(
			'submission_id' => $submission_id,
			'judul' => $judul,//editor id
			'subtitle' => $subtitle,
			'abstract' => $abstract,
			'abstract2' => $abstract2  ,
			'keyword' => $keyword,
			'keywordInd' => $keywordInd
			);	
			
		$userFiles = $this->http_request_post("http://localhost/serviceOJS/api/setMetadata",$data);
		echo(json_decode($userFiles, TRUE));
		echo "{}";
	}
	public function decline(){
		$user_id= $this->input->post("id");
		//print_r($date);
		$data = array(
			'user_id' => $user_id
			);	
			
		$userFiles = $this->http_request_post("http://localhost/serviceOJS/api/decline",$data);
		$this->m_mahasiswa->setRevisi($user_id);
		echo "{}";
	}
	public function declineAntrian(){
		$user_id= $this->input->post("id");
		//print_r($date);
		$data = array(
			'user_id' => $user_id
			);	
			
		$userFiles = $this->http_request_post("http://localhost/serviceOJS/api/decline",$data);
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
	public function editPenulis(){
		$author_id= $this->input->post("author_id");
		$first_name= $this->input->post("first_name");
		$middle_name= $this->input->post("middle_name");
		$last_name= $this->input->post("last_name");
		$email= $this->input->post("email");
		$affiliation= $this->input->post("affiliation");
		//print_r($date);
		$data = array(
			'author_id' => $author_id,
			'first_name' => $first_name,
			'middle_name' => $middle_name,
			'last_name' => $last_name,
			'affiliation' => $affiliation,
			'email' => $email
			);	
			
		$userFiles = $this->http_request_post("http://localhost/serviceOJS/api/editPenulis",$data);
		echo(json_decode($userFiles, TRUE));
		echo "{}";
	}
	public function hapusPenulis(){
		$author_id= $this->input->post("author_id");
		//print_r($date);
		$data = array(
			'author_id' => $author_id,
			);	
			
		$userFiles = $this->http_request_post("http://localhost/serviceOJS/api/hapusPenulis",$data);
		echo(json_decode($userFiles, TRUE));
		echo "{}";
	}
	public function lihatPublication(){
		$profile = $this->http_request("http://localhost/serviceOJS/api/publication");
		
		// ubah string JSON menjadi array
		$profile = json_decode($profile, TRUE);
		
		$mahasiswa = $this->m_mahasiswa->getMahasiswa()->result_array();	
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
		$this->load->view('v_publication',$data);
	}
	public function lihatBerkasPublication($userId){
		$userFiles = $this->http_request("http://localhost/serviceOJS/api/userFiles/".$userId);
		$metadata = $this->http_request("http://localhost/serviceOJS/api/metadata/".$userId);
		$keyword = $this->http_request("http://localhost/serviceOJS/api/keyword/".$userId);
		$keywordInd = $this->http_request("http://localhost/serviceOJS/api/keywordInd/".$userId);
		$userFilesPub = $this->http_request("http://localhost/serviceOJS/api/userFilesPub/".$userId);
		$userFilesArsip = $this->http_request("http://localhost/serviceOJS/api/userFilesArsip/".$userId);
		// ubah string JSON menjadi array
		$userFiles = json_decode($userFiles, TRUE);
		$metadata = json_decode($metadata, TRUE);
		$keyword = json_decode($keyword, TRUE);
		$keywordInd = json_decode($keywordInd, TRUE);
		$userFilesPub = json_decode($userFilesPub, TRUE);
		$userFilesArsip = json_decode($userFilesArsip, TRUE);

		$data['userFiles']=$userFiles;
		$data['userFilesPub']=$userFilesPub;
		$data['userFilesArsip']=$userFilesArsip;
		$data['user']=$metadata;
		$data['keyword']=$keyword;
		$data['keywordInd']=$keywordInd;
		$data['userApp']=$this->m_mahasiswa->getDataAuthor($userId)->result_array();
		$data['tahapSkripsi']=$this->m_mahasiswa->getTahapSkripsi($userId)->result_array();
		 foreach($userFiles as $a){
				
		 }$mahasiswa_id= $a['uploader_user_id'];
		//print_r($mahasiswa_id);
		$data['berkasApp']=$this->m_mahasiswa->getDataMahasiswa($mahasiswa_id)->result_array();

		// $userFiles = $this->http_request("http://localhost/serviceOJS/api/userFiles/".$userId);
		// $metadata = $this->http_request("http://localhost/serviceOJS/api/metadata/".$userId);
		// // ubah string JSON menjadi array
		// $userFiles = json_decode($userFiles, TRUE);
		// $metadata = json_decode($metadata, TRUE);
		// $data['userFiles']=$userFiles;
		// $data['user']=$metadata;
		// $data['userApp']=$this->m_mahasiswa->getDataAuthor($userId)->result_array();
		
		$this->load->view('v_berkasPublication',$data);
	}

	public function getPage(){
		$issueId= $this->input->post("issueId");			
		$page = $this->http_request("http://localhost/serviceOJS/api/getPage/".$issueId);
		$page=json_decode($page, TRUE);
		$pages=0;
		if(count($page)>0){
		foreach($page as $a){
		}$pages= $a['pages'];}
		//echo "<input type='text' class='form-control' id='page' value='' name='page' placeholder='$pages'>";
		echo "$pages";
	}

	public function setPublication(){
		$user_id= $this->input->post("id");
		$issue_id= $this->input->post("issue_id");
		$page= $this->input->post("page");
		$tahun= $this->input->post("tahun");
		$date= date('Y-m-d H:i:s');
		
		$data = array(
			'user_id' => $user_id,
			'editor_user_id' => $this->session->userdata("user_id"),//editor id
			'date' => $date,
			'issue_id' => $issue_id,
			'page' => $page,
			'tahun' => $tahun
			);	
			// print_r($data);
		 $userFiles = $this->http_request_post("http://localhost/serviceOJS/api/setPublication",$data);
		// echo(json_decode($userFiles, TRUE));
		echo "{}";
	}

	public function submitArsip(){
		//$fileArsip= $_FILES['fileArsip'];
		$fileArsip= realpath($_FILES["fileArsip"]["tmp_name"]);
		$type = $_FILES['fileArsip']['type'];
		$name = $_FILES['fileArsip']['name'];
		$submission_id=$_POST['submission_id'];
		$editor_id=$_POST['editor_id'];
		//print_r($fileArsip);
		//return $fileArsip;
		$fields = [
				'fileArsip' => new \CurlFile($fileArsip, $type, $name),
				'submission_id' => $submission_id,
				'name' => $name,
				'type' => $type,
				'editor_id' => $editor_id
		];
		$userFiles = $this->http_request_postFile("http://localhost/serviceOJS/api/uploadArsip",$fields);
		//print_r ($type);
		//print_r($fileArsip);
		echo "{}";
	}

	public function submitGalley(){
		//$fileArsip= $_FILES['fileArsip'];
		$fileGalley= realpath($_FILES["fileGalley"]["tmp_name"]);
		$type = $_FILES['fileGalley']['type'];
		$name = $_FILES['fileGalley']['name'];
		$submission_id=$_POST['submission_id'];
		$editor_id=$_POST['editor_id'];
		//print_r($fileArsip);
		//return $fileArsip;	
		$fields = [
				'fileGalley' => new \CurlFile($fileGalley, $type, $name),
				'submission_id' => $submission_id,
				'name' => $name,
				'type' => $type,
				'editor_id' => $editor_id
		];
		$userFiles = $this->http_request_postFile("http://localhost/serviceOJS/api/uploadGalley",$fields);
		//print_r ($type);
		//print_r($fileArsip);
		echo "{}";
	}
	public function submitGalleyEdit(){
		$fileGalley= realpath($_FILES["fileGalley"]["tmp_name"]);
		$type = $_FILES['fileGalley']['type'];
		$name = $_FILES['fileGalley']['name'];
		$submission_id=$_POST['submission_id'];
		$editor_id=$_POST['editor_id'];
		$submission_id=(int)$submission_id;
		$editor_id=(int)$editor_id;
		 //print_r($fileGalley);
		//return $fileArsip;	
		$fields = [
				'fileGalley' => new \CurlFile($fileGalley, $type, $name),
				'submission_id' => $submission_id,
				'name' => $name,
				'type' => $type,
				'editor_id' => $editor_id
		];
		$userFiles = $this->http_request_postFile("http://localhost/serviceOJS/api/uploadGalleyEdit",$fields);
		//print_r ($type);
		//print_r($fields);
		echo "{}";
	}
	public function submitArsipEdit(){
		//$fileArsip= $_FILES['fileArsip'];
		$submission_id=$_POST['submission_id'];
		$editor_id=$_POST['editor_id'];
		$fileArsip= realpath($_FILES["fileArsip"]["tmp_name"]);
		$type = $_FILES['fileArsip']['type'];
		$name = $_FILES['fileArsip']['name'];
		$submission_id=(int)$submission_id;
		$editor_id=(int)$editor_id;
		// $submission_id= $this->input->post("submission_id");
		// $editor_id= $this->input->post("editor_id");
		// print_r( $_FILES);
		//return $fileArsip;
		$fields = [
				'fileArsip' => new \CurlFile($fileArsip, $type, $name),
				'submission_id' => $submission_id,
				'name' => $name,
				'type' => $type,
				'editor_id' => $editor_id
		];
		$userFiles = $this->http_request_postFile("http://localhost/serviceOJS/api/uploadArsipEdit",$fields);
		//print_r ($type);
		print_r($userFiles);
		echo "{}";
	}

	public function send_email(){
		$user_id= $this->input->post("id");
		$pesan= $this->input->post("pesan");
		$option= $this->input->post("option");
		$emailTujuan= array();
		$getEmail = $this->http_request("http://localhost/serviceOJS/api/getEmail/".$user_id);
		// ubah string JSON menjadi array
		$getEmail = json_decode($getEmail, TRUE);
		if($option==1){//buat pilihan
			$i=0;			
		foreach($getEmail as $g){
			$emailTujuan[$i]="";
			if($g['primary_contact']==1){
			$emailTujuan[$i]=$g['email'];}
			$i++;
		}
		}else{
			$i=0;
			foreach($getEmail as $g){
				$emailTujuan[$i]=$g['email'];
				$i++;
			}
		}
		// Konfigurasi email
        $config = [
			'mailtype'  => 'html',
			'charset'   => 'iso-8859-1',
			'protocol'  => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'muh.ridwan97@gmail.com',    // Ganti dengan email gmail kamu
			'smtp_pass' => '04013194385',      // Password gmail kamu
			'smtp_port' => 465,
			'wordwrap'   => TRUE
		];

	 // Load library email dan konfigurasinya
	 $this->load->library('email', $config);
	 $this->email->set_newline("\r\n");  

	 // Email dan nama pengirim
	 $this->email->from('muh.ridwan97@gmail.com', 'Muhammad Ridwan');

	 // Email penerima
	//  print_r($emailTujuan[0]);
	//  print_r($emailTujuan[1]);
	//  print_r($emailTujuan[2]);
	if ($option==1){
	 $this->email->to($emailTujuan[0]); // Ganti dengan email tujuan kamu
	}else{
		$this->email->to($emailTujuan); // Ganti dengan email tujuan kamu
	}
	 // Lampiran email, isi dengan url/path file
	 //$this->email->attach('https://masrud.com/content/images/20181215150137-codeigniter-smtp-gmail.png');

	 // Subject email
	 $this->email->subject('Coba kirim email pke OJSApp');

	 // Isi email
	 $this->email->message($pesan);

	 // Tampilkan pesan sukses atau error
	 if ($this->email->send()) {
		 echo '{}';
	 } else {
		show_error($this->email->print_debugger()); 
	 }
	
	}
	
	
}
