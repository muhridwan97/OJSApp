<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index()
	{
		$data = $this->mymodel->getMahasiswa();
		foreach ($data as $key ) {
			echo "nama : ".$key['nama']."<br/>";
		}
	}

	public function insert(){
		$data=$this->mymodel->insertData('mahasiswa',array(
			"nim" => "131315",
			"nama" => "rosid",
			"alamat" => "bantul" 
		));
		if ($data >= 1) {
			echo "<h2>insert data berhasil</h2>";
		}
		else{
			echo "<h2>insert data gagal</h2>";
		}
	}
	public function delete(){
		$data=$this->mymodel->deleteData('mahasiswa',array("nim" => "1313154"));
		if ($data >= 1) {
			echo "<h2>delete data berhasil</h2>";
		}
		else{
			echo "<h2>delete data gagal</h2>";
		}
	}
	public function update(){
		$data=$this->mymodel->updateData('mahasiswa',array(
			"nama" => "azizah"),array("nim" => "131315"));
		if ($data >= 1) {
			echo "<h2>update data berhasil</h2>";
		}
		else{
			echo "<h2>update data gagal</h2>";
		}
	}
	public function home(){
		$this->load->view('home');
	}
}
