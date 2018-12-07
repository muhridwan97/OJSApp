<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_mahasiswa extends CI_Model {
	public function getMahasiswa(){
		return $this->db->get('mahasiswa');
	}
	public function getDataAuthor($id){
		$this->db->where('author_id',$id);
		return $this->db->get('submission');
	}
	public function getTugas(){
		return $this->db->get('tugas');
	}
	public function getSoal($id){
		$this->db->where('tugas_id',$id);
		return $this->db->get('soal');
	}
	public function tambahTugas(){
		$this->db->insert("tugas",array("tugas_nama"=>""));
		return $this->db->insert_id();
	}
	public function set_centang($id,$value,$strState){
		$this->db->set($value, $strState);
		$this->db->where('author_id', $id);
		$this->db->update('submission');
	}
}
