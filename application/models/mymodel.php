<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mymodel extends CI_Model {
	public function getMahasiswa(){
		$data = $this->db->query('select * from mahasiswa');
		return $data->result_array();
	}
	public function insertData($tabelNama,$data){
		$data = $this->db->insert($tabelNama,$data);
		return $data;

	}
	public function updateData($tabelNama,$data,$where){
		$data = $this->db->update($tabelNama,$data,$where);
		return $data;
	}
	public function deleteData($tabelNama,$where){
		$data = $this->db->delete($tabelNama,$where);
		return $data;
	}
}
