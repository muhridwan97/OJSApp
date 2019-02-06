<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_settings extends CI_Model {
	public function getWaktuTenggang(){
		return $this->db->get('settings');
    }
    public function setWaktuTenggang($hari){
        $this->db->set('waktuTenggang', $hari);
		$this->db->where('settings_id', '1');
		$this->db->update('settings');
	}
}
