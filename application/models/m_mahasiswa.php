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
	public function set_centang($id,$value,$strState){
		$this->db->set($value, $strState);
		$this->db->where('author_id', $id);
		$this->db->update('submission');
	}
	public function insertSubmission($author_id,$user_id,$dataSub){
		$this->db->set('mahasiswa_id', $user_id);
		$this->db->where('mahasiswa_id', $author_id);
		$this->db->update('mahasiswa');

		$this->db->insert('submission',$dataSub);
		return 1;
	}


	public function getDataMahasiswa($mahasiswa_id){
		$this->db->select('*');
		$this->db->from('mahasiswa');
		$this->db->join('berkas', 'mahasiswa_id = id_pemilik');
		$this->db->where('mahasiswa_id', $mahasiswa_id);
		return $this->db->get();
	}

}
