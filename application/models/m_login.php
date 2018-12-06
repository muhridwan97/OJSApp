<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_login extends CI_Model {
	public function getMahasiswaAuth($nim,$password){
		$this->db->where('mahasiswa_nim', $nim);
		$this->db->where('mahasiswa_password', $password);
		return $this->db->get('mahasiswa');
	
	}
	public function getDosenAuth($nip,$password){
		$this->db->where('dosen_nip', $nip);
		$this->db->where('dosen_password', $password);
		return $this->db->get('dosen');
	
	}
}
