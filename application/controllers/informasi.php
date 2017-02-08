<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Informasi extends CI_Controller {

    public function __construct()
    {
      parent::__construct();
    $this->load->model('M_admin', 'ADM', TRUE);
    $this->load->model('M_config', 'CONF', TRUE);
    }

  public function index ()
  {
        $where_pelanggan['pelanggan_username']    = $this->session->userdata('pelanggan_username');
    $data['pelanggan']          = $this->ADM->get_pelanggan('',$where_pelanggan);
    $data['title']      = '';
    $data['content']    = '/default/content/tentangkami';
    $data['boxkategori']  = TRUE; 
    $data['boxkeranjang'] = TRUE; 
    $this->load->vars($data);
    $this->load->view('default/home');
  }

  public function tentang ()
  {
        $where_pelanggan['pelanggan_username']    = $this->session->userdata('pelanggan_username');
    $data['pelanggan']          = $this->ADM->get_pelanggan('',$where_pelanggan);
    $data['title']      = '';
    $data['content']    = '/default/content/tentang';
    $data['boxkategori']  = TRUE; 
    $data['boxkeranjang'] = TRUE; 
      $data['boxinformasi'] = TRUE; 
    $this->load->vars($data);
    $this->load->view('default/home');
  }

  public function kontak ()
  {
        $where_pelanggan['pelanggan_username']    = $this->session->userdata('pelanggan_username');
    $data['pelanggan']          = $this->ADM->get_pelanggan('',$where_pelanggan);
    $data['title']      = '';
    $data['content']    = '/default/content/kontak';
    $data['boxkategori']  = TRUE; 
    $data['boxkeranjang'] = TRUE; 
      $data['boxinformasi'] = TRUE; 
    $this->load->vars($data);
    $this->load->view('default/home');
  }

  public function carapembelian ()
  {
        $where_pelanggan['pelanggan_username']    = $this->session->userdata('pelanggan_username');
    $data['pelanggan']          = $this->ADM->get_pelanggan('',$where_pelanggan);
    $data['title']      = '';
    $data['content']    = '/default/content/carapembelian';
    $data['boxkategori']  = TRUE; 
    $data['boxkeranjang'] = TRUE; 
      $data['boxinformasi'] = TRUE; 
    $this->load->vars($data);
    $this->load->view('default/home');
  }

}
