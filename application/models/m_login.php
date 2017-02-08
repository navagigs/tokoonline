<?php
class M_login extends CI_Model {
	
	function __contsruct(){
		parent::Model();
	}
	
	function cek_login($where){
		$data = "";
		$this->db->select("*");
		$this->db->from("pegawai");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0) {
			$data = $Q->row();
			$this->set_session($data);
			return true;
		}
		return false;
	}
	
	function set_session(&$data){
		$session = array(
					'pegawai_username' 	=> $data->pegawai_username,
					'pegawai_username' 	=> $data->pegawai_username,
					'pegawai_nama' 	=> $data->pegawai_nama,
					'pegawai_level' 	=> $data->pegawai_level,
					'logged_in'		=> TRUE
					);
		$this->session->set_userdata($session);
	}
	
	function update_log($where){
		$where['pegawai_username'] = $data->pegawai_username;
		$where['pegawai_nama'] = $data->pegawai_nama;
		$this->db->update('pegawai',$data,$where);
	}
	
	function remov_session() {
		$session = array(
					'pegawai_username'  =>'',
					'pegawai_level' =>'',
					'logged_in'	  => FALSE
					);
		$this->session->unset_userdata($session);
	}
		
	
}