<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Admin extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_admin', 'ADM', TRUE);
		$this->load->model('M_config', 'CONF', TRUE);
	}
	
	public function index()
	{
		if($this->session->userdata('logged_in') == TRUE){
			$where_pegawai['pegawai_username']		= $this->session->userdata('pegawai_username');
			$data['pegawai']					= $this->ADM->get_pegawai('',$where_pegawai);
			$data['dashboard_info']			= TRUE;
            $data['breadcrumb']             = 'Dashboard';
			$data['dashboard']				= 'admin/dashboard/statistik';
			$data['content']				= 'admin/dashboard/statistik';
			$data['jml_data_kasur']			= $this->ADM->count_all_kasur('');
			$data['jml_data_jenis']			= $this->ADM->count_all_jenis('');
			$data['jml_data_pegawai']		= $this->ADM->count_all_pegawai('');
			$data['jml_data_invoices']		= $this->ADM->count_all_invoices('');
			$this->load->vars($data);
			$this->load->view('admin/home');
		} else {
			redirect("internal"); }
	 }

	  // kasur
    public function kasur($filter1='', $filter2='', $filter3='')
    {
		 if($this->session->userdata('logged_in') == TRUE) {
			$where_pegawai['pegawai_username']		= $this->session->userdata('pegawai_user');
			$data['pegawai']					= $this->ADM->get_pegawai('',$where_pegawai);
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']			= FALSE;
            $data['breadcrumb']             = 'Kasur';
			$data['content']				= 'admin/content/website/kasur';
			$data['menu_terpilih']			= '1';
			$data['submenu_terpilih']		= '79';
			$data['action']					= (empty($filter1))?'view':$filter1;
			$data['validate']				= array('kasur_merk' => 'merk',
													'jenis_id'  => 'jenis',
													'kasur_deskripsi' => 'Deskripsi',
													'kasur_gambar' => 'Gambar');
			if($data['action']	== 'view') {	
				$data['berdasarkan']		= array('kasur_merk'=>'Merk','jenis_nama'=>'Jenis');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'kasur_merk';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 10;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_kasur[$data['cari']]	= $data['q'];			
				$data['jml_data']			= $this->ADM->count_all_kasur('', $like_kasur);
				$data['jml_halaman']		= ceil($data['jml_data']/$data['batas']);
				
			} elseif ($data['action']	== 'tambah') {
				$data['onload']				= 'kasur_merk';
				$data['kasur_id']			= ($this->input->post('kasur_id'))?$this->input->post('kasur_id'):'';
				$data['kasur_merk']			= ($this->input->post('kasur_merk'))?$this->input->post('kasur_merk'):'';
				$data['kasur_harga']		= ($this->input->post('kasur_harga'))?$this->input->post('kasur_harga'):'';
				$data['kasur_gambar']		= ($this->input->post('kasur_gambar'))?$this->input->post('kasur_gambar'):'';
				$data['jenis_id']			= ($this->input->post('jenis_id'))?$this->input->post('jenis_id'):'';
				$data['ukuran_id']			= ($this->input->post('ukuran_id'))?$this->input->post('ukuran_id'):'';
				$data['kasur_waktu']		= date("Y-m-d H:i:s");	
				$simpan						= $this->input->post('simpan');
				if ($simpan) {
					$gambar = upload_image("kasur_gambar", "./assets/images/kasur/", "230x160", seo($data['kasur_merk']));
					$data['kasur_gambar']		 = $gambar;
					$insert['kasur_merk']		 = validasi_sql($data['kasur_merk']);
					$insert['kasur_harga']	 	 = validasi_sql($data['kasur_harga']);
					if ($data['kasur_gambar']) { $insert['kasur_gambar'] = validasi_sql($data['kasur_gambar']); }
					$insert['kasur_waktu']		 = validasi_sql($data['kasur_waktu']);
					$insert['jenis_id']		 	 = validasi_sql($data['jenis_id']);
					$insert['ukuran_id']		 = validasi_sql($data['ukuran_id']);
					$this->ADM->insert_kasur($insert);
					$this->session->set_flashdata('success','kasur telah berhasil ditambahkan!,');
					redirect("admin/kasur");
				}
			} elseif ($data['action']	== 'edit') {
				$where['kasur_id'] 			=  validasi_sql($filter2);
				$data['onload']				= 'kasur_merk';
				$where_kasur['kasur_id']	= validasi_sql($filter2);
				$kasur 					= $this->ADM->get_kasur('*', $where_kasur);
				$data['kasur_id']			= ($this->input->post('kasur_id'))?$this->input->post('kasur_id'):$kasur->kasur_id;	
				$data['kasur_merk']		= ($this->input->post('kasur_merk'))?$this->input->post('kasur_merk'):$kasur->kasur_merk;
				$data['kasur_harga']			= ($this->input->post('kasur_harga'))?$this->input->post('kasur_harga'):$kasur->kasur_harga;	
				$data['kasur_waktu']		= ($this->input->post('kasur_waktu'))?$this->input->post('kasur_waktu'):$kasur->kasur_waktu;	
				$data['kasur_gambar']		= ($this->input->post('kasur_gambar'))?$this->input->post('kasur_gambar'):$kasur->kasur_gambar;	
				$data['jenis_id']		= ($this->input->post('jenis_id'))?$this->input->post('jenis_id'):$kasur->jenis_id;		
				$data['ukuran_id']		= ($this->input->post('ukuran_id'))?$this->input->post('ukuran_id'):$kasur->ukuran_id;		
				$simpan						= $this->input->post('simpan');
				if ($simpan) {
					$gambar = upload_image("kasur_gambar", "./assets/images/kasur/", "230x160", seo($data['kasur_merk']));
					$data['kasur_gambar']		= $gambar;
					$where_edit['kasur_id']	= validasi_sql($data['kasur_id']);
					$edit['kasur_merk']		= validasi_sql($data['kasur_merk']);
					$edit['kasur_harga']			= validasi_sql($data['kasur_harga']);
					if ($data['kasur_gambar']) {
						$row = $this->ADM->get_kasur('*', $where_edit);
						@unlink('./assets/images/kasur/'.$row->kasur_gambar);
						@unlink('./assets/images/kasur/kecil_'.$row->kasur_gambar);
						$edit['kasur_gambar']	= $data['kasur_gambar']; 
					}
					$edit['jenis_id']		= validasi_sql($data['jenis_id']);
					$edit['ukuran_id']		= validasi_sql($data['ukuran_id']);
					$this->ADM->update_kasur($where_edit, $edit);
					$this->session->set_flashdata('success','kasur telah berhasil diedit!,');
					redirect('admin/kasur');	
					}	
		 } elseif ($data['action']	== 'hapus') {
			 $where['kasur_id']	= validasi_sql($filter2);
			 $row = $this->ADM->get_kasur('*', $where);
			 @unlink ('./assets/images/kasur/'.$row->kasur_gambar);
			 @unlink ('./assets/images/kasur/kecil_'.$row->kasur_gambar);
			 $this->ADM->delete_kasur($where);
			 $this->session->set_flashdata('warning','kasur telah berhasil dihapus!,');
			 redirect("admin/kasur");
	     }
			 $this->load->vars($data);
			 $this->load->view('admin/home');
	  } else {
		  redirect("internal");
	  }
	}


    public function kasur_detail($kasur_id='')
    {
        if($this->session->userdata('logged_in') == TRUE) {
            $where_pegawai['pegawai_username']  = $this->session->userdata('pegawai_username');
            $data['pegawai']              = $this->ADM->get_pegawai('', $where_pegawai);
            $where_kasur['kasur_id']  = validasi_sql($kasur_id);
            $data['kasur']             = $this->ADM->get_kasur('*', $where_kasur);
            $data['action']             = 'detail';
            $this->load->vars($data);
            $this->load->view('admin/content/website/kasur');
      } else {
          redirect("internal");
      }
    }
    
     public function jenis($filter1='', $filter2='', $filter3='')
    {
		 if($this->session->userdata('logged_in') == TRUE) {
			$where_pegawai['pegawai_username']		= $this->session->userdata('pegawai_username');
			$data['pegawai']					= $this->ADM->get_pegawai('*',$where_pegawai);
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']			= FALSE;
            $data['breadcrumb']             = 'Jenis Kasur';
			$data['content']				= 'admin/content/website/jenis';
			$data['action']					= (empty($filter1))?'view':$filter1;
			$data['validate']				= array('jenis_nama'=>'nama');
			if($data['action'] == 'view') {
				$data['berdasarkan']		= array('jenis_nama'=>'Nama');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'jenis_nama';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 10;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_jenis[$data['cari']]	= $data['q'];			
				$data['jml_data']			= $this->ADM->count_all_jenis('', $like_jenis);
				$data['jml_halaman']		= ceil($data['jml_data']/$data['batas']);
			
			} elseif ($data['action']	== 'tambah') {
				$data['onload']				= 'jenis_nama';
				$data['jenis_nama']		= ($this->input->post('jenis_nama'))?$this->input->post('jenis_nama'):'';	
				$simpan						= $this->input->post('simpan');
				if($simpan){
					$insert['jenis_nama']	= validasi_sql($data['jenis_nama']);
					$this->ADM->insert_jenis($insert);
					$this->session->set_flashdata('success','jenis kasur telah berhasil ditambahkan!,');
					redirect("admin/jenis");
				}
			} elseif ($data['action']	== 'edit') {
				$where['jenis_id'] 		= $filter2;
				$data['onload']					= 'jenis_nama';
				$where_jenis['jenis_id']	= $filter2;
				$jenis						= $this->ADM->get_jenis('', $where_jenis);
				$data['jenis_id']			= ($this->input->post('jenis_id'))?$this->input->post('jenis_id'):$jenis->jenis_id;
				$data['jenis_nama']			= ($this->input->post('jenis_nama'))?$this->input->post('jenis_nama'):$jenis->jenis_nama;
				$simpan							= $this->input->post('simpan');
				
				if($simpan) {
					$where_edit['jenis_id']	= validasi_sql($data['jenis_id']);
					$edit['jenis_nama']		= validasi_sql($data['jenis_nama']);
					$this->ADM->update_jenis($where_edit, $edit);
					$this->session->set_flashdata('success','jenis kasur telah berhasil diedit!,');
					redirect("admin/jenis");
				}
			} elseif ($data['action'] == 'hapus') {
				$where_delete['jenis_id'] = validasi_sql($filter2);
				$this->ADM->delete_jenis($where_delete);
				$this->session->set_flashdata('warning','jenis kasur telah berhasil dihapus!,');
				redirect("admin/jenis");
			}
			$this->load->vars($data);
			$this->load->view('admin/home');
		 } else {
			 redirect("internal");		 	
			}
				
	}

	  public function jenis_detail($jenis_id='')
	{
		if($this->session->userdata('logged_in') == TRUE){
			$where_pegawai['pegawai_username']			= $this->session->userdata('pegawai_username');
			$data['pegawai']						= $this->ADM->get_pegawai('',$where_pegawai);
			$where_jenis['jenis_id']		= validasi_sql($jenis_id);
			$data['jenis']					= $this->ADM->get_jenis('',$where_jenis);
			$data['action']						= 'detail';
			$this->load->vars($data);
			$this->load->view('admin/content/website/jenis');
		} else {
			redirect("internal");
		}
	}

	public function ukuran($filter1='', $filter2='', $filter3='')
    {
         if($this->session->userdata('logged_in') == TRUE) {
            $where_pegawai['pegawai_username']      = $this->session->userdata('pegawai_username');
            $data['pegawai']                    = $this->ADM->get_pegawai('*',$where_pegawai);
            @date_default_timezone_set('Asia/Jakarta');
            $data['dashboard_info']         = FALSE;
            $data['breadcrumb']             = 'Ukuran Kasur';
            $data['content']                = 'admin/content/website/ukuran';
            $data['action']                 = (empty($filter1))?'view':$filter1;
            $data['validate']               = array('ukuran_dimensi'=>'dimensi');
            if($data['action'] == 'view') {
                $data['berdasarkan']        = array('ukuran_dimensi'=>'dimensi');
                $data['cari']               = ($this->input->post('cari'))?$this->input->post('cari'):'ukuran_dimensi';
                $data['q']                  = ($this->input->post('q'))?$this->input->post('q'):'';
                $data['halaman']            = (empty($filter2))?1:$filter2;
                $data['batas']              = 10;
                $data['page']               = ($data['halaman']-1) * $data['batas'];
                $like_ukuran[$data['cari']]  = $data['q'];           
                $data['jml_data']           = $this->ADM->count_all_ukuran('', $like_ukuran);
                $data['jml_halaman']        = ceil($data['jml_data']/$data['batas']);
            
            } elseif ($data['action']   == 'tambah') {
                $data['onload']             = 'ukuran_dimensi';
                $data['ukuran_dimensi']     = ($this->input->post('ukuran_dimensi'))?$this->input->post('ukuran_dimensi'):'';   
                $simpan                     = $this->input->post('simpan');
                if($simpan){
                    $insert['ukuran_dimensi']   = validasi_sql($data['ukuran_dimensi']);
                    $this->ADM->insert_ukuran($insert);
                    $this->session->set_flashdata('success','ukuran kasur telah berhasil ditambahkan!,');
                    redirect("admin/ukuran");
                }
            } elseif ($data['action']   == 'edit') {
                $where['ukuran_id']      = $filter2;
                $data['onload']                 = 'ukuran_dimensi';
                $where_ukuran['ukuran_id']    = $filter2;
                $ukuran                      = $this->ADM->get_ukuran('', $where_ukuran);
                $data['ukuran_id']           = ($this->input->post('ukuran_id'))?$this->input->post('ukuran_id'):$ukuran->ukuran_id;
                $data['ukuran_dimensi']         = ($this->input->post('ukuran_dimensi'))?$this->input->post('ukuran_dimensi'):$ukuran->ukuran_dimensi;
                $simpan                         = $this->input->post('simpan');
                
                if($simpan) {
                    $where_edit['ukuran_id'] = validasi_sql($data['ukuran_id']);
                    $edit['ukuran_dimensi']     = validasi_sql($data['ukuran_dimensi']);
                    $this->ADM->update_ukuran($where_edit, $edit);
                    $this->session->set_flashdata('success','ukuran kasur telah berhasil diedit!,');
                    redirect("admin/ukuran");
                }
            } elseif ($data['action'] == 'hapus') {
                $where_delete['ukuran_id'] = validasi_sql($filter2);
                $this->ADM->delete_ukuran($where_delete);
                $this->session->set_flashdata('warning','ukuran kasur telah berhasil dihapus!,');
                redirect("admin/ukuran");
            }
            $this->load->vars($data);
            $this->load->view('admin/home');
         } else {
             redirect("internal");          
            }
                
    }

     public function ukuran_detail($ukuran_id='')
    {
        if($this->session->userdata('logged_in') == TRUE){
            $where_pegawai['pegawai_username']          = $this->session->userdata('pegawai_username');
            $data['pegawai']                        = $this->ADM->get_pegawai('',$where_pegawai);
            $where_ukuran['ukuran_id']        = validasi_sql($ukuran_id);
            $data['ukuran']                  = $this->ADM->get_ukuran('',$where_ukuran);
            $data['action']                     = 'detail';
            $this->load->vars($data);
            $this->load->view('admin/content/website/ukuran');
        } else {
            redirect("internal");
        }
    }
	

	//FUNGSI pegawai
    public function pegawai ($filter1='', $filter2='', $filter3='')
    {
        if($this->session->userdata('logged_in') == TRUE){
            $where_pegawai['pegawai_username']  = $this->session->userdata('pegawai_username');
            $data['pegawai']                    = $this->ADM->get_pegawai('',$where_pegawai);
            $data['dashboard_info']         	= FALSE;
            $data['breadcrumb']             	= 'Pegawai';
            $data['content']                    = '/admin/content/website/pegawai';
			$data['action']					= (empty($filter1))?'view':$filter1;
			$data['validate']				= array('jenis_nama'=>'nama');
			if($data['action'] == 'view') {
				$data['berdasarkan']		= array('pegawai_nama'=>'Nama');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'pegawai_nama';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 10;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_pegawai[$data['cari']]	= $data['q'];			
				$data['jml_data']			= $this->ADM->count_all_pegawai('', $like_pegawai);
				$data['jml_halaman']		= ceil($data['jml_data']/$data['batas']);
			
			} elseif ($data['action']   == 'tambah') {
                $data['onload']             = 'pegawai_nama';
                $data['pegawai_id']          = ($this->input->post('pegawai_id'))?$this->input->post('pegawai_id'):'';
                $data['pegawai_username']     = ($this->input->post('pegawai_username'))?$this->input->post('pegawai_username'):'';               
                $data['pegawai_password']     = ($this->input->post('pegawai_password'))?$this->input->post('pegawai_password'):'';          
                $data['pegawai_nama']         = ($this->input->post('pegawai_nama'))?$this->input->post('pegawai_nama'):'';       
                $data['pegawai_jabatan']        = ($this->input->post('pegawai_jabatan'))?$this->input->post('pegawai_jabatan'):'';     
                $data['pegawai_level']            = ($this->input->post('pegawai_level'))?$this->input->post('pegawai_level'):'';     
                $simpan                     = $this->input->post('simpan');
                if($simpan){
                    $insert['pegawai_id']    = validasi_sql($data['pegawai_id']);
                    $insert['pegawai_username']    = validasi_sql($data['pegawai_username']);
                    $insert['pegawai_password']= md5($data['pegawai_password']);
                    $insert['pegawai_nama']   = validasi_sql($data['pegawai_nama']);
                    $insert['pegawai_jabatan']  = validasi_sql($data['pegawai_jabatan']);
                    $insert['pegawai_level']  = validasi_sql($data['pegawai_level']);
                    $this->ADM->insert_pegawai($insert);
                    $this->session->set_flashdata('success','pegawai telah berhasil ditambahkan!,');
                    redirect("admin/pegawai");
                }
            } elseif ($data['action']   == 'edit') {
                $where['pegawai_id']         = $filter2;
                $data['onload']             = 'pegawai_nama';
                $pegawai                      = $this->ADM->get_pegawai('', $where);
                $data['pegawai_id']          = ($this->input->post('pegawai_id'))?$this->input->post('pegawai_id'):$pegawai->pegawai_id;
                $data['pegawai_username']     = ($this->input->post('pegawai_username'))?$this->input->post('pegawai_username'):$pegawai->pegawai_username;
                $data['pegawai_password']     = ($this->input->post('pegawai_password'))?$this->input->post('pegawai_password'):$pegawai->pegawai_password;
                $data['pegawai_nama']         = ($this->input->post('pegawai_nama'))?$this->input->post('pegawai_nama'):$pegawai->pegawai_nama;
                $data['pegawai_jabatan']        = ($this->input->post('pegawai_jabatan'))?$this->input->post('pegawai_jabatan'):$pegawai->pegawai_jabatan;
                $data['pegawai_level']            = ($this->input->post('pegawai_level'))?$this->input->post('pegawai_level'):$pegawai->pegawai_level;
                $simpan                         = $this->input->post('simpan');
                if($simpan) {
                    $where_edit['pegawai_id']    = validasi_sql($data['pegawai_id']);
                    if($data['pegawai_password'] == $data['pegawai_password']) {
                    $where_edit['pegawai_id']    = validasi_sql($data['pegawai_id']);
                        if($data['pegawai_password'] <> '') {
                            $edit['pegawai_password']     = validasi_sql(do_hash(($data['pegawai_password']), 'md5')); 
                        }
                    }
                    $edit['pegawai_username']         = validasi_sql($data['pegawai_username']);
                    $edit['pegawai_nama']         = validasi_sql($data['pegawai_nama']);
                    $edit['pegawai_jabatan']        = validasi_sql($data['pegawai_jabatan']);
                    $edit['pegawai_level']        = validasi_sql($data['pegawai_level']);
                    $this->ADM->update_pegawai($where_edit, $edit);
                    $this->session->set_flashdata('success','pegawai telah berhasil diedit!,');
                    redirect("admin/pegawai");
                }
            } elseif ($data['action'] == 'hapus') {
                $where_delete['pegawai_id'] = validasi_sql($filter2);
                $this->ADM->delete_pegawai($where_delete);
                $this->session->set_flashdata('warning','pegawai telah berhasil dihapus!,');
                redirect("admin/pegawai");
            }
            $this->load->vars($data);
            $this->load->view('admin/home');
         } else {
             redirect("internal");           
            }
        }


    public function pelanggan ($filter1='', $filter2='', $filter3='')
    {
        if($this->session->userdata('logged_in') == TRUE){
            $where_pegawai['pegawai_username']  = $this->session->userdata('pegawai_username');
            $data['pegawai']                    = $this->ADM->get_pegawai('',$where_pegawai);
            $data['dashboard_info']         	= FALSE;
            $data['breadcrumb']             	= 'Pelanggan';
            $data['content']                    = '/admin/content/website/pelanggan';
			$data['action']					= (empty($filter1))?'view':$filter1;
			$data['validate']				= array('jenis_nama'=>'nama');
			if($data['action'] == 'view') {
				$data['berdasarkan']		= array('pelanggan_nama'=>'Nama');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'pelanggan_nama';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 10;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_pelanggan[$data['cari']]	= $data['q'];			
				$data['jml_data']			= $this->ADM->count_all_pelanggan('', $like_pelanggan);
				$data['jml_halaman']		= ceil($data['jml_data']/$data['batas']);
			
			} elseif ($data['action']   == 'tambah') {
                $data['onload']             = 'pelanggan_nama';
                $data['pelanggan_id']          = ($this->input->post('pelanggan_id'))?$this->input->post('pelanggan_id'):'';
                $data['pelanggan_username']     = ($this->input->post('pelanggan_username'))?$this->input->post('pelanggan_username'):'';               
                $data['pelanggan_password']     = ($this->input->post('pelanggan_password'))?$this->input->post('pelanggan_password'):'';          
                $data['pelanggan_nama']         = ($this->input->post('pelanggan_nama'))?$this->input->post('pelanggan_nama'):'';       
                $data['pelanggan_alamat']        = ($this->input->post('pelanggan_alamat'))?$this->input->post('pelanggan_alamat'):'';     
                $data['pelanggan_notlp']            = ($this->input->post('pelanggan_notlp'))?$this->input->post('pelanggan_notlp'):'';     
                $simpan                     = $this->input->post('simpan');
                if($simpan){
                    $insert['pelanggan_id']    = validasi_sql($data['pelanggan_id']);
                    $insert['pelanggan_username']    = validasi_sql($data['pelanggan_username']);
                    $insert['pelanggan_password']= md5($data['pelanggan_password']);
                    $insert['pelanggan_nama']   = validasi_sql($data['pelanggan_nama']);
                    $insert['pelanggan_alamat']  = validasi_sql($data['pelanggan_alamat']);
                    $insert['pelanggan_notlp']  = validasi_sql($data['pelanggan_notlp']);
                    $this->ADM->insert_pelanggan($insert);
                    $this->session->set_flashdata('success','pelanggan telah berhasil ditambahkan!,');
                    redirect("admin/pelanggan");
                }
            } elseif ($data['action']   == 'edit') {
                $where['pelanggan_id']         = $filter2;
                $data['onload']             = 'pelanggan_nama';
                $pelanggan                      = $this->ADM->get_pelanggan('', $where);
                $data['pelanggan_id']          = ($this->input->post('pelanggan_id'))?$this->input->post('pelanggan_id'):$pelanggan->pelanggan_id;
                $data['pelanggan_username']     = ($this->input->post('pelanggan_username'))?$this->input->post('pelanggan_username'):$pelanggan->pelanggan_username;
                $data['pelanggan_password']     = ($this->input->post('pelanggan_password'))?$this->input->post('pelanggan_password'):$pelanggan->pelanggan_password;
                $data['pelanggan_nama']         = ($this->input->post('pelanggan_nama'))?$this->input->post('pelanggan_nama'):$pelanggan->pelanggan_nama;
                $data['pelanggan_alamat']        = ($this->input->post('pelanggan_alamat'))?$this->input->post('pelanggan_alamat'):$pelanggan->pelanggan_alamat;
                $data['pelanggan_notlp']            = ($this->input->post('pelanggan_notlp'))?$this->input->post('pelanggan_notlp'):$pelanggan->pelanggan_notlp;
                $simpan                         = $this->input->post('simpan');
                if($simpan) {
                    $where_edit['pelanggan_id']    = validasi_sql($data['pelanggan_id']);
                    if($data['pelanggan_password'] == $data['pelanggan_password']) {
                    $where_edit['pelanggan_id']    = validasi_sql($data['pelanggan_id']);
                        if($data['pelanggan_password'] <> '') {
                            $edit['pelanggan_password']     = validasi_sql(do_hash(($data['pelanggan_password']), 'md5')); 
                        }
                    }
                    $edit['pelanggan_username']         = validasi_sql($data['pelanggan_username']);
                    $edit['pelanggan_nama']         = validasi_sql($data['pelanggan_nama']);
                    $edit['pelanggan_alamat']        = validasi_sql($data['pelanggan_alamat']);
                    $edit['pelanggan_notlp']        = validasi_sql($data['pelanggan_notlp']);
                    $this->ADM->update_pelanggan($where_edit, $edit);
                    $this->session->set_flashdata('success','pelanggan telah berhasil diedit!,');
                    redirect("admin/pelanggan");
                }
            } elseif ($data['action'] == 'hapus') {
                $where_delete['pelanggan_id'] = validasi_sql($filter2);
                $this->ADM->delete_pelanggan($where_delete);
                $this->session->set_flashdata('warning','pelanggan telah berhasil dihapus!,');
                redirect("admin/pelanggan");
            }
            $this->load->vars($data);
            $this->load->view('admin/home');
         } else {
             redirect("internal");           
            }
        }
    
    public function pesanan($filter1='', $filter2='', $filter3='')
    {
		 if($this->session->userdata('logged_in') == TRUE) {
			$where_pegawai['pegawai_username']		= $this->session->userdata('pegawai_username');
			$data['pegawai']					= $this->ADM->get_pegawai('*',$where_pegawai);
			@date_default_timezone_set('Asia/Jakarta');
			$data['dashboard_info']			= FALSE;
            $data['breadcrumb']             = 'Pesanan';
			$data['content']				= 'admin/content/website/pesanan';
			$data['action']					= (empty($filter1))?'view':$filter1;
			$data['validate']				= array('invoices_id'=>'NO.INVOICES');
			if($data['action'] == 'view') {
				$data['berdasarkan']		= array('invoices_id'=>'NO.INVOICES');
				$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'invoices_id';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 10;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_invoices[$data['cari']]	= $data['q'];			
				$data['jml_data']			= $this->ADM->count_all_invoices('', $like_invoices);
				$data['jml_halaman']		= ceil($data['jml_data']/$data['batas']);
			
			} elseif($data['action'] == 'detail') {
				 $where['invoices_id']         = $filter2;
                $data['onload']             = 'invoices_id';
                $invoices                     = $this->ADM->get_invoices('', $where);
                $data['invoices_id']          = ($this->input->post('invoices_id'))?$this->input->post('invoices_id'):$invoices->invoices_id;
                $data['invoices_subtotal']          = ($this->input->post('invoices_subtotal'))?$this->input->post('invoices_subtotal'):$invoices->invoices_subtotal;
                $data['invoices_date']          = ($this->input->post('invoices_date'))?$this->input->post('invoices_date'):$invoices->invoices_date;
                $data['pelanggan_nama']          = ($this->input->post('pelanggan_nama'))?$this->input->post('pelanggan_nama'):$invoices->pelanggan_nama;
                $data['pelanggan_alamat']          = ($this->input->post('pelanggan_alamat'))?$this->input->post('pelanggan_alamat'):$invoices->pelanggan_alamat;
                $data['pelanggan_notlp']          = ($this->input->post('pelanggan_notlp'))?$this->input->post('pelanggan_notlp'):$invoices->pelanggan_notlp;
			}
			$this->load->vars($data);
			$this->load->view('admin/home');
		 } else {
			 redirect("internal");		 	
			}
				
	}

		//EXPORT KE EXCEL
	public function print_pesanan($invoices_id='')
    {
		if($this->session->userdata('logged_in') == TRUE) {
			$where_pegawai['pegawai_username']		= $this->session->userdata('pegawai_username');
			$data['pegawai']					= $this->ADM->get_pegawai('*',$where_pegawai);

            $where_invoices['invoices_id']        = validasi_sql($invoices_id);
            $data['invoices']                  = $this->ADM->get_invoices('',$where_invoices);
			$this->load->vars($data);
			$this->load->view('admin/content/website/print_pesanan');
	  } else {
			redirect("admin");
	  }
	}


    public function laporan($filter1='', $filter2='', $filter3='')
    {
		 if($this->session->userdata('logged_in') == TRUE) {
			$where_pegawai['pegawai_username']		= $this->session->userdata('pegawai_username');
			$data['pegawai']					= $this->ADM->get_pegawai('*',$where_pegawai);
			$data['dashboard_info']			= FALSE;
            $data['breadcrumb']             = 'Laporan';
			$data['content']				= 'admin/content/website/laporan';
			$data['action']					= (empty($filter1))?'view':$filter1;
			$this->load->vars($data);
			$this->load->view('admin/home');
	 	} else {
			redirect("admin");
		}
	  }

	public function laporanexcel($filter1='', $filter2='', $filter3='')
    {
		if($this->session->userdata('logged_in') == TRUE) {
			$where_pegawai['pegawai_username']	= $this->session->userdata('pegawai_username');
			$data['pegawai']					= $this->ADM->get_pegawai('*',$where_pegawai);
			$data['action']						= (empty($filter1))?'view':$filter1;
				        header("Pragma: public");
				        header("Expires: 0");
				        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
				        header("Content-Type: application/force-download");
				        header("Content-Type: application/octet-stream");
				        header("Content-Type: application/download");
				        header("Content-Disposition: attachment;filename=Laporan.xls");
				        header("Content-Transfer-Encoding: binary ");
			$this->load->vars($data);
			$this->load->view('admin/content/website/laporan_excel');
	  } else {
			redirect("admin");
	  }
	}
}