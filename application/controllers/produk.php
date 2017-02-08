<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produk extends CI_Controller {

    public function __construct()
    {
    	parent::__construct();
		$this->load->model('M_admin', 'ADM', TRUE);
		$this->load->model('M_config', 'CONF', TRUE);
		$this->load->model('M_kasur', 'KAS', TRUE);
    }

	public function index ($filter1='', $filter2='', $filter3='')
	{
		$where_pelanggan['pelanggan_username']		= $this->session->userdata('pelanggan_username');
		$data['pelanggan']					= $this->ADM->get_pelanggan('',$where_pelanggan);
		$data['title']			= '';
		$data['content']		= '/default/content/produk';
		$data['boxkategori']	= TRUE;	
		$data['boxkeranjang']	= TRUE;	
		$data['boxinformasi']	= TRUE;	
				
		$data['halaman']		= (empty($filter1))?1:$filter1;
		$data['batas']			= 6;
		$data['page']			= ($data['halaman']-1) * $data['batas'];
		$data['jml_data']		= $this->ADM->count_all_kasur();
		$data['jml_halaman'] 	= ceil($data['jml_data']/$data['batas']);
		$this->load->vars($data);
		$this->load->view('default/home');
	}

	public function detailproduk ($kasur_id='')
	{
		$where_pelanggan['pelanggan_username']		= $this->session->userdata('pelanggan_username');
		$data['pelanggan']					= $this->ADM->get_pelanggan('',$where_pelanggan);
		$data['title']			= '';
		$data['content']		= '/default/content/detailproduk';
		$data['kasur_id']			=  (empty($kasur_id))?'':$kasur_id;
    $where_kasur['kasur_id']    = validasi_sql($kasur_id);
    $data['kasur']          = $this->ADM->get_kasur('',$where_kasur);
		$data['boxkategori']	= TRUE;	
		$data['boxkeranjang']	= TRUE;	
		$data['boxinformasi']	= TRUE;	
		$this->load->vars($data);
		$this->load->view('default/home');
	}

	public function detailkategori($jenis_id='', $filter2='', $filter3='') {  
		$where_pelanggan['pelanggan_username']		= $this->session->userdata('pelanggan_username');
		$data['pelanggan']					= $this->ADM->get_pelanggan('',$where_pelanggan);
	    $data['content']    				= '/default/content/detailkategori';
	    $data['jenis_id']					=  (empty($jenis_id))?'':$jenis_id;
	    $where_jenis['jenis_id']   		 	= validasi_sql($jenis_id);
	    $data['jenis']          			= $this->ADM->get_jenis('',$where_jenis);
	    $data['boxkategori']  		= TRUE; 
	    $data['boxkeranjang'] 		= TRUE; 
    	$data['boxinformasi']		= TRUE;	
		$data['cari']				= ($this->input->post('cari'))?$this->input->post('cari'):'kasur_merk';
				$data['q']					= ($this->input->post('q'))?$this->input->post('q'):'';
				$data['halaman']			= (empty($filter2))?1:$filter2;
				$data['batas']				= 6;
				$data['page']				= ($data['halaman']-1) * $data['batas'];
				$like_kasur[$data['cari']]	= $data['q'];			
				$data['jml_data']			= $this->ADM->count_all_kasur('', '');
				$data['jml_halaman']		= ceil($data['jml_data']/$data['batas']);
    $this->load->vars($data);
    $this->load->view('default/home');
  	}

	public function add_to_cart($kasur_id)
	{
		$kasur = $this->KAS->find($kasur_id);		
		$data = array(
					   'id'      => $kasur->kasur_id,
					   'qty'     => 1,
					   'price'   => $kasur->kasur_harga,
					   'name'   => $kasur->kasur_merk
					);
		$this->cart->insert($data);
		redirect('keranjang');	
	}

	public function cart(){
		// displays what currently inside the cart
		//print_r($this->cart->contents());
		$data['boxkategori']	= TRUE;	
		$data['boxkeranjang']	= TRUE;	
		$data['boxinformasi']	= TRUE;	
		$data['content']		= '/default/content/keranjang';;
		$this->load->vars($data);
		$this->load->view('default/home');
	}
	
	public function update_cart(){
        $cart_info =  $_POST['cart'] ;
 		foreach( $cart_info as $id => $cart)
		{	
                    $rowid = $cart['rowid'];
                    $price = $cart['price'];
                    $amount = $price * $cart['qty'];
                    $qty = $cart['qty'];
                    
            $data = array(
				'rowid'   => $rowid,
                'price'   => $price,
                'amount' =>  $amount,
				'qty'     => $qty
			);
             
			$this->cart->update($data);
		}
		redirect('keranjang');        
	}	
     
     function remove($rowid) {
		if ($rowid==="all"){
			$this->cart->destroy();
		}else{
			$data = array(
				'rowid'   => $rowid,
				'qty'     => 0
			);
			$this->cart->update($data);
		}
		redirect('keranjang');
	}

	public function clear_cart()
	{
		$this->cart->destroy();
		redirect(base_url());
	}

	
}
