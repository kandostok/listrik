<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manajer extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('PembayaranModel');
	}

	public function index()
	{
		$this->load->view('manajer/dashboard_m');
	}

	public function history()
	{
		$data['history'] = $this->PembayaranModel->get_history();
		$this->load->view('manajer/history', $data);
	}

	public function logout()
    {
        $data = array(
            'id_admin'    => "",
            'username'    => "",
            'logged_in'   => false
        );
        
        $this->session->unset_userdata('$data');
        $this->session->sess_destroy();
        redirect('admin');
    }

}

/* End of file Manajer.php */
/* Location: ./application/controllers/Manajer.php */