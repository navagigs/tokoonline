<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pesanan extends CI_Controller {

    public function __construct()
    {
    	parent::__construct();
		$this->load->model('M_admin', 'ADM', TRUE);
		$this->load->model('M_pelanggan', 'PEL', TRUE);
		$this->load->model('M_pesanan', 'PES', TRUE);
    }

	public function index()
	{
		if($this->session->userdata('logged_in2') == TRUE){
			$where_pelanggan['pelanggan_username']		= $this->session->userdata('pelanggan_username');
			$data['pelanggan']					= $this->ADM->get_pelanggan('',$where_pelanggan);
			date_default_timezone_set('Asia/Jakarta');
			$pelanggan_username = $this->session->userdata('pelanggan_username');
			$invoices_subtotal  = $this->cart->total();
			$invoice = array(
						'invoices_date'		=> date('Y-m-d'),
						'invoices_due_date'	=> date('Y-m-d H:i:s', mktime( date('H'),date('i'),date('s'),date('m'),date('d') + 1,date('Y'))),
	                	'pelanggan_username'=> $pelanggan_username,
	                	'invoices_subtotal' => $invoices_subtotal,
						'invoices_status'	=> 'unpaid'
			);
			$this->db->insert('invoices', $invoice);
			$pesanan_invoice = $this->db->insert_id();
			$tanggal_sekarang = date('Y-m-d');
			
			if($cart = $this->cart->contents() ):
			foreach($cart as $item):
				$data = array(
					'invoices_id'	=> $pesanan_invoice,
					'kasur_id'		    => $item['id'],
					'kasur_merk'		=> $item['name'],
					'pesanan_qty'		=> $item['qty'],
					'pesanan_price'		=> $item['price'],
	                'pesanan_subtotal'  => $item['subtotal'],
	                'pesanan_tanggal'	=> $tanggal_sekarang,
	                'pelanggan_username'=> $pelanggan_username
				);
				$this->db->insert('pesanan', $data);
			endforeach;
			endif;
			$this->cart->destroy();
			$this->session->set_flashdata('success','Terimakasih telah melakukan pesanan!');
			redirect('pesanan/detail');
		} else {
		  redirect("login");
		}
	}


	public function detail($pelanggan_username='', $filter1='',  $filter2='', $filter3='')
	{
		if($this->session->userdata('logged_in2') == TRUE){
		$where_pelanggan['pelanggan_username']		= $this->session->userdata('pelanggan_username');
		$data['pelanggan']					= $this->ADM->get_pelanggan('',$where_pelanggan);
	    $data['content']    				= '/default/content/pesanan';
	    $data['pelanggan_username']					=  (empty($pelanggan_username))?'':$pelanggan_username;
	    $where_jenis['pelanggan_username']   		 	= validasi_sql($pelanggan_username);
	    $data['jenis']          			= $this->ADM->get_pelanggan('',$where_jenis);
	    $data['boxkategori']  		= TRUE; 
	    $data['boxkeranjang'] 		= TRUE; 
    	$data['boxinformasi']		= TRUE;	
    	$this->load->vars($data);
    	$this->load->view('default/home');
    } else {
		  redirect("login");
		}
	}

}