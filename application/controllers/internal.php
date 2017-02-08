<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Internal extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_login', 'LOG', TRUE);
		$this->load->model('M_admin', 'ADM', TRUE);
		$this->load->model('M_config', 'CONF', TRUE);
	}
	
	public function index()
	{
        if ($this->session->userdata('logged_in') == TRUE){       
            redirect('admin/','refresh');
        } else {     
		$this->load->view('admin/login');
		 }
	}
	
	public function ceklogin()
	{
		$username		= validasi_sql($this->input->post('username'));
		$password		= validasi_sql($this->input->post('password'));
		$do				= validasi_sql($this->input->post('masuk'));
		
		$where_login['pegawai_username']	= $username;
		$where_login['pegawai_password']	= do_hash($password, 'md5');
		
		if ($do && $this->LOG->cek_login($where_login) === TRUE){
			redirect("admin/");
		} else {
			$this->session->set_flashdata('warning','Username atau Password tidak cocok!');
            redirect("internal");
		}
		
	}
	
	public function keluar()
	{
		$this->LOG->remov_session();
        session_destroy();
		redirect("internal");
	}
	
}