<?php
class M_admin extends CI_Model  {

    public function __contsruct(){
        parent::Model();
    }
	
    // ================================================== MENU UTAMA ================================================== //    
    // KONFIGURASI TABEL jenis
	public function insert_jenis($data){
        $this->db->insert("jenis",$data);
    }
    
    public function update_jenis($where,$data){
        $this->db->update("jenis",$data,$where);
    }

    public function delete_jenis($where){
        $this->db->delete("jenis", $where);
    }

	public function get_jenis($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("jenis");
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}

    public function grid_all_jenis($select, $sidx, $sord, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("jenis");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($sidx,$sord);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_jenis($where="", $like=""){
        $this->db->select("*");
        $this->db->from("jenis");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }

     // KONFIGURASI TABEL ukuran
    public function insert_ukuran($data){
        $this->db->insert("ukuran",$data);
    }
    
    public function update_ukuran($where,$data){
        $this->db->update("ukuran",$data,$where);
    }

    public function delete_ukuran($where){
        $this->db->delete("ukuran", $where);
    }

    public function get_ukuran($select, $where){
        $data = "";
        $this->db->select($select);
        $this->db->from("ukuran");
        $this->db->where($where);
        $this->db->limit(1);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data = $Q->row();
        }
        $Q->free_result();
        return $data;
    }

    public function grid_all_ukuran($select, $sidx, $sord, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("ukuran");
        if ($where){$this->db->where($where);}
        if ($like){
            foreach($like as $key => $value){ 
            $this->db->like($key, $value); 
            }
        }
        $this->db->order_by($sidx,$sord);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_ukuran($where="", $like=""){
        $this->db->select("*");
        $this->db->from("ukuran");
        if ($where){$this->db->where($where);}
        if ($like){
            foreach($like as $key => $value){ 
            $this->db->like($key, $value); 
            }
        }
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }
    
    
    //KONFIGURASI TABEL kasur
	public function insert_kasur($data){
        $this->db->insert("kasur",$data);
    }
    
    public function update_kasur($where,$data){
        $this->db->update("kasur",$data,$where);
    }
	
	public function update_hits_kasur($where){		
        $this->db->query("UPDATE kasur SET kasur_hits=kasur_hits+1 WHERE kasur_id=$where");
    }

    public function delete_kasur($where){
        $this->db->delete("kasur", $where);
    }

	public function get_kasur($select, $where){
        $data = "";
		$this->db->select($select);
        $this->db->from("kasur b");
		$this->db->join('jenis k', 'b.jenis_id= k.jenis_id', 'left');
        $this->db->join('ukuran u', 'b.ukuran_id= u.ukuran_id', 'left');
		$this->db->where($where);
		$this->db->limit(1);
		$Q = $this->db->get();
		if ($Q->num_rows() > 0){
			$data = $Q->row();
		}
		$Q->free_result();
		return $data;
	}
	 public function grid_all_kasur1($select, $sidx,$sord,$limit,$start,$where="", $like=""){
			$data = "";
			$this->db->select($select);
			$this->db->from("kasur b");
			$this->db->join('jenis k', 'b.jenis_id= k.jenis_id', 'left');
            $this->db->join('ukuran u', 'b.ukuran_id= u.ukuran_id', 'left');
			if ($where){$this->db->where($where);}
			if ($like){
				foreach($like as $key => $value){ 
				$this->db->like($key, $value); 
				}
			}
			$names = array('nava', 'pegawai');
			$this->db->where_not_in('pegawai_nama', $names);
			$this->db->order_by($sidx,$sord);
			$this->db->limit($limit,$start);
			$Q = $this->db->get();
			if ($Q->num_rows() > 0){
				$data=$Q->result();
			}
			$Q->free_result();
			return $data;
		}
		
    public function grid_all_kasur($select, $sidx,$sord,$limit,$start,$where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("kasur b");
		$this->db->join('jenis k', 'b.jenis_id= k.jenis_id', 'left');
        $this->db->join('ukuran u', 'b.ukuran_id= u.ukuran_id', 'left');
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $this->db->order_by($sidx,$sord);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_kasur($where="", $like=""){
        $this->db->select("*");
        $this->db->from("kasur b");
		$this->db->join('jenis k', 'b.jenis_id= k.jenis_id', 'left');
        $this->db->join('ukuran u', 'b.ukuran_id= u.ukuran_id', 'left');
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }
        public function grid_all_kasur2($select, $sidx,$sord,$limit,$start,$where="", $like=""){
        $data = "1";
        $this->db->select($select);
        $this->db->from("kasur");
		if ($where){$this->db->where($where);}
        $this->db->order_by($sidx,"ASC");
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_kasur2($where="", $like=""){
        $this->db->select("*");
        $this->db->from("kasur");
		if ($where){$this->db->where($where);}
		if ($like){
			foreach($like as $key => $value){ 
			$this->db->like($key, $value); 
			}
		}
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }
	

     //KONFIGURASI TABEL Pelanggan
    public function insert_pelanggan($data){
        $this->db->insert("pelanggan",$data);
    }
    
    public function update_pelanggan($where,$data){
        $this->db->update("pelanggan",$data,$where);
    }
    
    public function delete_pelanggan($where){
        $this->db->delete("pelanggan", $where);
    }

    public function get_pelanggan($select, $where){
        $data = "";
        $this->db->select($select);
        $this->db->from("pelanggan p");
        $this->db->where($where);
        $this->db->limit(1);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data = $Q->row();
        }
        $Q->free_result();
        return $data;
    }
    public function grid_all_pelanggan($select, $sidx, $sord, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("pelanggan");
        if ($where){$this->db->where($where);}
        if ($like){
            foreach($like as $key => $value){ 
            $this->db->like($key, $value); 
            }
        }
        $this->db->order_by($sidx,$sord);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
   
        }
        
    public function count_all_pelanggan($where="", $like=""){
        $this->db->select("*");
        $this->db->from("pelanggan");
        if ($where){$this->db->where($where);}
        if ($like){
            foreach($like as $key => $value){ 
            $this->db->like($key, $value); 
            }
        }
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }
    

	//CONFIGURATION TABLE pegawai
 // KONFIGURASI TABEL pegawai
    public function insert_pegawai($data){
        $this->db->insert("pegawai",$data);
    }
    
    public function update_pegawai($where,$data){
        $this->db->update("pegawai",$data,$where);
    }

    public function delete_pegawai($where){
        $this->db->delete("pegawai", $where);
    }

    public function get_pegawai($select, $where){
        $data = "";
        $this->db->select($select);
        $this->db->from("pegawai");
        $this->db->where($where);
        $this->db->limit(1);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data = $Q->row();
        }
        $Q->free_result();
        return $data;
    }

    public function grid_all_pegawai($select, $sidx, $sord, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("pegawai");
        if ($where){$this->db->where($where);}
        if ($like){
            foreach($like as $key => $value){ 
            $this->db->like($key, $value); 
            }
        }
        $this->db->order_by($sidx,$sord);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_pegawai($where="", $like=""){
        $this->db->select("*");
        $this->db->from("pegawai");
        if ($where){$this->db->where($where);}
        if ($like){
            foreach($like as $key => $value){ 
            $this->db->like($key, $value); 
            }
        }
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }

      // KONFIGURASI TABEL invoices
    public function insert_invoices($data){
        $this->db->insert("invoices",$data);
    }
    
    public function update_invoices($where,$data){
        $this->db->update("invoices",$data,$where);
    }

    public function delete_invoices($where){
        $this->db->delete("invoices", $where);
    }

    public function get_invoices($select, $where){
        $data = "";
        $this->db->select($select);
        $this->db->from("invoices s");
        $this->db->join('pelanggan p', 's.pelanggan_username= p.pelanggan_username', 'left');
        $this->db->where($where);
        $this->db->limit(1);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data = $Q->row();
        }
        $Q->free_result();
        return $data;
    }

    public function grid_all_invoices($select, $sidx, $sord, $limit, $start, $where="", $like=""){
        $data = "";
        $this->db->select($select);
        $this->db->from("invoices s");
        $this->db->join('pelanggan p', 's.pelanggan_username= p.pelanggan_username', 'left');
        if ($where){$this->db->where($where);}
        if ($like){
            foreach($like as $key => $value){ 
            $this->db->like($key, $value); 
            }
        }
        $this->db->order_by($sidx,$sord);
        $this->db->limit($limit,$start);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0){
            $data=$Q->result();
        }
        $Q->free_result();
        return $data;
    }

    public function count_all_invoices($where="", $like=""){
        $this->db->select("*");
        $this->db->from("invoices");
        if ($where){$this->db->where($where);}
        if ($like){
            foreach($like as $key => $value){ 
            $this->db->like($key, $value); 
            }
        }
        $Q=$this->db->get();
        $data = $Q->num_rows();
        return $data;
    }


    // CONFIGURATION COMBO BOX WITH DATABASE WITH VALIDASI
	public function combo_box($table, $name, $value, $name_value, $pilihan, $js='', $label='', $width=''){
		echo "<select name='$name' id='$name' onchange='$js' required class='form-control input-sm' style='width:$width'>";
		echo "<option value=''>".$label."</option>";
		$query = $this->db->query($table);
		foreach ($query->result() as $row){
			if ($pilihan == $row->$value){
				echo "<option value='".$row->$value."' selected>".$row->$name_value."</option>";
			} else {
				echo "<option value='".$row->$value."'>".$row->$name_value."</option>";
			}
		}
		echo "</select>";
	}
    
    // CONFIGURATION COMBO BOX WITH DATABASE NO VALIDASI
	public function combo_box2($table, $name, $value, $name_value, $pilihan, $js='', $label='', $width=''){
		echo "<select name='$name' id='$name' onchange='$js' class='form-control input-sm' style='width:$width'>";
		echo "<option value=''>".$label."</option>";
		$query = $this->db->query($table);
		foreach ($query->result() as $row){
			if ($pilihan == $row->$value){
				echo "<option value='".$row->$value."' selected>".$row->$name_value."</option>";
			} else {
				echo "<option value='".$row->$value."'>".$row->$name_value."</option>";
			}
		}
		echo "</select>";
	}
	
	//CONFIGURATION CHECKBOX ARRAY WITH DATABASE
	public function checkbox($table, $name, $value, $name_value, $pilihan=''){
		$query = $this->db->query($table);
		$array_tag = explode(',', $pilihan);
		$ceked = "";
		foreach ($query->result() as $row){
			$ceked = (array_search($row->tag_id, $array_tag) === false)? '' : 'checked';
			echo "<label for='".$row->$value."'><input type='checkbox' class='icheck' name='$name' id='".$row->$value."' value='".$row->$value."' ".$ceked."/> ".$row->$name_value."</label> ";
		}
	}
	
	//CONFIGURATION CHECKBOX ARRAY WITH DATABASE
	public function checkbox_status($table, $name, $value, $name_value, $pilihan=''){
		$query = $this->db->query($table);
		$array_tag = explode(',', $pilihan);
		$ceked = "";
		foreach ($query->result() as $row){
			$ceked = (array_search($row->status_perkawinan_kode, $array_tag) === false)? '' : 'checked';
			echo "<input type='checkbox' name='$name' id='".$row->$value."' style='display: inline-block;' value='".$row->$value."' ".$ceked."/><label for='".$row->$value."' style='display: inline-block; margin-right: 10px;'>".$row->$name_value."</label>";
		}
	}
	
	//CONFIGURATION LIST ARRAY WITH DATABASE AND EXPLODE
	public function listarray($table, $name, $value, $name_value, $pilihan=''){
		$query = $this->db->query($table);
		$array_tag = explode(',', $pilihan);
		$ceked = "";
		foreach ($query->result() as $row){
			if (array_search($row->tag_id, $array_tag) === false) {
			} else {
			echo $row->$name_value.", ";
			}
		}
	}
	
	//CONFIGURATION LIST ARRAY WITH DATABASE AND EXPLODE
	public function tagskasur($table, $name, $value, $name_value, $pilihan=''){
		$query = $this->db->query($table);
		$array_tag = explode(',', $pilihan);
		$ceked = "";
		foreach ($query->result() as $row){
			if (array_search($row->tag_id, $array_tag) === false) {
			} else {
			echo "<a href='".site_url()."news/tags/".$row->tag_id."' class='tag'>".$row->$name_value."</a> ";
			}
		}
	}
}