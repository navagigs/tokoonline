<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_kasur extends CI_Model {

	public function all(){
		//query semua record di table kasur
		$hasil = $this->db->get('kasur');
		if($hasil->num_rows() > 0){
			return $hasil->result();
		} else {
			return array();
		}
	}
	
	public function find($kasur_id){
		//Query mencari record berdasarkan kasur_id-nya
		$hasil = $this->db->where('kasur_id', $kasur_id)
						  ->limit(1)
						  ->get('kasur');
		if($hasil->num_rows() > 0){
			return $hasil->row();
		} else {
			return array();
		}
	}
	
	public function create($data_kasur){
		//Query INSERT INTO
		$this->db->insert('kasur', $data_kasur);
	}

	public function update($kasur_id, $data_kasur){
		//Query UPDATE FROM ... WHERE kasur_id=...
		$this->db->where('kasur_id', $kasur_id)
				 ->update('kasur', $data_kasur);
	}
	
	public function delete($kasur_id){
		//Query DELETE ... WHERE kasur_id=...
		$this->db->where('kasur_id', $kasur_id)
				 ->delete('kasur');
	}
	
}